@extends('dashboard.layouts.app')

@section('title', 'Print case')

@section('cases_collapse', 'show')
@section('case_active', 'active')
@section('create_case_active', 'active')

@section('styles')
    <style>
        @media print {
            @page {
                size: A3;
            }

            .print-button {
                display: none;
            }

            .print-area {
                display: block !important;
            }

            .non-printable {
                display: none !important;
            }
            .invoice img{
                width: 100px;
                height: 100px
            }
        }

        .invoice img{
            width: 100px;
            height: 100px
        }
        .invoice .col-md-10{
            font-size: 13px;
            font-weight: 400;
        }

        .invoice .col-md-2{
            font-size: 13px;
            font-weight: bolder;
        }
        .text-uppercase{
            text-transform: uppercase;
        }
    </style>
@endsection


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> Print case</h3>

                        <div class="col-auto d-flex w-sm-100  mt-sm-0">
                            <a href="{{ route('cases') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>
    <section class="content invoice" id="print-area">
        <div class="border p-4 border-dark  print-area">
            <div class="row justify-content-center text-center">
                <h3 class="text-uppercase">JUDICIAL SERVICE OF GHANA</h3>
                <img src="{{ asset('images/coat_of_arms.png') }}" alt="coat_of_arms">
            </div>


            <h3 class="text-uppercase mb-5">Case Allocation</h3>
            <div class="row mt-2">
                <div class="col-md-2">
                    Case Title:
                </div>
                <div class="col-md-9  text-uppercase">
                    {{ $docket->case_title }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Suit number:
                </div>
                <div class="col-md-10  text-uppercase">
                    {{ $docket->suit_number ?? '-'}}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Allocated court
                </div>
                <div class="col-md-10 text-uppercase">
                    {{ $docket->courts->name }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Location
                </div>
                <div class="col-md-10 text-uppercase">
                    {{ $docket->locations->name }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Judge name:
                </div>
                <div class="col-md-10 text-uppercase">
                    {{ $docket->courts?->currentJudge[0]?->name ?? '-' }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Case category:
                </div>
                <div class="col-md-10  text-uppercase">
                    {{ $docket->categories->name }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Date filed:
                </div>
                <div class="col-md-10  text-uppercase">
                    {{ $docket->date_filed->format('d-m-Y') }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    Date allocated:
                </div>
                <div class="col-md-10  text-uppercase">
                    {{ $docket->assigned_date->format('d-m-Y') }}
                </div>
            </div>
        </div>
    </section>

    <div class="mt-4 mb-5 d-flex">
        <button class="btn btn-primary m-auto btn-sm bg-gradient-primary print-button" onclick="printContent()">Print Invoice</button>
    </div>
@endsection

@section('scripts')
    <script>
        function printContent() {
            const printArea = document.getElementById('print-area').innerHTML;
            const originalContent = document.body.innerHTML;

            // Replace body content with the print area
            document.body.innerHTML = printArea;

            // Trigger the print dialog
            window.print();

            // Restore the original content
            document.body.innerHTML = originalContent;

            // Reload the scripts (if needed)
            window.location.reload();
        }
    </script>
@endsection
