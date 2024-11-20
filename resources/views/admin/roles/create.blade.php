@extends('admin.layouts.app')

@section('title', 'Role management::' .!empty($role) ? 'Edit role' : 'New role' )

@section('setting_active', 'Roles')

@section('content')
<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="h4 mb-0">{{ 'Role management::' .!empty($role) ? 'Edit role' : 'New role'  }}</h3>
					<div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
						<a href="{{ route('admin.roles') }}" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
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
				<form method="POST" action="{{ route('admin.roles.create') }}">
					@csrf
					<input type="hidden" name="slug" value="{{!empty($role) ? $role->slug : null }}">
					
					<div class="row justify-content-center">
						<div class="col-md-6">
							<div class="form-group mb-3 mt-4">
								<label for="role_name" class="control-label">Role name*</label>
								<input type="text" name="role_name" class="form-control round   @error('role_name') is-invalid @enderror" id="role_name" value="{{old('role_name') ?? !empty($role) ? $role->name : null }}" placeholder="eg. Admin" required>
								@error('role_name')
								<span class="invalid-feedback">{{ $message }}</span>
								@enderror
							</div>

							<div class="form-group mb-3">
								<label> Select status</label>
								<select class="form-control select2" name="status" id="applyAttendanceStatus" required>
									<option value="">---Select--</option>
									@foreach(role_status() as $key => $status)
									<option value="{{ $key }}" {{ old('status') == $status ? 'selected' : (!empty($role) && $role->status == $status ? 'selected': '' ) }}>{{ $status }}</option>
									@endforeach
								</select>
								@error('status')
								<span class="invalid-feedback">{{ $message }}</span>
								@enderror
							</div>

							<hr>
							<div class="form-group d-flex">
								<button class="btn btn-primary btn-round ml-auto">
									@empty ($role)
									Save & continue <i class="fas fa-arrow-right"></i>
									@else
									<i class="fas fa-save"></i> Save changes
									@endempty
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
