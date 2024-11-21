<h5 class="text-info text-uppercase mb-4">Vehicles</h5>
<form method="POST" action="{{ route('assets.create') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="term" value="{{ request()->term }}">
    <input type="hidden" name="category" id="categoryInput">
    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <label for="asset_id" class="form-label">Unique Asset ID*</label>
            <input type="text" class="form-control @error('asset_id') is-invalid @enderror" id="asset_id" name="asset_id" value="{{ old('asset_id', generateAssetId(request()->term)) }}">
            @error('asset_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="subcategory" class="form-label">Sub Category*</label>
            <select class="form-select select2 @error('subcategory') is-invalid @enderror" id="subcategory" name="subcategory" required>
                <option value="">Select Category</option>
                @foreach(subcategories(request()->term) as $childCategory)
                    <option value="{{ $childCategory->id }}" {{ old('subcategory') == $childCategory->id ? 'selected' : '' }}>{{ $childCategory->name }}</option>
                    @if($childCategory->children)
                        @foreach($childCategory->children as $child)
                            @include('dashboard.assets.partials.category_children', ['subCategoryChild' => $child, 'level' => 1])
                        @endforeach
                    @endif
                @endforeach
            </select>
            @error('subcategory')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 mb-3">
            <label for="asset_name" class="form-label">Asset Name*</label>
            <input type="text" class="form-control @error('asset_name') is-invalid @enderror" id="asset_name" name="asset_name" value="{{ old('asset_name') }}">
            @error('asset_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="status" class="form-label">Status*</label>
            <select class="form-control select2" name="status">
                <option value="">Choose status</option>
                @foreach(assetStatus() as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Description*</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" required>
            @error('purchase_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="purchase_cost" class="form-label">Purchase Cost</label>
            <input type="number" class="form-control @error('purchase_cost') is-invalid @enderror" id="purchase_cost" name="purchase_cost" value="{{ old('purchase_cost') }}" required>
            @error('purchase_cost')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="depreciation_method" class="form-label">Depreciation Method</label>
            <select class="form-select select2 @error('depreciation_method') is-invalid @enderror" id="depreciation_method" name="depreciation_method">
                <option value="">Select Depreciation Method</option>
                <option value="straight_line" {{ old('depreciation_method') == 'straight_line' ? 'selected' : '' }}>Straight-Line</option>
                <option value="declining_balance" {{ old('depreciation_method') == 'declining_balance' ? 'selected' : '' }}>Declining Balance</option>
                <option value="double_declining_balance" {{ old('depreciation_method') == 'double_declining_balance' ? 'selected' : '' }}>Double Declining Balance</option>
                <option value="sum_of_the_years_digits" {{ old('depreciation_method') == 'sum_of_the_years_digits' ? 'selected' : '' }}>Sum of the Years' Digits</option>
                <option value="units_of_production" {{ old('depreciation_method') == 'units_of_production' ? 'selected' : '' }}>Units of Production</option>
            </select>
            @error('depreciation_method')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <label for="manufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}" required>
            @error('manufacturer')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="model" class="form-label">Model</label>
            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" required>
            @error('model')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="vin_number" class="form-label">Vehicle Identification Number (VIN)</label>
            <input type="text" class="form-control @error('vin_number') is-invalid @enderror" id="vin_number" name="vin_number" value="{{ old('vin_number') }}" required>
            @error('vin_number')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="license_plate" class="form-label">License Plate Number</label>
            <input type="text" class="form-control @error('license_plate') is-invalid @enderror" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" required>
            @error('license_plate')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="year_of_manufacture" class="form-label">Year of Manufacture</label>
            <input type="number" class="form-control @error('year_of_manufacture') is-invalid @enderror" id="year_of_manufacture" name="year_of_manufacture" value="{{ old('year_of_manufacture') }}" required placeholder="2024" maxlength="4">
            @error('year_of_manufacture')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="fuel_type" class="form-label">Fuel Type*</label>
            <select class="form-control select2" name="fuel_type">
                <option value="">Choose fuel_type</option>
                @foreach(fuelType() as $fuel_type)
                    <option value="{{ $fuel_type }}" {{ old('fuel_type') == $fuel_type ? 'selected' : '' }}>{{ $fuel_type }}</option>
                @endforeach
            </select>
            @error('fuel_type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="engine_size" class="form-label">Engine Size</label>
            <input type="text" class="form-control @error('engine_size') is-invalid @enderror" id="engine_size" name="engine_size" value="{{ old('engine_size') }}" required placeholder="2024">
            @error('engine_size')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="mileage" class="form-label">Mileage</label>
            <input type="text" class="form-control @error('mileage') is-invalid @enderror" id="mileage" name="mileage" value="{{ old('mileage') }}" required placeholder="2024">
            @error('mileage')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <label for="court" class="form-label">Court/Office*</label>
            <select class="form-control select2" name="court" required>
                <option value="">Choose court</option>
                @foreach($courts as $court)
                    <option value="{{ $court->id }}" {{ old('court') == $court->id ? 'selected' : '' }}>{{ $court->name }}</option>
                @endforeach
            </select>
            @error('court')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="location" class="form-label">Location*</label>
            <select class="form-control select2" name="location" required>
                <option value="">Choose location</option>
                @foreach($locations as $location)
                    <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                @endforeach
            </select>
            @error('location')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="region" class="form-label">Region*</label>
            <select class="form-control select2" name="region" required>
                <option value="">Choose region</option>
                @foreach($regions as $region)
                    <option value="{{ $region->id }}" {{ old('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </select>
            @error('region')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="assigned_to" class="form-label">Assigned To</label>
            <input type="text" class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" value="{{ old('assigned_to') }}">
            @error('assigned_to')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="license_information" class="form-label">Licence Information</label>
            <textarea class="form-control @error('license_information') is-invalid @enderror" id="license_information" name="license_information">{{ old('license_information') }}</textarea>
            @error('license_information')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="warranty_information" class="form-label">Warranty Information</label>
            <textarea class="form-control @error('warranty_information') is-invalid @enderror" id="warranty_information" name="warranty_information">{{ old('warranty_information') }}</textarea>
            @error('warranty_information')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4">
            <label for="maintenance_schedule" class="form-label">Maintenance Schedule and History</label>
            <textarea class="form-control @error('maintenance_schedule') is-invalid @enderror" id="maintenance_schedule" name="maintenance_schedule" rows="3">{{ old('maintenance_schedule') }}</textarea>
            @error('maintenance_schedule')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="documents" class="form-label">Attached Documents</label>
        @livewire('asset-uploader')
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>
