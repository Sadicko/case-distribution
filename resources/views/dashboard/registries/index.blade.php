@extends('dashboard.layouts.app')

@section('title', 'Registries')

@section('setting_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder"></i> Registries</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('registries.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>Add registry</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->


            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        {{--  <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                             <h6 class="mb-0 fw-bold ">List of courts</h6>
                        </div> --}}
                        <div class="card-body basic-custome-color">
                            <div class="table-responsive">
                                <table id="initTable" class="table">
                                    <thead>
                                    <tr>
                                        <th>##</th>
                                        <th>Registry</th>
                                        <th>Email</th>
                                        <th>Location</th>
                                        <th>Court Type</th>
                                        <th>Region</th>
                                        <th>Courts</th>
                                        <th scope="col" class="text-center">Categories</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($registries as $registry)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $registry->name. ' - ' .$registry->code }}</td>
                                            <td>{{ $registry->email ?? '-' }}</td>
                                            <td>{{ $registry->locations->name }}</td>
                                            <td>{{ $registry->courttypes->name ?? '-'}}</td>
                                            <td>{{ $registry->locations->regions?->name }}</td>
                                            <td>{{ $registry->courts_count }}</td>
                                            <td class="text-center">
                                                @if(count($registry->categories) > 0)
                                                    @foreach($registry->categories as $index => $category)
                                                        @if($index < 3)
                                                            <small class="badge bg-dark">{{ $category->name }}</small>
                                                        @elseif($index === 3)
                                                            <small class="badge bg-dark">...</small>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @canany(['Update registries', 'Assign categories to registries'])
                                                    @can('Update registries')
                                                        <a href="{{ route('registries.edit', $registry->slug) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                    @endcan
                                                    @can('Assign categories to registries')
                                                        <a href="{{ route('registries.assign-categories', $registry->slug) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign Categories"><i class="fas fa-tasks"></i></a>
                                                    @endcan
                                                @else
                                                    <span>-</span>
                                                @endcanany
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
        </div>

@endsection


@section('scripts')
@endsection
