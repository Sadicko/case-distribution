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

            <div class="row">
                <div class="card">
                    <div class="card-header border-bottom pt-3 pb-3">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label for="category" class="mb-2">Choose category to continue</label>
                                <select class="form-control select2 @error('category') is-invalid @enderror" id="category-select" name="category">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-name="{{ $category->name }}" {{ old('category') == $category->id ? 'selected' : (request()->term == $category->name ? 'selected' : '' ) }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if ($term)
                        <div class="card-body">
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @switch($term)
                                @case('Real Estate') <!-- Real Estate -->
                                @include('dashboard.assets.partials.real_estate')
                                @break
                                @case('ICT Equipment') <!-- ICT Equipment -->
                                @include('dashboard.assets.partials.ict_equipment')
                                @break
                                @case('Furniture and Fixtures') <!-- Furniture and Fixtures -->
                                @include('dashboard.assets.partials.furniture_and_fixtures')
                                @break
                                @case('Vehicles') <!-- Vehicles -->
                                @include('dashboard.assets.partials.vehicles')
                                @break
                                @case('Office Equipment') <!-- Office Equipment -->
                                @include('dashboard.assets.partials.office_equipment')
                                @break
                                @case('Legal Resources') <!-- Legal Resources -->
                                @include('dashboard.assets.partials.legal_resources')
                                @break
                                {{--                    @default--}}

                            @endswitch
                        </div>
                    @else
                        <div class="card-body d-flex" style="height: 50vh">
                            <h5 class="text-muted m-auto">Choose a category above to proceed.</h5>
                        </div>
                    @endif

                </div>

            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="{{ asset('plugins/ckeditor5/build/ckeditor.js') }}"></script>
    <script>

        $(function(){

            $(document).on('change', '#category-select', function() {
                // Get the selected option
                var selectedOption = $(this).find('option:selected');
                // Store the selected value in localStorage
                localStorage.setItem('category', selectedOption.val());

                var categoryName = selectedOption.data('name');

                // Construct the URL
                var url = '{{ route('assets.create') }}?term=' + encodeURIComponent(categoryName);

                // Redirect to the URL
                window.location.href = url;
            });

            //set the category
            $('#categoryInput').val( localStorage.getItem('category'));


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

            if ($("#maintenance_schedule").length > 0) {
                ClassicEditor.create(document.querySelector("#maintenance_schedule"), {
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

            if ($("#warranty_information").length > 0) {
                ClassicEditor.create(document.querySelector("#warranty_information"), {
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

            if ($("#license_information").length > 0) {
                ClassicEditor.create(document.querySelector("#license_information"), {
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


        })
    </script>
@endsection
