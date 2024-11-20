@extends('dashboard.layouts.app')

@section('title', 'Workflow')

@section('workflow_active', 'active')

@section('content')

<div class="body d-flex">
    <div class="container-xxl p-0">
        <div class="d-flex mb-3">
            <h6 class="text-muted me-3">LEGAL YEAR:</h6>
            <small>{{ getCustomLocalDate($legalYearStart) .' - '. getCustomLocalDate($legalYearEnd) }}</small>
        </div>

    </div>
</div>

<div class="body d-flex">
    <div class="container-xxl p-0">
        <div class="row mt-4">
            <!-- pendingBails -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Granted bail</h5>
                        <p class="card-text">You have {{ count($bails) }} new bail pending execution.</p>
                    </div>
                    @can('Manage bail')
                    <div class="card-footer text-center">
                        <a href="{{ route('bail') }}"><i class="fas fa-arrow-right"></i> View bail</a>
                    </div>
                    @endcan
                </div>
            </div>

            <!-- Purchase Orders -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Release</h5>
                        <p class="card-text">You have {{ count($pendingBails) }} executed bail pending Release.</p>
                    </div>
                    @can('Release bail')
                    <div class="card-footer text-center">
                        <a href="{{ route('bail') }}"><i class="fas fa-arrow-right"></i> bail pending Release</a>
                    </div>
                    @endcan
                </div>
            </div>

            <!-- Invoices -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Validation</h5>
                        <p class="card-text">You have {{ count($bails) }} cases with pending document validation.</p>
                    </div>
                    @can('Validate document')
                    <div class="card-footer text-center">
                        <a href=""><i class="fas fa-arrow-right"></i> Go to validation</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>


<div class="body d-flex">
    <div class="container-xxl p-0">
        <!-- Conversion Options -->
        <div class="mt-4">
            <h3>Recent workflow</h3>
            <p>Actions required to proceed bail execution.</p>

            <!-- pendingBails Workflow -->
            <div class="row mt-4">
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-info"><i class="fas fa-folder-open"></i> Bail workflow</h5>
                            <small>Kindly take action to release below.</small>

                        </div>
                        <div class="card-body" style="height: 20rem;overflow-y: auto;">
                            @if(count($pendingBails) > 0)
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
                            <span class="text-muted pt-5 pb-5 mt-5 mb-5 text-center">No workflows available</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Purchase Orders -->
                <div class="col-md-6 mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-info"><i class="fas fa-bag-shopping"></i> Validation workflow</h5>
                            <small>Kindly take action to complete below validations.</small>
                        </div>
                        <div class="card-body" style="height: 20rem;overflow-y: auto;">
                            @if(count($bails) > 0)
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
                            <span class="text-muted pt-5 pb-5 mt-5 mb-5 text-center">No workflows available</span>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="col-md-12 mb-5">
                    <h5>Recommended Workflow</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <p><i class="fas fa-plus"></i>  Create:</p>
                            @can('Create bail')
                            <p><a href="{{ route('bail.create') }}" class="text-orange">New bail</a></p>
                            @endcan
                        </div>

                        <div class="col-md-3">
                            <p><i class="fas fa-check"></i> Validation:</p>
                            @can('Validate document')
                            <p><a href="{{ route('validate') }}" class="text-orange">Validate document</a></p>
                            @endcan
                        </div>

                        <div class="col-md-3">
                            <p><i class="fas fa-search"></i> Search:</p>
                            @can('Search document')
                            <p><a href="{{ route('search') }}" class="text-orange">Search document</a></p>
                            @endcan
                        </div>

                        <div class="col-md-3">
                            <p><i class="fas fa-search"></i> Tracking:</p>
                            @can('Track bail')
                            <p><a href="{{ route('track-bail') }}" class="text-orange">Track bail</a></p>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal " id="releaseBailModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Release Bail</h4>
                <a href="#!" class="close bg-transparent" data-bs-dismiss="modal">&times;</a>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <p>Are you sure you want to release this bail?</p>
                <input type="hidden" name="release_slug" id="release_slug">
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="proceedRelease">Yes! Proceed</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(function(){

    })
</script>
@endsection
