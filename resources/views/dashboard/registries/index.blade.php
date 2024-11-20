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
               					<th>Region</th>
               					<th>Courts</th>
               					<th class="text-center">Action</th>
               				</tr>
               			</thead>
               			<tbody>
               				@foreach ($registries as $registry)
               				<tr>
               					<td>{{ $loop->index + 1 }}</td>
               					<td>{{ $registry->code. ' - ' .$registry->name }}</td>
               					<td>{{ $registry->email }}</td>
               					<td>{{ $registry->locations->name }}</td>
               					<td>{{ $registry->locations->regions?->name }}</td>
               					<td>{{ $registry->courts_count }}</td>
               					<td class="text-center">
               						<a href="{{ route('registries.edit', $registry->slug) }}" class="mr-2"><i class="fas fa-pencil-alt"></i></a>
               					</td>
               				</tr>
               				@endforeach
               			</tfoot>
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