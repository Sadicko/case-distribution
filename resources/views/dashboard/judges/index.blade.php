@extends('dashboard.layouts.app')

@section('title', 'Judges')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Judges</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('judges.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New judge</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body basic-custome-color">
                            <div class="table-responsive">
                                <table id="initTable" class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-center">Availability</th>
                                        <th scope="col">Court</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">status</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($judges as $judge)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $judge->name }}</td>
                                            <td class="text-center">
                                                @if($judge->availability)
                                                    <span class="text-success"><i class="fas fa-check-circle"></i></span>
                                                @else
                                                    <span class="text-danger"><i class="fas fa-times-circle"></i></span>
                                                @endif
                                            </td>
                                            <td>{{ $judge->current_court?->name ?? '-'}}</td>
                                            <td>{{ $judge->current_court?->locations?->name ?? '-' }}</td>
                                            <td>{{ $judge->status }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('judges.edit', $judge->slug) }}"><i class="fas fa-pencil"></i></a>
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
