@extends('dashboard.layouts.app')

@section('title', 'Asset Management')

@section('asset_collapse', 'show')
@section('assets_active', 'active')
@section('list_assets_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> Asset Management</h3>

                        <div class="col-auto d-flex w-sm-100  mt-sm-0">
                            <a href="{{ route('assets.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New asset</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            @livewire('asset-management')
        </div>

    </div>

@endsection
