@extends('admin.layouts.app')

@section('title', 'System users')

@section('setting_active', 'active')

@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">System users</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New user</a>
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
                        <table id="initTable" class="table">
                            <thead>
                            <tr>
                                <th>##</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Contact</th>
                                <th>Created on</th>
                                <th>Joined on</th>
                                <th>Status</th>
                                <th>Access level</th>
                                <th class="text-center">Roles</th>
                                <th>Registry</th>
                                <th>Court</th>
                                <th>Last login</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <a href="#!">{{ $user->full_name }}</a>
                                    </td>
                                    <td>
                                        <a href="#!">{{ $user->username }}</a>
                                    </td>
                                    <td>
                                        <span>-{{ $user->email }}</span><br>
                                        <span>-{{ $user->phone }}</span>
                                    </td>
                                    <td>{{ $user->created_at?->format('d M Y') }}</td>
                                    <td>
                                        @empty($user->accepted_date)
                                            <small class="text-info">Pending</small>
                                        @else
                                            {{ $user->accepted_date->format('d M Y') }}
                                        @endempty
                                    </td>

                                    <td>{{ $user->status}}</td>
                                    <td>
                                        {{ ucfirst( $user->access_type ) }}

                                    </td>
                                    <td class="text-center">
                                        {{-- {{ $user->getRoleNames()->count() }} --}}
                                        @if($user->accepted_type == 'System Admin')
                                            <small class="text-success">Full access</small>
                                        @else
                                            @foreach($user->getRoleNames() as $role)
                                                <small class="badge bg-dark">{{ $role }}</small>
                                            @endforeach
                                        @endif

                                    </td>
                                    <td>
                                        {{ $user->registries?->name ?? '-'  }}
                                    </td>
                                    <td>
                                        {{ $user->courts?->name ?? '-'  }}
                                    </td>
                                    <td>
                                        @if($user->is_online)
                                            <span data-toggle="tooltip" data-placement="bottom" title="Online">
										<i class="fas fa-circle text-success"></i>
										<small>{{ !empty($user->login_at) ? $user->login_at->diffForHumans() : '-'}}</small>
									</span>
                                        @else
                                            <span data-toggle="tooltip" data-placement="bottom" title="Offline">
										<i class="fas fa-circle text-secondary"></i>
										<small>{{ !empty($user->logout_at) ? $user->logout_at->diffForHumans() : '-'}}</small>
									</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.users.edit', $user->slug) }}"><i class="fas fa-pencil-alt"></i></a>
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
