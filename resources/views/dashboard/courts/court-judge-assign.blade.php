@extends('dashboard.layouts.app')

@section('title', 'Court - Judge assignment')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Assign Judge to Court</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('courts') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header border-bottom py-3 bg-transparent">
                            <h6 class="fw-bold">Court: {{ $court->name }}</h6>
                            <h6 class="fw-bold">Location: {{ $court->locations->name }}</h6>
                            @if(!empty($currentJudge))
                                <h6 class="mb-0 fw-bold "><span class="text-info">Current judge:</span> {{ $currentJudge->name  }}</h6>
                            @else
                                <h6 class="mb-0 fw-bold text-danger"><span>Current judge:</span> <small>Not assigned <i class="fas fa-times-circle"></i></small></h6>
                            @endif
                        </div>

                        @if(!session()->has('success'))
                            <div class="card-body">
                                <form action="{{ route('court-judge', $court->slug) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="court" value="{{ $court->id }}">
                                    <div class="mb-4">
                                        <h5 class="modal-title" id="assignJudgeModalLabel">Assign New Judge</h5>
                                        <small class="text-muted">Please note that a new judge will be assigned to <strong>{{ $court->name }}</strong> when you submit. The current judge will be moved to a historical judge position if they were previously assigned.</small>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6 mb-5">
                                            <label for="judgeSelect">Choose a Judge</label>
                                            <select name="judge" id="judgeSelect" class="form-control select2" required>
                                                <option></option>
                                                @foreach($judges as $judge)
                                                    <option value="{{ $judge->id }}">{{ $judge->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <a href="{{ route('courts') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        @else
                            <div style="height: 20vh"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- Row end  -->

    </div>

@endsection

{{--@section('scripts')--}}
{{--    <script>--}}
{{--    </script>--}}
{{--@endsection--}}
