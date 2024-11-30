@extends('dashboard.layouts.app')

@section('title', 'Will details')

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

            <div class="card mb-4 show-asset">
                {{--                <div class="card-header border-bottom pt-2 d-flex justify-content-between">--}}
                {{--                    <div>--}}
                {{--                        @if($will->status == 'Deposited')--}}
                {{--                            <strong>Status: </strong><span class="badge bg-success text-uppercase p-2">{{ $will->status }}</span>--}}
                {{--                        @elseif($will->status == 'Withdrawn')--}}
                {{--                            <strong>Status: </strong><span class="badge bg-danger text-uppercase p-2">{{ $will->status }}</span>--}}
                {{--                        @else--}}
                {{--                            <strong>Status: </strong><span class="badge bg-info text-uppercase p-2">{{ $will->status }}</span>--}}
                {{--                        @endif--}}
                {{--                    </div>--}}
                {{--                    @if($will->status !== 'Read')--}}
                {{--                        <div>--}}
                {{--                            @can('Update will')--}}
                {{--                                <a href="{{ route('wills.edit', $will->slug) }}" class="btn btn-primary btn-sm"><i--}}
                {{--                                        class="fas fa-pencil"></i> Edit will</a>--}}
                {{--                            @endcan--}}
                {{--                            @can('Upload will files')--}}
                {{--                                <a href="{{ route('wills.attachments', $will->slug) }}" class="btn btn-primary btn-sm"><i--}}
                {{--                                        class="fas fa-upload"></i> Add attachments</a>--}}
                {{--                            @endcan--}}
                {{--                        </div>--}}
                {{--                    @endif--}}
                {{--                </div>--}}
                {{--                <div class="card-body">--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="will_number" class="form-label">Will number</label>--}}
                {{--                            <p class="form-control-plaintext" id="will_number">{{ $will->will_number }}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="testator_name" class="form-label">Testator Name</label>--}}
                {{--                            <p class="form-control-plaintext" id="testator_name">{{ $will->testator_name }}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="$will->residential_address" class="form-label">Residential address</label>--}}
                {{--                            <p class="form-control-plaintext" id="residential_address">{{ $will->residential_address ?? '-'}}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="deposited_by" class="form-label">Deposited By</label>--}}
                {{--                            <p class="form-control-plaintext" id="deposited_by">{{ $will->deposited_by ?? '-' }}</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="prepared_by" class="form-label">Prepared By</label>--}}
                {{--                            <p class="form-control-plaintext" id="prepared_by">{{ $will->prepared_by ?? '-' }}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="date_deposited" class="form-label">Date Deposited</label>--}}
                {{--                            <p class="form-control-plaintext" id="date_deposited">{{ $will->date_deposited?->format('d-m-Y') ?? '-' }}</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <hr>--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="date_withdrawn" class="form-label">Date Withdrawn</label>--}}
                {{--                            <p class="form-control-plaintext"--}}
                {{--                               id="date_withdrawn">{{ $will->date_withdrawn?->format('d-m-Y') ?? '-'  }}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="withdrawn_by" class="form-label">Withdrawn By</label>--}}
                {{--                            <p class="form-control-plaintext" id="withdrawn_by">{{ $will->withdrawn_by ?? '-' }}</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}

                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="date_read" class="form-label">Date Read</label>--}}
                {{--                            <p class="form-control-plaintext"--}}
                {{--                               id="date_read">{{ $will->date_read?->format('d-m-Y') ?? '-'  }}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="read_by" class="form-label">Read By</label>--}}
                {{--                            <p class="form-control-plaintext" id="read_by">{{ $will->read_by ?? '-' }}</p>--}}
                {{--                        </div>--}}
                {{--                        <div class="col-md-6 mb-3">--}}
                {{--                            <label for="processed_by" class="form-label">Processed By</label>--}}
                {{--                            <p class="form-control-plaintext" id="processed_by">{{ $will->processed_by ?? '-' }}</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                    <hr>--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col-md-12 mb-3">--}}
                {{--                            <label for="remarks" class="form-label">Remarks</label>--}}
                {{--                            <p class="form-control-plaintext"--}}
                {{--                               id="remarks">{{ $will->remarks ?? '-'  }}</p>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}


                {{--                    @can('View will files')--}}
                {{--                        @if(count($will->attachments) > 0)--}}
                {{--                            <hr>--}}
                {{--                            <!-- Attachments -->--}}
                {{--                            <h3 class="mb-4">Attachments</h3>--}}
                {{--                            <ol class="list-group list-group-numbered">--}}
                {{--                                @foreach($will->attachments as $attachment)--}}
                {{--                                    <li class="list-group-item d-flex justify-content-between align-items-start">--}}
                {{--                                        <div class="ms-2 me-auto">--}}
                {{--                                            <a href="{{ Storage::disk('local')->url($attachment->file_path) }}"--}}
                {{--                                               class="text-info" target="_blank" data-bs-toggle="tooltip"--}}
                {{--                                               data-bs-placement="bottom"--}}
                {{--                                               data-bs-title="View File">{{ $attachment->file_name }} <i--}}
                {{--                                                    class="fa-solid fa-external-link-alt"></i> </a>--}}
                {{--                                            <div>--}}
                {{--                                                <small class="text-muted">Uploaded on {{ $attachment->created_at?->format('d-m-Y') ?? '-'}}</small>--}}
                {{--                                            </div>--}}
                {{--                                        </div>--}}
                {{--                                        <a href="{{ Storage::disk('local')->url($attachment->file_path) }}"--}}
                {{--                                           class="text-info" target="_blank" data-bs-toggle="tooltip"--}}
                {{--                                           data-bs-placement="bottom" data-bs-title="View File"> <i--}}
                {{--                                                class="fa-solid fa-external-link-alt"></i></a>--}}
                {{--                                        @can('Delete will files')--}}
                {{--                                            <a href="#!" class="text-danger ms-4" data-bs-toggle="tooltip"--}}
                {{--                                               data-bs-placement="bottom" data-bs-title="Remove file"> <i--}}
                {{--                                                    class="fa-solid fa-trash-alt"></i></a>--}}
                {{--                                        @endcan--}}
                {{--                                    </li>--}}
                {{--                                @endforeach--}}
                {{--                            </ol>--}}
                {{--                        @endif--}}
                {{--                    @endcan--}}
                {{--                </div>--}}
            </div>

            @can('Read court logs')
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
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
