@extends('dashboard.layouts.app')

@section('title', 'Reports by registries')

@section('report_collapse', 'show')
@section('reports_active', 'active')
@section('registry_report_active', 'active')

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="h4 mb-0"><i class="fas fa-chart-pie"></i> Reports: By Registries</h3>
                </div>
            </div>
        </div>

        <div class="d-flex mb-2">
            <h6 class="text-muted me-3">Current Week:</h6>
            <small>{{ getCustomLocalDate($legalYearStart) .' - '. getCustomLocalDate($legalYearEnd) }}</small>
        </div>

    </div>
</div>

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="card mb-3">
            <div class="card-body basic-custome-color">

                @livewire('case-load-by-registry', ['legalYearStart' => $legalYearStart, 'legalYearEnd' => $legalYearEnd])

            </div>
        </div>
    </div>
</div>
@endsection
