@extends('dashboard.layouts.app')

@section('title', 'Court locations')

@section('setting_active', 'active')

@section('content')

<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div
				class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="h4 mb-0 text-uppercase"><i class="fas fa-map-pin"></i> Locations</h3>
				<div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
					<a href="{{ route('locations.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New location</a>
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
                				<th>##</th>
                				<th>Location</th>
                				<th>Code</th>
                				<th>Court Type</th>
                				<th>Region</th>
                				<th class="text-center">Action</th>
                			</tr>
                		</thead>
                		<tbody>
                			@foreach ($locations as $location)
                			<tr>
                				<td>{{ $loop->index + 1 }}</td>
                				<td>{{ $location->name }}</td>
                				<td>{{ $location->code ?? '-'}}</td>
                				<td>{{ $location->courttypes->name ?? '-'}}</td>
                				<td>{{ $location->regions?->name ?? '-' }}</td>
                				<td class="text-center">
                					<a href="{{ route('locations.edit', $location->slug) }}" class="mr-2"><i class="fas fa-pencil-alt"></i></a>
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


@section('scripts')
@endsection