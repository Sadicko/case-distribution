@extends('dashboard.layouts.app')

@section('title', 'Case Categories')

@section('category_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-list-alt"></i> Case ategories</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->

            @livewire('categories')
        </div>
    </div>

@endsection
