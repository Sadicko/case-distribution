@extends('dashboard.layouts.app')

@section('title', 'Update cases')

@section('cases_collapse', 'show')
@section('case_active', 'active')
@section('create_case_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-upload"></i> Upload preview</h3>

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
                        File new case
                    </div>
                    <div class="card-body">
                        <div>
                            <small class="text-muted">
                                Showing {{count($rows)}} of {{count(session()->get('import_data'))}} entries in the Excel File. Does your data look correct?
                            </small>
                        </div>

                        <form action="{{ route('upload-cases.import') }}" method="POST">
                            @csrf
                            <input type="hidden" name="case_category" value="{{ $category->id }}">
                            <input type="hidden" name="location" value="{{ $location->id }}">

                            <table class="table table-boarded">
                                <thead>
                                <tr>
                                    <th>#!</th>
                                    <th>Suit Number</th>
                                    <th>Case Title</th>
                                    <th>Date Of Filing</th>
                                    <th>Case Category</th>
                                    <th>Case Location</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row['suit_number'] }}</td>
                                        <td>{{ $row['case_title'] }}</td>
                                        <td>{{ $row['date_filed'] }}</td>
                                        <td>{{ $row['case_category'] }}</td>
                                        <td>{{ $row['location'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="mt-5">
                                <a href="{{route('upload-cases')}}" class="btn btn-secondary">No, try again</a>
                                <button type="submit" class="btn btn-primary">Proceed imports</button>
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
