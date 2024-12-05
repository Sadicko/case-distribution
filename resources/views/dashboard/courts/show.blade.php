@extends('dashboard.layouts.app')

@section('title', 'Court details')

@section('title', 'Show court')

@section('setting_active', 'active')

@section('content')

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-file-signature"></i> Court Details
                    >> {{ $court->name }}</h3>
                    
                    <div class="col-auto d-flex w-sm-100  mt-sm-0">
                        @if (strpos(url()->previous(), '/courts?page=') !== false)
                        <a href="{{ url()->previous() }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        @else
                        <a href="{{ route('courts') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        @endif
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->
        
        <div class="card mb-4">
            <div class="card-header border-bottom pt-2 d-flex justify-content-between">
                <div>
                    @if($court->availability)
                    <strong>Status: </strong><span class="badge bg-success text-uppercase p-2">Available</span>
                    @else
                    <strong>Status: </strong><span class="badge bg-danger text-uppercase p-2">Blocked</span>
                    @endif
                </div>
                <div>
                    @can('Read workloads')
                    <a href="{{ route('courts.edit', $court->slug) }}" class="btn btn-info text-white btn-sm"><i
                        class="fas fa-info-circle"></i> Case Load: <strong>{{  $court->case_count }}</strong>
                    </a>
                    @endcan                    
                </div>
                <div>
                    @can('Update court')
                    <a href="{{ route('courts.edit', $court->slug) }}" class="btn btn-primary btn-sm"><i
                        class="fas fa-pencil"></i> Edit court
                    </a>
                    @endcan                    
                </div>
            </div>
            <div class="card-body  show-asset">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="court_name" class="form-label">Court name</label>
                        <p class="form-control-plaintext text-uppercase" id="court_name">{{ $court->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Court location</label>
                        <p class="form-control-plaintext text-uppercase" id="location">{{ $court->locations->name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="judge" class="form-label">Current Judge</label>
                        <p class="form-control-plaintext text-uppercase" id="judge">{{ $court->currentJudge[0]?->name ?? '-'}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="court_type" class="form-label">Court type</label>
                        <p class="form-control-plaintext text-uppercase" id="court_type">{{ $court->courttypes?->name ?? '-'}}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="registry" class="form-label">Registry</label>
                        <p class="form-control-plaintext text-uppercase" id="registry">{{ $court->registries?->name ?? '-'}}</p>
                    </div>
                    <div class="col-md-12 border mb-3 mt-3 pt-3 pb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <p class="form-control-plaintext text-uppercase" id="categories">
                            @foreach($court->categories as $category)
                            <small class="badge bg-dark">{{ $category->name }}</small>
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="accordion mb-5" id="accordionDockets">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDocket">
                    <button class="accordion-button text-info text-uppercase fw-bolder collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocket" aria-expanded="false" aria-controls="collapseOne">
                        Recent 100 cases allocated
                    </button>
                </h2>
                <div id="collapseDocket" class="accordion-collapse collapse" aria-labelledby="headingDocket" data-bs-parent="#accordionDockets">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover display">
                                <thead>
                                    <tr>
                                        <th>##</th>
                                        <th>Suit number</th>
                                        <th>Case title</th>
                                        <th>Case category</th>
                                        <th>Court</th>
                                        <th>Judge</th>
                                        <th>Date assigned</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($court->dockets as $docket)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            
                                            @can('Read cases')
                                            <a href="{{ route('cases.show', $docket->slug) }}" class="text-info"> {{ $docket->suit_number }}</a>
                                            @else
                                            {{ $docket->suit_number }}
                                            @endcan
                                        </td>
                                        <td>{{ Str::limit($docket->case_title, 50) }}</td>
                                        <td>{{ $docket->categories->name }}</td>
                                        <td>{{ $docket->courts?->name ?? '-' }}</td>
                                        <td>{{ $docket->judges?->name ?? '-' }}</td>
                                        <td>{{ !empty($docket->assigned_date) ? getCustomLocalTime($docket->assigned_date) : '-' }}</td>
                                        <td>{{ $docket->status }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="accordion mb-5" id="accordionHistory">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingHistory">
                    <button class="accordion-button collapsed text-uppercase text-info fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHistory" aria-expanded="false" aria-controls="collapseHistory">
                        Historical judges
                    </button>
                </h2>
                <div id="collapseHistory" class="accordion-collapse collapse" aria-labelledby="headingHistory" data-bs-parent="#accordionHistory">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table table-bordered display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judge</th>
                                        <th>Court type</th>
                                        <th>Date assigned to court</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($court->judges as $judge)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $judge->name ?? ''  }}</td>
                                        <td>{{ $judge->courttypes?->name ?? ''  }}</td>
                                        <td>{{ getCustomLocalTime(\Carbon\Carbon::parse($judge->pivot->assigned_at) ) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @can('Read court logs')
        <div class="accordion mb-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button text-info text-uppercase fw-bolder collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Court Activity Logs
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            @livewire('court-log', ['court' => $court])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
</div>

@endsection
