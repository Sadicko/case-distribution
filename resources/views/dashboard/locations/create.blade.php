@extends('dashboard.layouts.app')

@section('title', 'New location')

@section('setting_active', 'active')


@section('content')
<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="h4 mb-0">New location</h3>
					<div class="col-auto d-flex w-sm-100 mt-2 text-danger mt-sm-0">
						<a href="{{ route('locations') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
					</div>
				</div>
			</div>
		</div> <!-- Row end  -->

		<div class="row align-item-center">
			<div class="col-md-12">
				<div class="card mb-3">
					<div class="card-body basic-custome-color">

						<form action="{{route('locations.create')}}" method="post">
							@csrf

							<div class="row">
								<div class="col-md-6 mb-3">
									<label for="location_name" class="form-label">Location name</label>
									<input type="text" class="form-control" name="location_name" id="location_name" value="{{ old('location_name') }}" required>
									<x-input-error :messages="$errors->get('location_name')" class="mt-2 text-danger" />
									</div>
									<div class="col-md-6 mb-3">
										<label for="location_code"  class="form-label">Code</label>
										<input type="text" class="form-control" name="location_code" value="{{ old('location_code') }}">
										<x-input-error :messages="$errors->get('location_code')" class="mt-2 text-danger" />
										</div>
										<div class="col-md-6 mb-3">
											<label for="status" class="form-label">Status</label>
											<select class="form-control select2" name="status" id="status" required>
												<option></option>
												@foreach(status() as $status)
												<option value="{{ $status }}">{{ $status }}</option>
												@endforeach
											</select>
											<x-input-error :messages="$errors->get('status')" class="mt-2 text-danger" />
											</div>
											<div class="col-md-6 mb-3">
												<label for="court_type"  class="form-label">Court type</label>
												<select class="form-control select2" name="court_type"  id="court_type">
													<option value=""></option>
													@foreach($courttypes as $court_type)
													<option value="{{ $court_type->id }}" {{ old('court_type') == $court_type->id ? 'selected' : '' }} >{{ $court_type->name }}</option>
													@endforeach
												</select>
												<x-input-error :messages="$errors->get('court_type')" class="mt-2 text-danger" />
												</div>
												<div class="col-md-6 mb-3">
													<label for="region" class="form-label">Region</label>
													<select class="form-control select2" name="region" required id="region">
														<option value=""></option>
														@foreach($regions as $region)
														<option value="{{ $region->id }}" {{ old('region') == $region->id ? 'selected' : '' }} >{{ $region->name }}</option>
														@endforeach
													</select>
													<x-input-error :messages="$errors->get('region')" class="mt-2 text-danger" />
													</div>
													<div class="col-md-12 mb-3">
														<button type="submit" class="btn btn-primary bg-gradient-primary btn-sm mt-3"><i class="fas fa-save"></i> Create</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					@endsection
