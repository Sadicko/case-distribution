<?php

namespace App\Http\Controllers;

use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Spatie\Backup\Helpers\Format;

class BackupController extends Controller
{
    use AuditTrailLog;
    public function index()
    {

        if(Gate::denies('Manage backups')){

            $this->createAuditTrail("Denied access to  Manage backups: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Manage backups.']);
        }

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        foreach ($files as $file) {
            if (str_ends_with($file, '.zip') && $disk->exists($file)) {
                $backups[] = [
                    'file_path' => $file,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $file),
                    'file_size' => Format::humanReadableSize($disk->size($file)),
                    'last_modified' => $disk->lastModified($file),
                ];
            }
        }

        $this->createAuditTrail('Visited backup page.');

        return view('admin.backups.index')->with(compact('backups'));
    }

    public function download($file_name)
    {
        if(Gate::denies('Download backups')){

            $this->createAuditTrail("Denied access to  Download backups: Unauthorized");

            return back()->with(['error' => 'You are not authorized to Download backups.']);
        }

        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $file = config('backup.backup.name') . '/' . $file_name;

        if ($disk->exists($file)) {
            $this->createAuditTrail("Downloaded a backup file $file.");
            return response()->download($disk->path($file));
        } else {
            abort(404, "The backup file doesn't exist.");
        }


    }
}
