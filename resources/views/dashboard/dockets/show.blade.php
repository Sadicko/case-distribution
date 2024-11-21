@extends('dashboard.layouts.app')

@section('title', 'Asset details')

@section('asset_collapse', 'show')
@section('assets_active', 'active')
@section('list_assets_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> Asset Details >> {{ $asset->asset_name }}</h3>

                        <div class="col-auto d-flex w-sm-100  mt-sm-0">
                            <a href="{{ route('assets') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="card mb-4 show-asset">
                <div class="card-header border-bottom pt-2">
                    @if($asset->asset_state == 'approved')
                        <span class="badge bg-success text-uppercase">{{ $asset->asset_state }}</span>
                    @else
                        <span class="badge bg-warning text-uppercase">{{ $asset->asset_state }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="asset_id" class="form-label">Asset ID</label>
                            <p class="form-control-plaintext" id="asset_id">{{ $asset->asset_id }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="asset_name" class="form-label">Asset Name</label>
                            <p class="form-control-plaintext" id="asset_name">{{ $asset->asset_name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <p class="form-control-plaintext" id="category">{{ $asset->categories->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="subcategory" class="form-label">Subcategory</label>
                            <p class="form-control-plaintext" id="subcategory">{{ $asset->sub_category }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <p class="form-control-plaintext" id="status">{{ $asset->status }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="condition" class="form-label">Condition</label>
                            <p class="form-control-plaintext" id="condition">{{ $asset->condition ?? '-' }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <p class="form-control-plaintext" id="description">{!! $asset->description ?? '-' !!}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <p class="form-control-plaintext" id="location">{{ $asset->locations?->name ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="region" class="form-label">Region</label>
                            <p class="form-control-plaintext" id="region">{{ $asset->regions->name ?? '-'}}</p>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="assigned_to" class="form-label">Assigned To: (Judge/officer)</label>
                            <p class="form-control-plaintext" id="assigned_to">{{ $asset->assigned_to ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="purchase_cost" class="form-label">Purchase Cost</label>
                            <p class="form-control-plaintext" id="purchase_cost">{{ $asset->purchase_cost ?? '-' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="current_value" class="form-label">Current Value</label>
                            <p class="form-control-plaintext" id="current_value">{{ $asset->current_value ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="depreciation_method" class="form-label">Depreciation Method</label>
                            <p class="form-control-plaintext" id="depreciation_method">{{ $asset->depreciation_method ?? '-'  }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="purchase_date" class="form-label">Purchase Date</label>
                            <p class="form-control-plaintext" id="purchase_date">{{ $asset->purchase_date ?? '-' }}</p>
                        </div>
                    </div>


                    <hr>
                    <!-- Real Estate Specific Fields -->
                    @if($asset->categories->name == 'Real Estate')
                        <h3>Real Estate Details</h3>
                        <div class="row">
                            @if($asset->legal_status)
                                <div class="col-md-12 mb-3">
                                    <label for="legal_status" class="form-label">Legal Status</label>
                                    <p class="form-control-plaintext" id="legal_status">{{ $asset->legal_status }}</p>
                                </div>
                            @endif
                            <div class="col-md-12 mb-3">
                                <label for="ownership" class="form-label">Ownership</label>
                                <p class="form-control-plaintext" id="ownership">{{ $asset->ownership ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gps_address" class="form-label">GPS address</label>
                                <p class="form-control-plaintext" id="gps_address">{{ $asset->gps_address ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="house_number" class="form-label">House/Plot number</label>
                                <p class="form-control-plaintext" id="house_number">{{ $asset->house_numbers ?? '-'}}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="responsible_office" class="form-label">Officer Responsible for asset</label>
                                <p class="form-control-plaintext" id="responsible_office">{{ $asset->responsible_office ?? '-' }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="position" class="form-label">Position</label>
                                <p class="form-control-plaintext" id="position">{{ $asset->position ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="land_area" class="form-label">Land Area</label>
                                <p class="form-control-plaintext" id="land_area">{{ $asset->land_area ?? '-'  }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="building_size" class="form-label">Building Size</label>
                                <p class="form-control-plaintext" id="building_size">{{ $asset->building_size ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="number_of_rooms" class="form-label">Number of Rooms</label>
                                <p class="form-control-plaintext" id="number_of_rooms">{{ $asset->number_of_rooms ?? '-'  }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="year_of_construction" class="form-label">Year of Construction</label>
                                <p class="form-control-plaintext" id="year_of_construction">{{ $asset->year_of_construction ?? '-' }}</p>
                            </div>
                        </div>

                    @endif

                    <!-- ICT Equipment Specific Fields -->
                    @if($asset->categories->name == 'ICT Equipment')
                        <h3>ICT Equipment Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="manufacturer" class="form-label">Manufacturer</label>
                                <p class="form-control-plaintext" id="manufacturer">{{ $asset->manufacturer }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="model" class="form-label">Model</label>
                                <p class="form-control-plaintext" id="model">{{ $asset->model }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <p class="form-control-plaintext" id="serial_number">{{ $asset->serial_number }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Furniture and Fixtures Specific Fields -->
                    @if($asset->categories->name == 'Furniture and Fixtures')
                        <h3>Furniture and Fixtures Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="material" class="form-label">Material</label>
                                <p class="form-control-plaintext" id="material">{{ $asset->material }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dimensions" class="form-label">Dimensions</label>
                                <p class="form-control-plaintext" id="dimensions">{{ $asset->dimensions }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Vehicles Specific Fields -->
                    @if($asset->categories->name == 'Vehicles')
                        <h3>Vehicles Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vin_number" class="form-label">VIN Number</label>
                                <p class="form-control-plaintext" id="vin_number">{{ $asset->vin_number }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="license_plate" class="form-label">License Plate</label>
                                <p class="form-control-plaintext" id="license_plate">{{ $asset->license_plate }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="year_of_manufacture" class="form-label">Year of Manufacture</label>
                                <p class="form-control-plaintext" id="year_of_manufacture">{{ $asset->year_of_manufacture }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fuel_type" class="form-label">Fuel Type</label>
                                <p class="form-control-plaintext" id="fuel_type">{{ $asset->fuel_type }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="engine_size" class="form-label">Engine Size</label>
                                <p class="form-control-plaintext" id="engine_size">{{ $asset->engine_size }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mileage" class="form-label">Mileage</label>
                                <p class="form-control-plaintext" id="mileage">{{ $asset->mileage }}</p>
                            </div>
                        </div>
                        <!-- Maintenance Schedule -->
                        <h3>License Information</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                {!! $asset->license_information ?? '-' !!}
                            </div>
                        </div>
                    @endif

                    <!-- Legal Resources Specific Fields -->
                    @if($asset->categories->name == 'Legal Resources')
                        <h3>Legal Resources Details</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="publisher" class="form-label">Publisher</label>
                                <p class="form-control-plaintext" id="publisher">{{ $asset->publisher }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="author" class="form-label">Author</label>
                                <p class="form-control-plaintext" id="author">{{ $asset->author }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="edition" class="form-label">Edition</label>
                                <p class="form-control-plaintext" id="edition">{{ $asset->edition }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <p class="form-control-plaintext" id="isbn">{{ $asset->isbn }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="publication_year" class="form-label">Publication Year</label>
                                <p class="form-control-plaintext" id="publication_year">{{ $asset->publication_year }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="pages" class="form-label">Pages</label>
                                <p class="form-control-plaintext" id="pages">{{ $asset->pages }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Attachments -->
                    @if($asset->attachments)
                        <h3 class="mb-4">Attachments</h3>
                        <ul>
                            @foreach(json_decode($asset->attachments, true) as $attachment)
                                <li><a href="{{ Storage::disk('local')->url($attachment) }}" class="text-info" target="_blank">{{ basename($attachment) }} <i class="fa-solid fa-external-link-alt"></i></a></li>
                            @endforeach
                        </ul>
                    @endif

                    <hr>
                    <!-- Warranty Information -->
                    @if($asset->warranty_information)
                        <h3>Warranty Information</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                {!! $asset->warranty_information ?? '-' !!}
                            </div>
                        </div>
                    @endif

                    <!-- Maintenance Schedule -->
                    @if($asset->maintenance_schedule )
                        <h3>Maintenance Schedule</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                {!! $asset->maintenance_schedule ?? '-' !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>

@endsection
