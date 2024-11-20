@extends('dashboard.layouts.app')

@section('title', 'Asset Dashboard')

@section('home_active', 'active')

@section('content')
    @can('Read dashboard')
        <div class="body">
            <div class="container">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="h4 mb-0">Dashboard</h3>
                            </h3>
                            <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                                @can('Create asset')
                                    <a href="{{ route('assets.create') }}" class="btn btn-dark  w-sm-100 me-2">
                                        <i class="icofont-edit me-2 fs-6"></i>File a Case</a>
                                @endcan

                                {{--                            @canany(['Read reports', 'Filter reports'])--}}
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Shortcuts
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                    {{--                                    @can('Search document')--}}
                                    <li><a class="dropdown-item" href="#!">File a Case</a></li>
                                    {{--                                    @endcan--}}
                                    {{--                                    @can('Validate document')--}}
                                    <li><a class="dropdown-item" href="{{ route('assets') }}">Upload Case</a></li>
                                    {{--                                    @endcan--}}
                                    @canany(['Read reports', 'Filter reports'])
                                        <li><a class="dropdown-item" href="#!">Reports</a></li>
                                    @endcanany
                                </ul>
                                {{--                            @endcanany--}}
                            </div>
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


                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body d-flex justify-content-between">
                                Total Judges
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <i class="fas fa-users"></i>
                                <span class="badge bg-white text-dark">{{ $judges }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Total cases</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <i class="fas fa-briefcase"></i>
                                <span class="badge bg-white text-dark">{{ $cases }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Registered cases</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <i class="fas fa-project-diagram"></i>
                                <span class="badge bg-white text-dark">{{ $registered_cases }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-secondary text-white mb-4">
                            <div class="card-body">Disposed cases</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <i class="fas fa-list-alt"></i>
                                <span class="badge bg-white text-dark">{{ $disposed_cases }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @livewire('dashboard-chart')

            </div>
        </div>

    @else
        <div class="body">
            <div class="container">
                <div class="card mb-3">
                    <div class="card-body text-center p-5">
                        <h5>Welcome to your Dashboard.</h5>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection

