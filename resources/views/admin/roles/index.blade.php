@extends('admin.layouts.app')

@section('title', 'Roles')

@section('setting_active', 'Roles')

@section('content')
    <div class="body d-flex py-3 flex-grow-0">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Roles</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New role</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>


    <div class="row align-item-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body basic-custome-color">
                    <div class="table-responsive">
                        <table id="initTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#!</th>
                                <th>Role</th>
                                <th>Total permissions</th>
                                <th>Total users assigned</th>
                                <th>Created on</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <a href="{{ route('admin.roles.assign', $role->slug) }}" class="text-info">{{ $role->name }}</a>
                                    </td>
                                    <td>{{ $role->permissions_count }}</td>
                                    <td> {{ $role->users_count }}</td>
                                    <td>{{ $role->created_at->format('d M Y')}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.roles.create', $role->slug) }}"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
