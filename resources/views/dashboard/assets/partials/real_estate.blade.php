<h5 class="text-info text-uppercase mb-4">Real Estate Asset</h5>
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
        <div class="col-md-12 mb-3">
            <label for="description" class="form-label">Description*</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <hr>
    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <label for="court" class="form-label">Court/Office</label>
            <select class="form-control select2" name="court">
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
        {{--        <div class="col-md-4 mb-3">--}}
        {{--            <label for="legal_status" class="form-label">Legal Status*</label>--}}
        {{--            <select class="form-select select2 @error('legal_status') is-invalid @enderror" id="legal_status" name="legal_status" required>--}}
        {{--                <option value="owned" {{ old('legal_status') == 'owned' ? 'selected' : '' }}>Owned</option>--}}
        {{--                <option value="leased" {{ old('legal_status') == 'leased' ? 'selected' : '' }}>Leased</option>--}}
        {{--                <option value="rented" {{ old('legal_status') == 'rented' ? 'selected' : '' }}>Rented</option>--}}
        {{--            </select>--}}
        {{--            @error('legal_status')--}}
        {{--            <div class="invalid-feedback">{{ $message }}</div>--}}
        {{--            @enderror--}}
        {{--        </div>--}}
        <div class="col-md-4 mb-3">
            <label for="ownership" class="form-label">Ownership</label>
            <select class="form-control select2" name="ownership">
                <option value="">Choose ownership</option>
                @foreach(assetOwnership() as $owner)
                    <option value="{{ $owner }}" {{ old('ownership') == $owner ? 'selected' : '' }}>{{ $owner }}</option>
                @endforeach
            </select>
            @error('ownership')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="condition" class="form-label">Condition</label>
            <select class="form-control select2" name="condition">
                <option value="">Choose condition</option>
                @foreach(assetCondition() as $condition)
                    <option value="{{ $condition }}" {{ old('condition') == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                @endforeach
            </select>
            @error('condition')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="assigned_to" class="form-label">Assigned to: (Judge/officer)</label>
            <input type="text" class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" value="{{ old('assigned_to') }}">
            @error('assigned_to')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="gps_address" class="form-label">GPS address</label>
            <input type="text" class="form-control @error('gps_address') is-invalid @enderror" id="gps_address" name="gps_address" value="{{ old('gps_address') }}">
            @error('gps_address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="house_number" class="form-label">House/Plot number</label>
            <input type="text" class="form-control @error('house_number') is-invalid @enderror" id="house_number" name="house_number" value="{{ old('house_number') }}">
            @error('house_number')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="responsible_office" class="form-label">Officer Responsible for asset</label>
            <input type="text" class="form-control @error('responsible_office') is-invalid @enderror" id="responsible_office" name="responsible_office" value="{{ old('responsible_office') }}">
            @error('responsible_office')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="position" class="form-label">Position</label>
            <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('osition') }}">
            @error('position')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="land_area" class="form-label">Land Area (sq. meters)</label>
            <input type="number" step="0.01" class="form-control @error('land_area') is-invalid @enderror" id="land_area" name="land_area" value="{{ old('land_area') }}">
            @error('land_area')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="building_size" class="form-label">Building Size (sq. meters)</label>
            <input type="number" step="0.01" class="form-control @error('building_size') is-invalid @enderror" id="building_size" name="building_size" value="{{ old('building_size') }}">
            @error('building_size')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="number_of_rooms" class="form-label">Number of Rooms</label>
            <input type="number" class="form-control @error('number_of_rooms') is-invalid @enderror" id="number_of_rooms" name="number_of_rooms" value="{{ old('number_of_rooms') }}">
            @error('number_of_rooms')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="year_of_construction" class="form-label">Year of Purchase/Construction</label>
            <input type="text" class="form-control @error('year_of_construction') is-invalid @enderror" id="year_of_construction" name="year_of_construction" value="{{ old('year_of_construction') }}" placeholder="2024" maxlength="4">
            @error('year_of_construction')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <hr>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}">
            @error('purchase_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="purchase_cost" class="form-label">Purchase Cost</label>
            <input type="number" step="0.01" class="form-control @error('purchase_cost') is-invalid @enderror" id="purchase_cost" name="purchase_cost" value="{{ old('purchase_cost') }}">
            @error('purchase_cost')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="current_value" class="form-label">Current Value</label>
            <input type="number" step="0.01" class="form-control @error('current_value') is-invalid @enderror" id="current_value" name="current_value" value="{{ old('current_value') }}">
            @error('current_value')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
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

    <hr>
    <div class="row mb-3">
        <div class="col-12">
            <label for="attachments" class="form-label">Property Documents</label>
            @livewire('asset-uploader')
            {{--            <input type="file" class="attachments @error('attachments') is-invalid @enderror" id="attachments" name="attachments" >--}}
            @error('attachments')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <label for="maintenance_schedule" class="form-label">Maintenance Schedule and History</label>
            <textarea class="form-control @error('maintenance_schedule') is-invalid @enderror" id="maintenance_schedule" name="maintenance_schedule" rows="3">{{ old('maintenance_schedule') }}</textarea>
            @error('maintenance_schedule')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
