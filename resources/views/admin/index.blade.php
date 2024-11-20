@extends('admin.layouts.app')

@section('title', 'Admin dashboard')

@section('content')
<div class="row">
	<div class="col-md-4 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total users</span>
				<span class="info-box-number">{{ $users }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-warning"><i class="fas fa-user-friends"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total admins</span>
				<span class="info-box-number">{{ $admins }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-success"><i class="fas fa-user-slash"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Expiring accounts</span>
				<span class="info-box-number">{{ $expiring_users }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	
	<div class="col-md-4 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-blue">
				{{-- <i class="fas fa-uploads"></i> --}}
				<i class="fa-solid fa-upload"></i>
			</span>

			<div class="info-box-content">
				<span class="info-box-text">Total uploads</span>
				<span class="info-box-number">{{ $cases }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-dark"><i class="fas fa-link"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total roles</span>
				<span class="info-box-number">{{ $roles }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	<div class="col-md-4 col-sm-6 col-12">
		<div class="info-box">
			<span class="info-box-icon bg-indigo"><i class="fas fa-user-clock"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Total permissions</span>
				<span class="info-box-number">{{ $permissions }}</span>
			</div>
			<!-- /.info-box-content -->
		</div>
		<!-- /.info-box -->
	</div>
	<!-- /.col -->
	
	<!-- /.col -->
</div>
@endsection