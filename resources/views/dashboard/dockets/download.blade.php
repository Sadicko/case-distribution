@extends('dashboard.layouts.app')

@section('title', 'Download case')

@section('styles')
    <style>
        @media print {
            @page {
                size: A5;
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
            img{
                width: 100px;
                height: 100px;
                object-fit: contain;
            }
            .col-md-2{
                font-size: 10px;
                font-weight: bolder !important;
            }
            .col-md-10, .col-md-9{
                font-size: 11px;
                font-weight: 400;
            }

            .custom-footer{
                display: block !important;
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
        .custom-footer {
            position: fixed;
            bottom: 10mm;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 10pt;
            color: #333;
        }

    </style>
@endsection


@section('content')
    <section class="content invoice" id="print-area">
        <div class="border p-4 border-dark  print-area">
            <div class="row justify-content-center text-center">
                <h3 class="text-uppercase">JUDICIAL SERVICE OF GHANA</h3>
                <h5 class="text-uppercase">ELECTRONIC CASE DISTRIBUTION SYSTEM</h5>
                <img src="{{ asset('images/coat_of_arms.png') }}" alt="coat_of_arms">
            </div>


            <h3 class="text-uppercase mb-3 fw-bolder">Case Allocation</h3>
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

        <div class="custom-footer " style="display: none">
            <p style="font-size: 9px;">Powered by Judicial Service ICT</p>
        </div>
    </section>



    <div class="mt-4 mb-5 d-flex justify-content-center">
        <button class="btn btn-primary btn-sm me-3 bg-gradient-primary print-button" onclick="printContent()"><i class="fas fa-print"></i> Print Confirmation</button>
        @can('Download cases')
            <a href="{{ route('cases.download', $docket->slug) }}" class="btn btn-primary btn-sm bg-gradient-primary print-button"><i class="fas fa-download"></i> Download Confirmation</a>
        @endcan
    </div>
@endsection
