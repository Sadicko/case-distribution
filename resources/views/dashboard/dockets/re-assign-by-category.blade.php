@extends('dashboard.layouts.app')

@section('title', 'Re-allocation of case by category')

@section('cases_collapse', 'show')
@section('case_active', 'active')
@section('create_case_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> New case allocation</h3>

                        <div class="col-auto d-flex w-sm-100  mt-sm-0">
                            <a href="{{ route('cases') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row">
                <div class="card mb-5">
                    <div class="card-header bg-dark text-white">
                        <i class="fas fa-upload me-1"></i>
                        Allocate new case
                    </div>
                    <div class="card-body">

                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="fas fa-triangle-exclamation flex-shrink-0 me-2"></i>
                            <div>
                                You are about changing the category of the case. This will trigger a new allocation. the case will now be allocated to courts under the new category when approved. Ensure you have been authorized to perform this action.
                            </div>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all()  as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="caseForm" method="POST" action="{{ route('cases.reassign-by-category', $docket->slug) }}">
                            @csrf
                            <input type="hidden" name="slug" value="{{ $docket->slug }}">
                            <div class="row justify-content-center  mt-5">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="suit_number" class="form-label">Suit number*</label>
                                        <input class="form-control" type="text" required name="suit_number" id="suit_number" value="{{ old('suit_number', $docket->suit_number) }}" disabled>
                                        @error('suit_number')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="case_title" class="form-label">Case title*</label>
                                        <textarea class="form-control no-resize" type="text" required name="case_title" id="case_title" rows="4" disabled>{{ old('case_title',  $docket->case_title) }}</textarea>
                                        @error('case_title')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($categories) > 0 )  @endif>
                                        <label for="case_category" class="form-label">Case category*</label>
                                        <select name="case_category" class="form-control select2" id="case_category">
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" data-name="{{ $category->name }}" {{ old('case_category', $docket->category_id) == $category->id ? 'selected' : (count($categories) ==  1 ? 'selected' : '') }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('case_category')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3 commercial_type_box" @if($errors->any() && count($categories) == 1 && $categories[0]->name == "COMMERCIAL")) @else style="display: none;" @endif>
                                        <label for="commercial_type" class="form-label">Type</label>
                                        <select name="commercial_type" class="form-control select2" id="commercial_type" style="width: 100%">
                                            <option value=""></option>
                                            @foreach(commercial_type() as $type)
                                                <option value="{{ $type }}" {{ old('commercial_type', '') == $type ? 'selected' : ''}}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('commercial_type')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3" @if (in_array(Auth::user()->access_type, registry_level()) && count($locations) > 0 )  @endif>
                                        <label for="location" class="form-label">Location*</label>
                                        <select name="location" class="form-control select2" id="location" disabled>
                                            <option value=""></option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" {{ old('location', $docket->location_id) == $location->id ? 'selected' : (count($locations) ==  1 ? 'selected' : '')}}>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('location')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        {{--                                        <div class="form-group col-6 mb-3">--}}
                                        {{--                                            <label for="date_filed" class="form-label">Date filed*</label>--}}
                                        {{--                                            <input class="form-control date" type="text" required name="date_filed" id="date_filed" value="{{ old('date_filed') }}" placeholder="d/m/Y" autocomplete="off">--}}
                                        {{--                                            @error('date_filed')--}}
                                        {{--                                            <small class="invalid-feedback">{{ $message }}</small>--}}
                                        {{--                                            @enderror--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group col-6 mb-3 d-none">
                                            <label for="priority_level" class="form-label">Case priority*</label>
                                            <select name="priority_level" class="form-control select2" id="priority_level" disabled>
                                                @foreach(priority_level() as $priority_level)
                                                    <option value="{{ $priority_level }}" {{ old('priority_level', $docket->priority_level) == $priority_level ? 'selected' : ($priority_level == 'normal' ? 'selected' : '') }}>{{ ucfirst($priority_level) }}</option>
                                                @endforeach
                                            </select>
                                            @error('priority_level')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="reason" class="form-label">Reason for re-allocation*</label>
                                        <textarea name="reason" id="reason" class="form-control no-resize">{{  old('reason') }}</textarea>
                                        @error('reason')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="row mt-4 mb-5">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary bg-dark float-end assignBtn">Submit for  approval</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="assignCaseModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assignCaseModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title  text-danger" id="assignCaseModalLabel"> <i class="fas fa-exclamation-circle"></i> Case allocation Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Are you sure you want to submit this case for approval? Kindly confirm details below.</h5>
                                <div class="text-uppercase text-danger mb-3  mt-4">
                                    <i class="fas fa-times-circle me-2"></i><strong>Current Category: </strong> <span class="text-info">{{ $docket->categories->name }}</span>
                                </div>
                                <hr>
                                <div class="text-uppercase text-warning mb-3  mt-4">
                                    <i class="fas fa-check-circle me-2"></i><strong>New Case Category: </strong> <span class="selected_category text-info"></span>
                                </div>
                                <div class="text-uppercase mb-3">
                                    <strong>Suit number: </strong> <span class="selected_suit_number text-info"></span>
                                </div>
                                <div class="text-uppercase mb-3">
                                    <strong>Case title: </strong> <span class="selected_case_title text-info"></span>
                                </div>
                                <div class="text-uppercase mb-3">
                                    <strong>Reason for Re-allocation: </strong> <span class="selected_reason text-info"></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary bg-dark proceedAssignment">Yes! Proceed.</button>
                            </div>
                        </div>
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

                $(".selected_suit_number").html( $('#suit_number').val())
                $(".selected_case_title").html( $('#case_title').val())
                $(".selected_category").html( $('#case_category').find('option:selected').data('name'))
                $(".selected_reason").html($('#reason').val())

                if($('#suit_number').val() == '' || $('#case_title').val() == '' || $('#case_category').val() == ''  || $('#location').val() == ''|| $('#reason').val() == ''){

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

            $(document).on("change", "#case_category", function () {
                if($(this).find('option:selected').data('name') === "COMMERCIAL"){
                    $('.commercial_type_box').show();
                }else{
                    $('.commercial_type_box').hide();
                }

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
