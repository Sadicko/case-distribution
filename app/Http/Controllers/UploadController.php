<?php

namespace App\Http\Controllers;

use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    use AuditTrailLog;
    public function showUploadCasesForm()
    {
        return view('dashboard.dockets.upload-cases');
    }


    /**
     * Process csv file
     *
     * @param <type>
     * @return <type>
     */
    public function processImport(Request $request)
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'max:10240'],
        ]);

        // return back if not a csv file
        if (strtolower($request->file('csv_file')->getClientOriginalExtension()) != 'csv') {
            return back()->withInput()->withErors(['csv_file' => 'The file is not supported. Only .csv file is allowed']);
        }

        // get filepath
        $path = $request->file('csv_file')->getRealPath();

        // get records from csv
        // $data = array_map('str_getcsv', file($path));

        // array to store csv data
        $csv_data = [];
        $row = 1;

        if (($handle = fopen($request->file('csv_file'), "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $num = count($data);
                for ($i = 0; $i < $num; $i++) {
                    $csv_data[$row][$i] = $data[$i];
                }
                $row++;
            }
            fclose($handle);
        }

        // check if records exceeds 1000. This allows to upload 1000 records at a time
        if (count($csv_data) > 1001) {
            // create audit trail
            $this->createAuditTrail('Tried to import large data.');

            \Session::flash('info', 'CSV file contains ' . (count($csv_data) - 1001) . ' records. Only 1000 records can be uploaded at time');
            return back();
        }

        return $this->process_csv($request, $csv_data);
    }

    /**
     * process the csv file
     *
     * @param      <type>  $request  The request
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function process_csv($request, $data)
    {

        $json_data = json_encode($data , JSON_FORCE_OBJECT);
        if ( json_last_error_msg() == "Malformed UTF-8 characters, possibly incorrectly encoded" ) {
            $json_data = json_encode($data, JSON_PARTIAL_OUTPUT_ON_ERROR );
        }
        if ( $json_data == false ) {
            \Session::flash('info', json_last_error_msg());
            return back();
        }


        if (count($data) > 1) {
            $csv_data = array_slice($data, 1, 5);

            $session_data = [

                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_data' => $json_data,
            ];

            $request->session()->put('csv_data', $session_data);
        } else {

            \Session::flash('info', 'No records found in CSV file');
            return back();
        }

        // create audit trail
        $this->createAuditTrail('Previewed imported data before upload');

        return view('dashboard.dockets.upload-preview', compact('csv_data', 'data'));
    }
}
