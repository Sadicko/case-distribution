@extends('admin.layouts.app')

@section('title', 'System Backups')

@section('setting_active', 'active')

@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">System backups</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>


    <div class="row align-item-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    Backups
                    <small class="text-muted">Backups are done daily. You can download a copy and keep it safe.</small>
                </div>
                <div class="card-body basic-custome-color">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>##</th>
                            <th>File Name</th>
                            <th>File Size</th>
                            <th>Last Modified</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($backups) > 0)
                            @foreach($backups as $key => $backup)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $backup['file_name'] }}</td>
                                    <td>{{ $backup['file_size'] }}</td>
                                    <td>{{ \Carbon\Carbon::createFromTimestamp($backup['last_modified'])->toDateTimeString() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.backups.download', $backup['file_name']) }}" class="btn btn-primary "><i class="fas fa-download text-white"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">No backup found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
