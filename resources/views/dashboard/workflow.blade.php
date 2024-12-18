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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-2 d-flex bg-info">
                                <span class="text-white m-auto"> {{ count($dockets) }}</span>
                            </div>
                            <div class="col-md-10 p-3 ps-4">
                                <h5 class="card-title fw-bold mb-3">Re-allocation flow</h5>
                                <p class="card-text">Re-allocation submissions pending approvals.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Purchase Orders -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-10 p-3 ps-4">
                                <h5 class="card-title fw-bold mb-3">Case count reset</h5>
                                <p class="card-text">New case count reset pending approval.</p>
                            </div>
                            <div class="col-md-2 d-flex bg-teal">
                                <span class="text-white m-auto"> {{ count($case_counts) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Invoices -->
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-3">Account Requests</h5>
                        <p class="card-text">You have {{ count($dockets) }} account request pending approval and authorizations</p>
                    </div>
                </div>
            </div> --}}
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
                        <div class="card-header border-bottom pt-3">
                            <h5 class="text-info"><i class="fas fa-sync-alt"></i> Re-allocation workflow</h5>
                            <small class="text-muted">Kindly take action to approve cases below for re-allocation.</small>

                        </div>
                        <div class="card-body" style="height: 20rem;overflow-y: auto;">
                            @if(count($dockets) > 0)
                            <ul class="list-group">
                                @foreach($dockets as $docket)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Suit number #{{ $docket->suit_number }}</strong><br>
                                        <small class="text-danger">Initiated {{ $docket->created_at->diffForHumans() }}</small>
                                    </div>
                                    @if (Gate::any(['Approve step one', 'Approve step two', 'Approve step three']) && !$user->hasRole('Super Admin'))

                                    <a href="#!" class="text-success confirm-approval" data-slug="{{ $docket->slug }}" data-suit="{{ $docket->suit_number }}" data-title="{{ $docket->case_title }}" data-oldcategory="{{  $docket->dockets->categories->name }}" data-newcategory="{{  $docket->categories->name }}" data-reason="{{  $docket->reason_for_re_assignment }}">

                                        Approve <i class="fa-solid fa-arrow-right"></i>
                                        <br> <small class="text-muted text-uppercase mt-0">
                                            @if ($user->hasPermissionTo('Approve step one'))
                                            Step one
                                            @elseif ($user->hasPermissionTo('Approve step two'))
                                            Step two
                                            @elseif ($user->hasPermissionTo('Approve step three'))
                                            Step two
                                            @else
                                            -
                                            @endif
                                        </small>
                                    </a>
                                    @else
                                    <small class="text-muted">Waiting approval</small>
                                    @endif
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
                        <div class="card-header border-bottom pt-3">
                            <h5 class="text-teal"><i class="fas fa-circle-dot"></i> Case count Reset workflow</h5>
                            <small class="text-muted">Kindly take action to complete below Case count reset.</small>
                        </div>
                        <div class="card-body" style="height: 20rem;overflow-y: auto;">
                            @if(count($case_counts) > 0)
                            <ul class="list-group">
                                @foreach($case_counts as $case_count)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Suit number #{{ $case_count->suit_number }}</strong><br>
                                        <small class="text-danger">{{ count($case_count->sureties) }} Pending Validation</small><br>
                                    </div>
                                    @can('Validate document')
                                    <a href="{{ route('validate', ['q' => $case_count->suit_number]) }}" class="">Validate <i class="fa-solid fa-arrow-right"></i></a>
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

<div class="modal " id="confirmApprovalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Approval Confirmation</h4>
                <a href="#!" class="close bg-transparent" data-bs-dismiss="modal"><i class="fas fa-times-circle"></i></a>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h5>Are you sure you want to approve this Re-allocation. If approved, this case will be allocated to a new court.</h5>
                <div class="text-uppercase mb-2   mt-4">
                    <strong>Suit number: </strong> <span class="selected_suit_number text-info"></span>
                </div>
                <div class="text-uppercase mb-3">
                    <strong>Case title: </strong> <small class="selected_case_title text-info"></small>
                </div>
                <div class="text-uppercase text-danger mb-3">
                    <i class="fas fa-times-circle me-2"></i><strong>Current Category: </strong> <span class="current_category text-info"></span>
                </div>
                <hr>
                <div class="text-uppercase text-warning mb-3  mt-4">
                    <i class="fas fa-check-circle me-2"></i><strong>New Case Category: </strong> <span class="selected_category text-info"></span>
                </div>
                <div class="text-uppercase mb-3 mt-2">
                    <strong>Reason for Re-allocation: </strong> <small class="reason_for_reallocation text-info"></small>
                </div>


                <input type="hidden" name="release_slug" id="docket_slug">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="proceedApproval">Yes! Approve</button>
            </div>
        </div>
    </div>
</div>



@endsection

