@extends('dashboard.layouts.app')

@section('title', 'Court types')

@section('setting_active', 'active')


@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-landmark"></i> Court types</h3>
                <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                    <a href="{{ route('courttypes.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New
                    court type</a>
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
                 <table id="initTable" class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">total courts</th>
                            <th scope="col" class="text-center">Created by</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courttypes as $courttype)
                        <tr>
                            <td>{{ $loop->index + 1}}</td>
                            <td>{{ $courttype->name }}</td>
                            <td>{{ $courttype->code }}</td>
                            <td>{{ $courttype->courts_count }}</td>
                            <td class="text-center">{{ $courttype->users?->username ?? 'Admin'}}</td>
                            <td class="text-center">
                                <a href="{{ route('courttypes.edit', $courttype->slug) }}" class="text-dark"><i class="fas fa-pencil"></i></a>
                            {{--     <a href="{{ route('courttypes.destroy', $courttype->slug) }}" class="text-danger"><i class="fas fa-trash"></i></a>
                                <form action="{{ route('courttypes.destroy', $courttype->slug) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><!-- Row end  -->

</div>
</div>
@endsection
