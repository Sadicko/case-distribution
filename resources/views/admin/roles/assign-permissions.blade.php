@extends('admin.layouts.app')

@section('title', 'Assign permissions to role')

@section('setting_active', 'Roles')

@section('content')
<div class="body d-flex py-3">
	<div class="container-xxl">
		<div class="row align-items-center">
			<div class="border-0 mb-4">
				<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
					<h3 class="h4 mb-0">Assign permissions to role</h3>
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
				<h6 class="mb-4">Hi <em>{{ Auth::user()->first_name }}</em>, you can give as many permissions to this role. The permission granted to the role of <b>{{ $role->name }}</b> determines what a user assigned this role can do.</h6>

				<hr>
				<div class="d-flex flex-wrap justify-content-between">
					<h4 class="text-dark">Permissions for role</h4>
					<div class="form-group">
						<label class="fancy-checkbox element-left">
							<input type="checkbox" name="checkAll" id="checkAll" {{ old('checkAll') ? 'checked' : '' }}>
							<span>Check all permissions</span>
						</label>                                
					</div>
				</div>
				<hr>
				<form method="POST" action="{{ route('admin.roles.assign', $role->slug) }}">
					@csrf
					<input type="hidden" name="slug" value="{{!empty($role) ? $role->slug : null }}">

					<div class="row">
						@foreach($modules as $module)
						<div class="col-md-12 mb-3">
							<h5 class="header-text text-muted">
								{{ $module->name }} 
						{{-- @if($module->name == 'Demarcations')
						({{ get_settings()->church_demarcations }})
						@elseif($module->name == 'Sub-Demarcations')
						({{ get_settings()->sub_demarcations }})
						@elseif($module->name == 'Church locations')
						({{ get_settings()->church_locations }})
						@elseif($module->name == 'Church Groups')
						({{ get_settings()->church_groups }})
						@endif --}}
					</h5>

					<div class="d-flex flex-wrap justify-content-between mt-2 bg-light pt-3 pl-3 pr-3">
						@foreach($module->permissions as $module_permission)
						<div class="form-group clearfix m-2">
							<label class="fancy-checkbox element-left">
								<input type="checkbox" name="permissions[]" class="singleCheck"

								@if(old('permissions') && in_array($module_permission->name, old('permissions')))
								checked 
								@else

								@foreach ($role->permissions as $role_permission)				
								@if ($role_permission->name == $module_permission->name)
								checked 
								@endif
								@endforeach

								@endif
								value="{{ $module_permission->name }}">
								<span>{{ $module_permission->name }}</span>
							</label>                                
						</div>
						@endforeach
					</div>
				</div>
				@endforeach

				<hr>
				<div class="form-group col-md-12">
					<button class="btn btn-primary btn-round float-right"> <i class="fas fa-check"></i> Grant permissions</button>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>

@endsection
