@extends('dashboard.layouts.app')

@section('title', 'New Asset')

@section('asset_collapse', 'show')
@section('assets_active', 'active')
@section('create_asset_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> New Asset</h3>

                        <div class="col-auto d-flex w-sm-100  mt-sm-0">
                            <a href="{{ route('assets') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>

                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Capture Asset Records</h2>
                    <form action="{{ route('assets.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="asset_id" class="form-label">Unique Asset ID*</label>
                                <input type="text" class="form-control @error('asset_id') is-invalid @enderror" id="asset_id" name="asset_id" value="{{ old('asset_id') }}">
                                @error('asset_id')
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
                                    <option value=""></option>
                                    @foreach(assetStatus() as $status)
                                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3" wire:ignore >
                                <label for="description" class="form-label">Description*</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category*</label>
                                <select class="form-control select2 @error('category') is-invalid @enderror" id="category" name="category">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="subcategory" class="form-label">Subcategory</label>
                                <select class="form-control select2 @error('subcategory') is-invalid @enderror" id="subcategory" name="subcategory">
                                    <option value=""></option>
                                    @foreach($categories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ old('subcategory') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input type="date" class="form-control @error('purchase_date') is-invalid @enderror" id="purchase_date" name="purchase_date" value="{{ old('purchase_date') }}">
                                @error('purchase_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="purchase_cost" class="form-label">Purchase Cost</label>
                                <input type="number" class="form-control @error('purchase_cost') is-invalid @enderror" id="purchase_cost" name="purchase_cost" value="{{ old('purchase_cost') }}">
                                @error('purchase_cost')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="current_value" class="form-label">Current Value</label>
                                <input type="number" class="form-control @error('current_value') is-invalid @enderror" id="current_value" name="current_value" value="{{ old('current_value') }}">
                                @error('current_value')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="depreciation_method" class="form-label">Depreciation Method</label>
                                <input type="text" class="form-control @error('depreciation_method') is-invalid @enderror" id="depreciation_method" name="depreciation_method" value="{{ old('depreciation_method') }}">
                                @error('depreciation_method')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                                @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="assignment" class="form-label">Assignment</label>
                                <input type="text" class="form-control @error('assignment') is-invalid @enderror" id="assignment" name="assignment" value="{{ old('assignment') }}">
                                @error('assignment')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="manufacturer" class="form-label">Manufacturer</label>
                                <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}">
                                @error('manufacturer')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}">
                                @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number') }}">
                                @error('serial_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="warranty_information" class="form-label">Warranty Information</label>
                                <input type="text" class="form-control @error('warranty_information') is-invalid @enderror" id="warranty_information" name="warranty_information" value="{{ old('warranty_information') }}">
                                @error('warranty_information')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="maintenance_schedule" class="form-label">Maintenance Schedule</label>
                                <textarea class="form-control @error('maintenance_schedule') is-invalid @enderror" id="maintenance_schedule" name="maintenance_schedule">{{ old('maintenance_schedule') }}</textarea>
                                @error('maintenance_schedule')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="maintenance_history" class="form-label">Maintenance History</label>
                                <textarea class="form-control @error('maintenance_history') is-invalid @enderror" id="maintenance_history" name="maintenance_history">{{ old('maintenance_history') }}</textarea>
                                @error('maintenance_history')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="attached_documents" class="form-label">Attached Documents</label>
                                <input type="file" class="form-control @error('attached_documents') is-invalid @enderror" id="attached_documents" name="attached_documents[]" multiple>
                                @error('attached_documents')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="custom_fields" class="form-label">Custom Fields</label>
                                <input type="text" class="form-control @error('custom_fields') is-invalid @enderror" id="custom_fields" name="custom_fields" value="{{ old('custom_fields') }}">
                                @error('custom_fields')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('plugins/ckeditor5/build/ckeditor.js') }}"></script>
    <script>
        $(function(){

            if ($("#description").length > 0) {
                ClassicEditor.create(document.querySelector("#description"), {
                    toolbar: [
                        "heading",
                        "bold",
                        "italic",
                        "underline",
                        "bulletedList",
                        "numberedList",
                        "blockQuote",
                        "undo",
                        "redo",
                    ],
                }).catch((error) => {
                    // console.error( error );
                });
            }

            // if ($("#message").length > 0) {
            //     ClassicEditor.create(document.querySelector("#message"), {
            //         toolbar: {
            //             items: [
            //                 "heading",
            //                 "|",
            //                 "bold",
            //                 "italic",
            //                 "underline",
            //                 "fontBackgroundColor",
            //                 "fontColor",
            //                 "bulletedList",
            //                 "numberedList",
            //                 "|",
            //                 "outdent",
            //                 "indent",
            //                 "|",
            //                 "link",
            //                 // "imageUpload",
            //                 "imageInsert",
            //                 "blockQuote",
            //                 "insertTable",
            //                 "mediaEmbed",
            //                 "|",
            //                 "findAndReplace",
            //                 "highlight",
            //                 "horizontalLine",
            //                 "todoList",
            //                 "|",
            //                 "undo",
            //                 "redo",
            //             ],
            //         },
            //         language: "en",
            //         image: {
            //             toolbar: [
            //                 "imageTextAlternative",
            //                 "imageStyle:inline",
            //                 "imageStyle:block",
            //                 "imageStyle:side",
            //             ],
            //         },
            //         table: {
            //             contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
            //         },
            //         licenseKey: "",
            //     })
            //         .then((editor) => {
            //             window.editor = editor;
            //         })
            //         .catch((error) => {
            //             // console.error("Oops, something went wrong!");
            //             // console.error(
            //             //     "Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:"
            //             // );
            //             // console.warn("Build id: sna63xj372k1-w7zscwfmw8k3");
            //             // console.error(error);
            //         });
            // }

        })
    </script>
@endsection
