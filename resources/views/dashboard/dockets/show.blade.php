@extends('dashboard.layouts.app')

@section('title', 'Docket details')

@section('title', 'Show case')

@section('setting_active', 'active')

@section('content')

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-file-signature"></i> Court Details
                    >> {{ $docket->name }}</h3>

                    <div class="col-auto d-flex w-sm-100  mt-sm-0">
                        @if (strpos(url()->previous(), '/cases?page=') !== false)
                        <a href="{{ route('cases') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        @else
                        <a href="{{ url()->previous() }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->

        <div class="card mb-4 show-asset">
            <div class="card-header border-bottom pt-2 d-flex justify-content-between">
                <div>
                    @if($docket->status == 'Assigned')
                    <strong>Status: </strong><span class="badge bg-success text-uppercase p-2">{{ $docket->status }}</span>
                    @else
                    <strong>Status: </strong><span class="badge bg-info text-uppercase p-2">{{ $docket->status }}</span>
                    @endif
                </div>
                <div>
                    @can('Update cases')
                    <a href="{{ route('cases.edit', $docket->slug) }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-pencil"></i> Edit case</a>
                        @endcan

                        @canany(['Re-assign cases by category', 'Re-assign commercial cases', 'Re-assign cases by orders'])
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-sync-alt"></i> Re-assign
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                            @can('Re-assign commercial cases')
                            <li><a class="dropdown-item" href="#!">Commercial Case</a></li>
                            @endcan
                            @can('Re-assign cases by categories')
                            <li><a class="dropdown-item" href="{{ route('cases.reassign-by-category', $docket->slug) }}">By Category change</a></li>
                            @endcanany
                            @can('Re-assign cases by orders')
                            <li><a class="dropdown-item" href="#!">By Order</a></li>
                            @endcanany
                        </ul>
                        @endcanany
                    </div>
                </div>
                <div class="card-body">
                    @if ($docket->reassignment_initiated)
                    <div class="alert alert-danger bg-warning alert-dismissible fade show" role="alert">
                      <i class="fas fa-exclamation-triangle"></i> Re-allocation has been initiated for this case.
                        | {{ $docket->reallocation?->approvals_count ?? '0' }} out of  {{  getenv("APPROVAL_STEPS") }} approval  step(s) completed.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="suit_number" class="form-label">Suit number</label>
                            <p class="form-control-plaintext" id="suit_number">{{ $docket->suit_number }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="case_title" class="form-label">Case title</label>
                            <p class="form-control-plaintext" id="case_title">{{ $docket->case_title }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="allocated_court" class="form-label">Allocated court</label>
                            <p class="form-control-plaintext" id="allocated_court">{{ $docket->courts?->name ?? '-'}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="judge" class="form-label">Judge</label>
                            <p class="form-control-plaintext" id="judge">{{ $docket->judges?->name ?? '-'}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <p class="form-control-plaintext" id="location">{{ $docket->locations?->name ?? '-'}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categories" class="form-label">Case category</label>
                            <p class="form-control-plaintext" id="categories">{{ $docket->categories?->name ?? '-'}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categories" class="form-label">Case stage</label>
                            <p class="form-control-plaintext" id="categories">{{ $docket->case_stage ?? '-'}}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="categories" class="form-label">Date of allocation</label>
                            <p class="form-control-plaintext" id="categories">{{ !empty($docket->assigned_date) ? getCustomLocalTime($docket->assigned_date) : '-'  }}</p>
                        </div>
                    </div>

                    @can('Read case metadata')
                    <hr>
                    <small>Metadata</small>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <label for="assign_type" class="form-label">Mode of allocation</label>
                            <p class="form-control-plaintext" id="assign_type">{{ ucfirst($docket->assign_type) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="allocation_by" class="form-label">Allocation by</label>
                            <p class="form-control-plaintext" id="allocation_by">{{ $docket->creators->full_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="created_on" class="form-label">Created on</label>
                            <p class="form-control-plaintext" id="created_on">{{ !empty($docket->created_at) ? getCustomLocalTime($docket->created_at) : '-'  }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="updated_on" class="form-label">Last updated on</label>
                            <p class="form-control-plaintext" id="updated_on">{{ !empty($docket->updated_at) ? getCustomLocalTime($docket->updated_at) : '-'  }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="disposed_at" class="form-label">Disposed status</label>
                            <p class="form-control-plaintext" id="disposed_at">{{ !empty($docket->disposed_at) ? getCustomLocalTime($docket->disposed_at) : 'N/A'  }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <p class="form-control-plaintext" id="priority">{{ ucfirst($docket->priority) }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Reason</label>
                            <p class="form-control-plaintext" id="priority">{{ $docket->reason_for_manual_assignment }}</p>
                        </div>
                        @if($docket->disposed_by)
                        <div class="col-md-6 mb-3">
                            <label for="disposed_by" class="form-label">Disposed by</label>
                            <p class="form-control-plaintext" id="disposed_by">{{ $docket->disposers?->full_name ?? '-'  }}</p>
                        </div>
                        @endif
                    </div>
                    @endcan
                </div>
            </div>


            @can('Read case history')
            <div class="accordion mb-5" id="accordionHistory">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingHistory">
                        <button class="accordion-button collapsed text-uppercase text-info fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory">
                            Historical allocations
                        </button>
                    </h2>
                    <div id="collapseHistory" class="accordion-collapse collapse" aria-labelledby="headingHistory" data-bs-parent="#accordionHistory">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-bordered display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Court</th>
                                            <th>Judge</th>
                                            <th>Location</th>
                                            <th>Date of allocation</th>
                                            <th>Stage</th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($docket->allocations as $allocation)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $allocation->courts?->name ?? ''  }}</td>
                                            <td>{{ $allocation->judges?->name ?? ''  }}</td>
                                            <td>{{ $allocation->locations?->name ?? ''  }}</td>
                                            <td>{{ getCustomLocalTime($allocation->assigned_date ) }}</td>
                                            <td>{{ $allocation->case_stage }}</td>
                                            <td>{{ $allocation->assignment_reason }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('Read court logs')
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed text-uppercase text-info fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Case Activity Logs
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                @livewire('docket-log', ['docket' => $docket])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>

    @endsection
