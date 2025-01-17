@extends('dashboard.layouts.app')

@section('title', 'Courts')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Courts</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('courts.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New
                                court</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        {{-- <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">List of courts</h6>
                        </div> --}}
                        <div class="card-body basic-custome-color">
                            <div class="table-responsive">
                                <table id="initTable" class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Court</th>
                                        <th scope="col">Current judge</th>
                                        <th scope="col">Workload</th>
                                        <th scope="col" class="text-center">Availability</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Court type</th>
                                        <th scope="col">Registry</th>
                                        <th scope="col" class="text-center">Categories</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courts as $court)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>
                                                @can('Read court logs')
                                                    <a href="{{ route('courts.show', $court->slug) }}" class="text-info">{{ $court->name }}</a>
                                                @else
                                                    {{ $court->name }}
                                                @endcan
                                            </td>
                                            <td>{{ $court->currentJudge[0]?->name ?? '-'}}</td>
                                            <td >{{ $court->case_count ?? 0 }} Cases</td>
                                            <td class="text-center">
                                                @if($court->availability)
                                                    <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                @else
                                                    <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                                @endif
                                            </td>
                                            <td>{{ $court->locations->name }}</td>
                                            <td>{{ $court->courttypes->name }}</td>
                                            <td>{{ !empty($court->registries?->name) ? Str::limit($court->registries?->name, 20) : '-' }}</td>
                                            <td class="text-center">
                                                @if(count($court->categories) > 0)
                                                    @foreach($court->categories as $index => $category)
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
                                                @canany(['Update courts', 'Assign court judges', 'Assign categories to courts'])
                                                    @can('Update courts')
                                                        <a href="{{ route('courts.edit', $court->slug) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-pencil"></i></a>
                                                    @endcan
                                                    @can('Assign court judges')
                                                        <a href="{{ route('court-judge', $court->slug) }}"  class="me-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change/Assign judge"><i class="fas fa-user-edit"></i></a>
                                                    @endcan
                                                    @can('Assign categories to courts')
                                                        <a href="{{ route('courts.assign-categories', $court->slug) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign Categories"><i class="fas fa-tasks"></i></a>
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
            </div><!-- Row end  -->

        </div>
    </div>
@endsection
