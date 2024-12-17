@extends('dashboard.layouts.app')

@section('title', 'Workflow')

@section('workflow_active', 'active')

@section('content')
        <div class="body">
            <div class="container">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="h4 mb-0">Workflow</h3>
                        </div>
                    </div>
                </div> <!-- Row end  -->
            </div>
        </div>

        <div class="body">
            <div class="container">
                <div class="d-flex mb-3">
                    <h6 class="text-muted me-3">LEGAL YEAR:</h6>
                    <small>{{ getCustomLocalDate($legalYearStart) .' - '. getCustomLocalDate($legalYearEnd) }}</small>
                </div>

            </div>
        </div>

    <div class="body d-flex">
    <div class="container-xxl p-0">
        <div class="row">
            <!-- pendingBails -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Re-allocation flow</h5>
                        <p class="card-text">You have {{ count($dockets) }} re-allocation submissions pending approvals.</p>
                    </div>
                </div>
            </div>

            <!-- Purchase Orders -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Case count reset</h5>
                        <p class="card-text">You have {{ count($dockets) }} new case count reset pending approval.</p>
                    </div>
                </div>
            </div>

            <!-- Invoices -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Account Requests</h5>
                        <p class="card-text">You have {{ count($dockets) }} account request pending approval and authorizations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="body d-flex mt-4">
    <div class="container-xxl p-0">
        <!-- Conversion Options -->
        <div class="mt-4">
            <h3>Recent workflow</h3>
            <p>Actions required to proceed case allocations.</p>

            <!-- pendingBails Workflow -->
            <div class="row mt-4">
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h5 class="text-info"><i class="fas fa-sync-alt"></i> Re-allocation workflow</h5>
                            <small class="text-muted">Kindly take action to approve cases below for re-allocation.</small>

                        </div>
                        <div class="card-body" style="height: 20rem;overflow-y: auto;">
                            @if(count($dockets) > 0)
                            <ul class="list-group">
                                @foreach($pendingBails as $pendingBail)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Suit number #{{ $pendingBail->suit_number }}</strong><br>
                                        <small class="text-danger">Bail granted {{ $pendingBail->date_granted->diffForHumans() }}</small>
                                    </div>
                                    @can('Release bail')
                                    <a href="#!" class="text-success releaseBail" data-slug="{{ $pendingBail->slug }}">Release <i class="fa-solid fa-arrow-right"></i></a>
                                    @endcan
                                </li>
                                @endforeach
                            </ul>
                            @else
                             <div class="d-flex h-100">
                                <span class="text-muted pt-5 pb-5 mt-5 mb-5 text-center m-auto">No workflows available</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Purchase Orders -->
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h5 class="text-info"><i class="fas fa-person"></i> Case count Reset workflow</h5>
                            <small class="text-muted">Kindly take action to complete below Case count reset.</small>
                        </div>
                        <div class="card-body" style="height: 20rem;overflow-y: auto;">
                            @if(count($dockets) > 0)
                            <ul class="list-group">
                                @foreach($bails as $bail)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Suit number #{{ $bail->suit_number }}</strong><br>
                                        <small class="text-danger">{{ count($bail->sureties) }} Pending Validation</small><br>
                                    </div>
                                    @can('Validate document')
                                    <a href="{{ route('validate', ['q' => $bail->suit_number]) }}" class="">Validate <i class="fa-solid fa-arrow-right"></i></a>
                                    @endcan
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <div class="d-flex h-100">
                                <span class="text-muted pt-5 pb-5 mt-5 mb-5 text-center m-auto">No workflows available</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

