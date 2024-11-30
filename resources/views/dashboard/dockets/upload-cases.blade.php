@extends('dashboard.layouts.app')

@section('title', 'Upload preview of cases')

@section('cases_collapse', 'show')
@section('case_active', 'active')
@section('upload_case_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-upload"></i> Bulk case upload</h3>

                        <div class="col-auto d-flex w-sm-100  mt-sm-0">
                            <a href="{{ route('cases') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row">
                <div class="card mb-5">
                    <div class="card-header bg-dark text-white">
                        <div>
                            <i class="fas fa-upload me-1"></i>
                            Bulk upload of cases
                        </div>
                        <div>
                            <small class="text-muted"><i class="fas fa-exclamation-circle"></i> Please note that you can upload a maximum of 500 cases at a time.</small>
                        </div>
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

                        <form class="csv-upload" method="POST" action="{{ route('upload-file') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center mb-5">
                                <div class="col-6">
                                    <div class="form-group mb-3 mt-5" @if (in_array(Auth::user()->access_type, registry_level()) ) style="display: none" @endif>
                                        <label for="case_category" class="form-label">Case category*</label>
                                        <select name="case_category" class="form-control select2" id="case_category" required>
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('case_category') == $category->id ? 'selected' : (count($categories) ==  1 ? 'selected' : '') }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('case_category')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3" @if (in_array(Auth::user()->access_type, registry_level()) ) style="display: none" @endif>
                                        <label for="location" class="form-label">Location*</label>
                                        <select name="location" class="form-control select2" id="location" required>
                                            <option value=""></option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : (count($locations) ==  1 ? 'selected' : '') }}>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5 mt-5">
                                        <label for="formFile" class="form-label text-muted">Select a file.( Only .xlsx and csv files are accepted.)</label>
                                        <input class="form-control" type="file" required name="case_file" id="formFile" accept=".xlsx,.csv">
                                        @error('csv_file')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary bg-dark float-end btn-upload"><i class="fas fa-upload"></i> Upload</button>
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

                if($('#suit_number').val() == '' || $('#case_title').val() == '' || $('#cat').val() == '' || $('#case_category').val() == '' || $('#date_filed').val() == '' || $('#location').val() == '' || $('#priority_level').val() == ''){

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
                    toastr.error("File is not a supported type. Upload a xlsx file.");
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
                    case "xlsx":
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
