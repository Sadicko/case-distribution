@extends('dashboard.layouts.app')

@section('title', 'Asset Dashboard')

@section('home_active', 'active')

@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Dashboard</h3>
                        </h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            @can('Create asset')
                                <a href="{{ route('assets.create') }}" class="btn btn-dark  w-sm-100 me-2"><i class="icofont-edit me-2 fs-6"></i>New
                                    Asset</a>
                            @endcan

                            {{--                            @canany(['Read reports', 'Filter reports'])--}}
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Shortcuts
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                {{--                                    @can('Search document')--}}
                                <li><a class="dropdown-item" href="#!">Search</a></li>
                                {{--                                    @endcan--}}
                                {{--                                    @can('Validate document')--}}
                                <li><a class="dropdown-item" href="{{ route('assets') }}">Assets</a></li>
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

            <div class="body d-flex">
                <div class="container-xxl p-0">
                    <div class="d-flex mb-3">
                        <h6 class="text-muted me-3">LEGAL YEAR:</h6>
                        <small>{{ getCustomLocalDate($legalYearStart) .' - '. getCustomLocalDate($legalYearEnd) }}</small>
                    </div>

                    <div class="row mb-4 align-item-center">
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body py-xl-4 py-3 position-relative">
                                    <span class="text-muted">Total   Assets  </span>
                                    <div><span class="fs-6 fw-bold me-2">{{ $total_assets }}</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body py-xl-4 py-3 position-relative">
                                    <span class="text-muted">Total  Active Assets</span>
                                    <div><span class="fs-6 fw-bold me-2">{{ $total_active_assets }}</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body py-xl-4 py-3 position-relative">
                                    <span class="text-muted">Total  occupied Assets</span>
                                    <div><span class="fs-6 fw-bold me-2">{{ $total_unoccupied_assets }}</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body py-xl-4 py-3 position-relative">
                                    <span class="text-muted">Total  occupied Assets</span>
                                    <div><span class="fs-6 fw-bold me-2">{{ $total_occupied_assets }}</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body py-xl-4 py-3 position-relative">
                                    <span class="text-muted">Total Assets  Under Maintenance </span>
                                    <div><span class="fs-6 fw-bold me-2">{{ $total_maintenance_assets }}</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body py-xl-4 py-3 position-relative">
                                    <span class="text-muted"> Decommissioned  Assets</span>
                                    <div><span class="fs-6 fw-bold me-2">{{ $total_decommissioned_assets }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            @can('Read dashboard')

                <div class="body d-flex">
                    <div class="container-xxl p-0">

                        <div class="row">
                            {{--             ASSET BY REGION           --}}
                            <div class="col-md-6">
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h5 class="text-info mb-4">Assets by Region</h5>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>##</th>
                                                        <th>Region</th>
                                                        <th>Total Assets</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($assets_by_regions as $region)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $region->name }}</td>
                                                            <td>{{ $region->assets_count }}</td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                {{--ASSET BY CATEGORIES--}}
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h5 class="text-info mb-4">Assets by Categories</h5>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        @foreach($asset_by_categories as $category)
                                                            <th>{{ $category->name }}</th>
                                                        @endforeach
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        @foreach($asset_by_categories as $category)
                                                            <td>{{ $category->assets_count }}</td>
                                                        @endforeach
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                        ASSET BY SUBCATEGORIES--}}
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h5 class="text-info mb-4">Assets by Types</h5>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        @foreach($asset_by_subcategories as $sub_category)
                                                            <th>{{ $sub_category->name }}</th>
                                                        @endforeach
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        @foreach($asset_by_subcategories as $sub_category)
                                                            <td>{{ $sub_category->sub_assets_count }}</td>
                                                        @endforeach
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            @else
                <div class="body d-flex">
                    <div class="container-xxl p-0">
                        <div class="card mb-3">
                            <div class="card-body text-center p-5">
                                <h5>Welcome to your Dashboard.</h5>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    @endcan

@endsection

