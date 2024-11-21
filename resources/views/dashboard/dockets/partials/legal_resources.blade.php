<h5 class="text-info text-uppercase mb-4">Legal Resources</h5>
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
        <div class="col-md-6">
            <label for="purchase_date" class="form-label">Purchase Date</label>
            <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}" required>
            @error('purchase_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="purchase_cost" class="form-label">Purchase Cost</label>
            <input type="number" class="form-control @error('purchase_cost') is-invalid @enderror" id="purchase_cost" name="purchase_cost" value="{{ old('purchase_cost') }}" required>
            @error('purchase_cost')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" value="{{ old('publisher') }}" required>
            @error('publisher')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" required>
            @error('author')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="edition" class="form-label">Edition</label>
            <input type="text" class="form-control @error('edition') is-invalid @enderror" id="edition" name="edition" value="{{ old('edition') }}" required>
            @error('edition')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
            @error('isbn')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="publication_year" class="form-label">Publication Year</label>
            <input type="number" class="form-control @error('publication_year') is-invalid @enderror" id="publication_year" name="publication_year" value="{{ old('publication_year') }}" required maxlength="4">
            @error('publication_year')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-4 mb-3">
            <label for="pages" class="form-label">Number of Pages</label>
            <input type="number" class="form-control @error('pages') is-invalid @enderror" id="pages" name="pages" value="{{ old('pages') }}" required>
            @error('pages')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
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
        <div class="col-md-6">
            <label for="assigned_to" class="form-label">Assigned To</label>
            <input type="text" class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" value="{{ old('assigned_to') }}" required>
            @error('assigned_to')
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
