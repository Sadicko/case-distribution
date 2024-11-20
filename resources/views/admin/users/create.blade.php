@extends('admin.layouts.app')

@section('title', 'Create new user')

@section('setting_active', 'active')

@section('content')
<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="h4 mb-0">Create new user</h3>
					<div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
						<a href="{{ route('admin.users') }}" class="btn btn-sm btn-info btn-round"> <i class="fas fa-chevron-circle-left"></i> Back</a>
					</div>
				</div>
			</div>
		</div> <!-- Row end  -->
	</div>
</div>


<div class="row align-item-center">
	<div class="col-md-12">
		<div class="card mb-3">
			<div class="card-header">
				Add new user |
				<small class="text-muted">An invitation will be sent to the email address provided. Please provide a valid email address.</small>
			</div>
			<div class="card-body basic-custome-color">

				@if($message = session()->get('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ $message  }}
				</div>
				@endif

				<form id="auth-form" class="form-auth-small text-left" method="POST" action="{{route('admin.users.create')}}">
					@csrf

					<small class="text-info mt-3 border-bottom pt-4 mb-4">User info</small>
					<div class="row mb-4 mt-2">
						<div class="form-group mb-3 col-md-6">
							<label for="first_name" class="control-label ">First name*</label>
							<input type="text" name="first_name" class="form-control round   @error('first_name') is-invalid @enderror" id="first_name" value="{{old('first_name')}}" placeholder="Full name" required>
							@error('first_name')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mb-3 col-md-6">
							<label for="last_name" class="control-label ">Last name*</label>
							<input type="text" name="last_name" class="form-control round   @error('last_name') is-invalid @enderror" id="last_name" value="{{old('last_name')}}" placeholder="Full name" required>
							@error('last_name')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mb-3 col-md-6">
							<label for="username" class="control-label">User name*</label>
							<input type="text" name="username" class="form-control round   @error('username') is-invalid @enderror" id="username" value="{{old('username')}}" placeholder="User name" required>
							@error('username')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mb-3 col-md-6">
							<label for="signin-email" class="control-label">Email*</label>
							<input type="email" name="email" class="form-control round   @error('email') is-invalid @enderror" id="signin-email" value="{{ old('email') }}" placeholder="email@example.com" required>
							@error('email')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mb-3 col-md-6">
							<label for="phone" class="control-label">Phone</label>
							<input type="tel" name="phone" class="form-control round @error('phone') is-invalid @enderror" id="phone" value="{{old('phone')}}" placeholder="Phone">
							@error('phone')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group  col-md-6 mb-3">
							<label for="location"  class="form-label">Location*</label>
							<select class="form-control select2" name="location"  id="location">
								<option value=""></option>
								@foreach($locations as $location)
								<option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : '' }} >{{ $location->name }}</option>
								@endforeach
							</select>
							@error('location')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
{{--						<div class="form-group  col-md-6 mb-3">--}}
{{--							<label for="registry"  class="form-label">Registry</label>--}}
{{--							<select class="form-control select2" name="registry"  id="registry">--}}
{{--								<option value=""></option>--}}
{{--								@if(old('location'))--}}
{{--								@foreach(fetch_registries(old('location')) as $registry)--}}
{{--								<option value="{{ $registry->id }}" {{ old('registry') == $registry->id ? 'selected' : '' }} >{{ $registry->name }}</option>--}}
{{--								@endforeach--}}
{{--								@endif--}}
{{--							</select>--}}
{{--							@error('registry')--}}
{{--							<span class="invalid-feedback">{{ $message }}</span>--}}
{{--							@enderror--}}
{{--						</div>--}}
					</div>

					<hr>

					<small class="text-info mt-3 border-bottom pt-4 mb-4">Access management: Assign roles and privillages to this user.</small>
					<div class="row mb-4 mt-2">
						<div class="form-group mb-3 col-md-4">
							<label> Select status*</label>
							<select class="form-control select2" name="status" required>
								<option value="">---Select--</option>
								@foreach(user_status() as $key => $status)
								<option value="{{ $key }}" {{ old('status') == $status ? 'selected' : ''}}>{{ $status }}</option>
								@endforeach
							</select>
							@error('status')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mb-3 col-md-4">
							<label> Assign roles*</label>
							<select class="form-control select2" name="roles[]" required multiple>
								@foreach($roles as $key => $role)
								<option value="{{  $role->name }}" {{ old('roles') && in_array($role->name, old('roles')) ? 'selected' : ''}}>{{ $role->name }}</option>
								@endforeach
							</select>
							@error('roles')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mb-3 col-md-4">
							<label> Select access level*</label>
							<select class="form-control select2" name="access_level" id="access_level" required>
								<option value="">---Select--</option>
								@foreach(access_level() as $access_level)
								<option value="{{ $access_level }}" {{ old('access_level') == $access_level ? 'selected' : '' }}>
									{{ $access_level }}
								</option>
								@endforeach
							</select>
							@error('access_level')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<hr>

					<small class="text-info mt-3 border-bottom pt-4 mb-4">Authentication</small>
					<div class="row mt-4">

						<div class="form-group mb-3 col-md-6">
							<label for="signin-password" class="control-label">Password*  <small class="text-muted">(Default password is  {{ config('jams.default_password') }})</small></label>
							<input type="password" name="password" class="form-control round   @error('password') is-invalid @enderror" id="signin-password" placeholder="Password" required autocomplete="signin-password" value="{{ config('jams.default_password') }}" readonly>
							@error('password')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mb-3 col-md-6">
							<label for="password_confirmation" class="control-label">Confirm password*</label>
							<input type="password" name="password_confirmation" class="form-control round   @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirm password" value="{{ config('jams.default_password') }}" readonly>
							@error('password_confirmation')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mb-3 col-md-4">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="require_password_reset" name="require_password_reset" @checked(old('require_password_reset', 'checked')) value="yes">
								<label class="custom-control-label" for="require_password_reset">Require Password Reset</label>
							</div>
							@error('require_password_reset')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>

						<div class="form-group mb-3 col-md-4">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="is_expire" name="is_expire" @checked(old('is_expire')) value="yes">
								<label class="custom-control-label" for="is_expire">Can Expire</label>
							</div>
							@error('is_expire')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group mb-3 col-md-4 expire_date" style="display: none;">
							<label for="expire_date">Should expire on</label>
							<input type="date" class="form-control" id="expire_date" name="expire_date" value="{{ old('expire_date') }}">
							@error('expire_date')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<hr>

					<div class="row mb-4">
						<div class="form-group mb-3 col-md-12 mt-4">
							<button type="submit" class="btn btn-primary btn-round register_btn auth-btn has-spinner float-right" > <i class="fas fa-save"></i> Create user & assign roles</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

@endsection
