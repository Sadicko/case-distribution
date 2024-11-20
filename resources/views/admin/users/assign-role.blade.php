@extends('modules.setup.layouts.app')

@section('title', 'Assign role to user')

@section('setup_user_active', 'active')

@section('breadcrumb', 'Manage users')
@section('breadcrumb_url', route('setup.users'))

@section('first_breadcrumb', 'Assign role')


@section('top_button')
<div class="col-md-6 col-sm-12 text-right hidden-xs">
	<a href="{{ route('setup.users') }}" class="btn btn-sm btn-info btn-round"> <i class="fas fa-chevron-circle-left"></i> Back</a>
</div>
@endsection

@section('content')
<x-card>
	@slot('header_title')
	New user::Assign role to <b>{{ $user->full_name }}</b>
	<small class="text-muted">An invitation has been sent to {{ $user->first_name }}'s email <i>{{ $user->email }}</i><small>
		@endslot
		{{-- body --}}

		<form id="auth-form" class="form-auth-small text-left" method="POST" action="{{route('setup.users.create')}}">
			@csrf

			<div class="row justify-content-center">
				<div class="form-group col-md-6">
					<label> Select role</label>
					<select class="form-control select2" name="roles[]" required multiple>
						{{-- <option value="">---Select--</option> --}}
						@foreach($roles as $key => $role)
						<option value="{{  $role->id }}" {{ old('status') ==  $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
						@endforeach
					</select>
					@error('roles')
					<span class="invalid-feedback">{{ $message }}</span>
					@enderror

					<button type="submit" class="btn btn-primary btn-round register_btn auth-btn has-spinner float-right mt-4" > <i class="fas fa-save"></i>Assign roles</button>
					
				</div>

				{{-- <div class="form-group col-md-6">
					<label> Select management level</label>
					<select class="form-control select2" name="status" id="access_level" required>
						<option value="">---Select--</option>
						@foreach(access_level() as $key => $status)
						<option value="{{ $key }}" {{ old('status') == $status ? 'selected' : '' }}>
							{{ $status }} 
							@if($key == 'Demarcations')
							({{ get_settings()->church_demarcations }})
							@elseif($key == 'Sub-demarcations')
							({{ get_settings()->sub_demarcations }})
							@elseif($key == 'Church locations')
							({{ get_settings()->church_locations }})
							@endif
						</option>
						@endforeach
					</select>
					@error('status')
					<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div> --}}
			</div>

			{{-- <div class="row justify-content-end" id="management_level_box" style="display: none;">
				<div class="form-group mb-2 col-md-4 accessOne accessTwo accessThree" id="demarcations_box">
					<label for="filter_area"> {{ Str::singular($settings->church_demarcations) }} <span>*</span></label>
					<select name="area"  class="form-control filter-select2 @error('area') is-invalid @enderror" id="filter_area">
						<option value="" selected hidden disabled>--- Choose an option ---</option>
						@foreach($areas as $area)
						<option value="{{ $area->id }}" {{ old('area') == $area->id  ? 'selected' : (!empty($request_data) && $request_data['area'] == $area->id ? 'selected' : '') }} >
							{{ $area->area_name }}
						</option>
						@endforeach
					</select>
					@error('area')
					<span class="is-invalid"> {{ $message }} </span>
					@enderror
				</div>
				<div class="form-group mb-2 col-md-4 accessTwo accessThree" id="sub_demarcations_box">
					<label for="filter_district"> {{ Str::singular($settings->sub_demarcations) }}</label>
					<select name="district"  class="form-control filter-select2  @error('district') is-invalid @enderror" id="filter_district" disabled>
						<option value="" selected hidden disabled>--- Select ---</option>
						@foreach($districts as $district)
						<option value="{{ $district->id }}"
							data-area="{{ $district->area_id }}" {{ old('district') == $district->id ? 'selected' : (!empty($request_data) && $request_data['district'] == $district->id ? 'selected' : '') }} >
							{{ $district->district_name }}
						</option>
						@endforeach
					</select>
					@error('district')
					<span class="is-invalid"> {{ $message }} </span>
					@enderror
				</div>
				<div class="form-group mb-2 col-md-4  accessThree" id="church_locations_box">
					<label for="filterassembly">{{  Str::singular($settings->church_locations) }}</label>
					<select name="assembly"  class="form-control filter_assembly filter-select2"  id="filter_assembly" disabled>
						@if(!empty($request_data))
						@foreach(get_assemblies($request_data['district']) as $assembly)
						<option value="{{ $assembly->id }}" {{ !empty($request_data) && $request_data['assembly'] == $assembly->id ? 'selected' : '' }}> 
							{{ $assembly->assembly_name }} 
						</option>
						@endforeach
						@else
						<option value="" selected hidden disabled>---Select--</option>
						@endif

					</select>
					@error('assembly')
					<span class="is-invalid"> {{ $message }} </span>
					@enderror
				</div>
			</div> --}}

			{{-- <div class="row">
				<div class="form-group col-md-12 mt-4">
					<button type="submit" class="btn btn-primary btn-round register_btn auth-btn has-spinner float-right" > <i class="fas fa-save"></i>Assign roles</button>
				</div>
			</div> --}}
		</div>

	</form>
</div>
</x-card>

@endsection

@section('footerContent')
<script src="{{asset('/js/setup.js')}}"></script>
@endsection