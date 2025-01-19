@extends('admin.layouts.app')

@section('title', 'Admin dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total users
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-users"></i>
                    <span class="badge bg-white text-dark">{{ $users }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total admins
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-user-cog"></i>
                    <span class="badge bg-white text-dark">{{ $admins }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total Registry Users
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-user-circle"></i>
                    <span class="badge bg-white text-dark">{{ $totalRegistryUsers }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total Court Users
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-user-plus"></i>
                    <span class="badge bg-white text-dark">{{ $totalCourtUsers }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total Expiring/Expired accounts
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-user-slash"></i>
                    <span class="badge bg-white text-dark">{{ $expiring_users }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total Cases
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-folder-open"></i>
                    <span class="badge bg-white text-dark">{{ $totalDockets }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total Courts
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-landmark"></i>
                    <span class="badge bg-white text-dark">{{ $totalCourts }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total judges
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="badge bg-white text-dark">{{ $totalJudges }}</span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total roles
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-lock"></i>
                    <span class="badge bg-white text-dark">{{ $roles }}</span>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4" style="height: 8rem">
                <div class="card-body d-flex justify-content-between">
                    Total permissions
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <i class="fas fa-lock-open"></i>
                    <span class="badge bg-white text-dark">{{ $permissions }}</span>
                </div>
            </div>
        </div>

        <!-- /.col -->
    </div>
@endsection
