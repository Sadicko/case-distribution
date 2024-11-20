@extends('dashboard.layouts.app')

@section('title', 'System logs')

@section('setting_active', 'active')

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
{{-- @livewireStyles --}}
@endsection

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="h4 mb-0"><i class="fas fa-history"></i> System logs</h3>
                </div>
            </div>
        </div>

        <form >
            <div class="row g-3 mb-3">
                <div class="col-lg-4">
                    <label  class="form-label">User</label>
                    <select class="form-select select2" name="username" wire:model="username">
                        <option value=""></option>
                        @foreach($users as $user)
                        <option value="{{ $user->username }}" {{ request()->username == $user->username ? 'selected' : '' }}>{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>  
                <div class="col-lg-6">
                    <label  class="form-label">Log Period</label>
                    <input type="text" id="dateRangePicker" class="form-control" name="period" wire.model="period" value="{{ request()->period }}">
                </div> 
                <div class="col-lg-2">
                    <label class="form-label">Show Logs</label>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
            </div>
        </form>

        <div class="row clearfix g-3">
            <div class="col-sm-12">


                <div class="card mb-3">
                    <div class="card-body" wire:loading.class="opacity-25">
                        <div class="table-responsive">
                            <table id="initTable" class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>##</th>
                                        <th>Activity</th>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>IP Address</th>
                                        <th>Access on</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($audits as $activitylog)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $activitylog->action }}</td>
                                        <td>{{ getCustomLocalTime($activitylog->created_at) }}</td>
                                        <td class="text-uppercase">{{ $activitylog->username }}</td>
                                        <td>{{ $activitylog->ip_address }}</td>
                                        <td>{{ $activitylog->browser }} @if($activitylog->device) ({{ $activitylog->device }}) @endif on  {{ $activitylog->platform }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- @livewire('audit-search', ['users' => $users]) --}}

    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>

{{-- @livewireScripts --}}

<script>
    // Initialize the date range picker
    $(document).ready(function() {
        $('#dateRangePicker').daterangepicker({
            startDate: moment().subtract(7, 'days'),
            endDate: moment(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        });
    });
</script>
@endsection