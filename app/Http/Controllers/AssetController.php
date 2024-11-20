<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Court;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public  function showAssets()
    {
//        $assets = Asset::query()->with('regions', 'categories', 'subcategories')->latest()->get();
        return view('dashboard.assets.index');
    }
    public  function createAsset()
    {
        $categories = Category::query()->whereNull('parent_id')->get();
        $regions = Region::query()->with('countries')->whereHas('countries', function ($query) {
            $query->where('code', 'GH');
        })->orderby('name', 'asc')->get();
        $locations = Location::query()->get();
        $courts = Court::query()->get();
        $term = request()->term;

        return view('dashboard.assets.create', compact('categories', 'regions', 'locations', 'courts', 'term'));

    }
    public  function saveAsset(Request $request)
    {

//        return $request;

        // Define common validation rules
        $rules = [
            'asset_id' => 'required|string|max:255',
            'asset_name' => 'required|string|max:255',
            'category' => 'required|integer',
            'subcategory' => 'required|integer',
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',
            'current_value' => 'nullable|numeric',
            'depreciation_method' => 'nullable|string|max:255',
            'court' => 'nullable|integer',
            'location' => 'required|integer',
            'region' => 'required|integer',
            'ownership' => 'nullable|string|max:255',
            'responsible_office' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'assigned_to' => 'nullable|string|max:255',
            'attachments.*' => 'nullable',//[new ValidFileExtension]
            'maintenance_schedule' => 'nullable|string',
        ];

        // Define additional rules for specific categories
        switch ($request->input('term')) {
            case 'Real Estate':
                $rules = array_merge($rules, [
                    'land_area' => 'nullable|numeric',
                    'building_size' => 'nullable|numeric',
                    'number_of_rooms' => 'nullable|integer',
                    'year_of_construction' => 'nullable|integer',
                    'legal_status' => 'nullable|string|max:255',
                    'condition' => 'nullable|string|max:255',
                    'house_number' => 'nullable|string|max:255',
                ]);
                break;

            case 'Office Equipment':
            case 'ICT Equipment':
                $rules = array_merge($rules, [
                    'manufacturer' => 'required|string|max:255',
                    'model' => 'required|string|max:255',
                    'serial_number' => 'required|string|max:255',
                    'warranty_information' => 'nullable|string|max:255',
                ]);
                break;

            case 'Furniture and Fixtures':
                $rules = array_merge($rules, [
                    'manufacturer' => 'nullable|string|max:255',
                    'model' => 'required|string|max:255',
                    'material' => 'required|string|max:255',
                    'dimensions' => 'required|string|max:255',
                    'warranty_information' => 'nullable|string|max:255',
                ]);
                break;

            case 'Vehicles':
                $rules = array_merge($rules, [
                    'manufacturer' => 'required|string|max:255',
                    'model' => 'required|string|max:255',
                    'vin_number' => 'required|string|max:255',
                    'license_plate' => 'required|string|max:255',
                    'year_of_manufacture' => 'required|integer',
                    'fuel_type' => 'required|string|max:255',
                    'engine_size' => 'required|string|max:255',
                    'mileage' => 'required|numeric',
                    'assigned_to' => 'required|string|max:255',
                    'license_information' => 'nullable|string|max:255',
                    'warranty_information' => 'nullable|string|max:255',
                ]);
                break;

            case 'Legal Resources':
                $rules = array_merge($rules, [
                    'publisher' => 'required|string|max:255',
                    'author' => 'required|string|max:255',
                    'edition' => 'required|string|max:255',
                    'isbn' => 'required|string|max:255',
                    'publication_year' => 'required|integer',
                    'pages' => 'required|integer',
                    'assigned_to' => 'required|string|max:255',
                ]);
                break;

            default:
                return back()->withInput()->withErrors(['error' => 'Invalid asset category']);
        }

        // Validate the request
        $validatedData = $request->validate($rules);

        // Handle file uploads
        $attachments = $this->storeAttachments($request->attachments);

        // Create the asset using mass assignment
        $asset = Asset::query()->create([
            'slug' => Str::uuid(),
            'asset_id' => $request->asset_id,
            'asset_name' => $request->asset_name,

            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'status' => $request->status,
            'description' => $request->description,
            'purchase_date' => $request->purchase_date,
            'purchase_cost' => $request->purchase_cost,
            'current_value' => $request->current_value,
            'depreciation_method' => $request->depreciation_method,
            'court_id' => $request->court,
            'location_id' => $request->location,
            'region_id' => $request->region,
            'legal_status' => $request->legal_status,
            'ownership' => $request->ownership,
            'gps_address' => $request->gps_address,
            'responsible_office' => $request->responsible_office,
            'position' => $request->position,
            'assigned_to' => $request->assigned_to,
            'attachments' => count($attachments) > 0 ?  json_encode($attachments) : null,
            'maintenance_schedule' => $request->maintenance_schedule,
            'land_area' => $request->land_area,
            'building_size' => $request->building_size,
            'number_of_rooms' => $request->number_of_rooms,
            'year_of_construction' => $request->year_of_construction,
            'manufacturer' => $request->manufacturer,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'warranty_information' => $request->warranty_information,
            'material' => $request->material,
            'dimensions' => $request->dimensions,
            'vin_number' => $request->vin_number,
            'license_plate' => $request->license_plate,
            'year_of_manufacture' => $request->year_of_manufacture,
            'fuel_type' => $request->fuel_type,
            'engine_size' => $request->engine_size,
            'mileage' => $request->mileage,
            'license_information' => $request->license_information,
            'publisher' => $request->publisher,
            'author' => $request->author,
            'edition' => $request->edition,
            'isbn' => $request->isbn,
            'publication_year' => $request->publication_year,
            'pages' => $request->pages,
        ]);

        $this->clearTemporaryFiles($request->attachments);

        return back()->with('success', 'Asset successfully stored');
    }

    private function storeAttachments(array|null $attachments): array
    {
        $storedAttachments = [];

        $disk = Storage::disk('local');
        $files = $disk->files('livewire-tmp');

        foreach ($files as $file) {
            $file_path = explode('livewire-tmp/', $file)[1];
            //store the file found in the temp folder
            if ( in_array($file_path, $attachments) && $disk->exists($file)){
                // Generate a unique file name to avoid conflicts
                $newFileName = uniqid() . '-' . Str::slug(request()->asset_name).'.'. strtolower(substr(strrchr($file, '.'), 1));
                // Store the file in the desired location
                $newFilePath = 'public/attachments/' . $newFileName;
                $disk->move($file, $newFilePath);
                // Add the new file path to the stored attachments array
                $storedAttachments[] = $newFilePath;
            }

        }

        return $storedAttachments;
    }

    private function clearTemporaryFiles(array|null $attachments): void
    {
        if (!empty($attachments) && count($attachments) > 0) {
            foreach ($attachments as $attachment) {
                if (file_exists(storage_path('app/livewire-tmp/' . $attachment))) {
                    unlink(storage_path('app/livewire-tmp/' . $attachment));
                }
            }
        }
    }


    public function showEdit($slug)
    {

        $asset = Asset::query()->with('categories', 'regions', 'locations', 'courts')->where('slug', $slug)->firstOrFail();

        return view('dashboard.assets.edit', compact('asset'));
    }

    public function updateAsset(Request $request, $slug)
    {
        return $request;
    }

    public function showAsset($slug)
    {

        $asset = Asset::query()->with('categories', 'regions', 'locations', 'courts')->where('slug', $slug)->firstOrFail();

        return view('dashboard.assets.show', compact('asset'));
    }
}
