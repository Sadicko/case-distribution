@extends('dashboard.layouts.app')

@section('title', 'Edit case')

@section('cases_collapse', 'show')
@section('case_active', 'active')
@section('create_case_active', 'active')

@section('content')

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> Edit case Edit</h3>

                    <div class="col-auto d-flex w-sm-100  mt-sm-0">
                        @if (strpos(url()->previous(), '/cases?page=') !== false)
                        <a href="{{ url()->previous() }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        @else
                        <a href="{{ route('cases') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->

        <div class="row">
            <div class="card mb-5">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-upload me-1"></i>
                    Edit case
                </div>
                <div class="card-body">

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all()  as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form id="caseForm" method="POST" action="{{ route('cases.edit', $docket->slug) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center  mt-5">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="suit_number" class="form-label">Suit number*</label>
                                    <input class="form-control" type="text" required name="suit_number" id="suit_number" value="{{ old('suit_number', $docket->suit_number) }}">
                                    @error('suit_number')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="case_title" class="form-label">Case title*</label>
                                    <input class="form-control" type="text" required name="case_title" id="case_title" value="{{ old('case_title', $docket->case_title) }}">
                                    @error('case_title')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                {{-- @can('Change case options')
                                <div class="form-group mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($categories) > 0 )  @endif>
                                    <label for="case_category" class="form-label">Case category*</label>
                                    <select name="case_category" class="form-control select2" id="case_category" disabled>
                                        <option value=""></option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('case_category', $docket->category_id) == $category->id ? 'selected' : (count($categories) ==  1 ? 'selected' : '') }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('case_category')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div> --}}
                                {{-- <div class="form-group mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($locations) > 0 )  @endif>
                                    <label for="location" class="form-label">Location*</label>
                                    <select name="location" class="form-control select2" id="location">
                                        <option value=""></option>
                                        @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ old('location', $docket->location_id) == $location->id ? 'selected' : (count($locations) ==  1 ? 'selected' : '')}}>{{ $location->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('location')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div> --}}

                                {{-- <div class="row">
                                    <div class="form-group col-6 mb-3 @cannot('Set case as urgent') d-none @endcannot">
                                        <label for="priority_level" class="form-label">Case priority*</label>
                                        <select name="priority_level" class="form-control select2" id="priority_level">
                                            @foreach(priority_level() as $priority_level)
                                            <option value="{{ $priority_level }}" {{ old('priority_level') == $priority_level ? 'selected' : ($priority_level == 'normal' ? 'selected' : '') }}>{{ ucfirst($priority_level) }}</option>
                                            @endforeach
                                        </select>
                                        @error('priority_level')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                @endcan --}}

                                <div class="row mt-4 mb-5">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary bg-dark float-end">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @endsection

    @section('scripts')
    <script>

        $(function(){

            $(document).on("click", ".assignBtn", function () {
                //|| $('#date_filed').val() == ''
                if($('#suit_number').val() == '' || $('#case_title').val() == '' || $('#case_category').val() == ''  || $('#location').val() == ''){

                    toastr.error('All fields are required.');

                    return;
                }

                $('#assignCaseModal').modal('show');
            })

            $(document).on("click", ".proceedAssignment", function () {

                $('#assignCaseModal').modal('hide');

                $(".loader").show();

                $('#caseForm').submit();
            })



            // validate file upload input
            $(document).on("change", "#formFile", function () {
                if (!checkFile($(this).val())) {
                    toastr.error("File is not a supported type. Upload a csv file.");
                    $(this).val("");
                }
            });

            // input validate function
            function checkFile(val) {
                let valid;
                switch (val.substring(val.lastIndexOf(".") + 1).toLowerCase()) {
                    case "csv":
                    valid = true;
                    break;

                    default:
                    valid = false;
                    break;
                }

                return valid;
            }

        })
    </script>
    @endsection
