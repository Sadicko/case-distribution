@extends('dashboard.layouts.app')

@section('title', 'Case management')

@section('cases_collapse', 'show')
@section('case_active', 'active')
@section('list_case_active', 'active')

@section('content')

    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0 text-uppercase"><i class="fas fa-folder-open"></i> Case Management</h3>

                        @canany(['Create cases', 'Upload cases'])
                            <div class="col-auto d-flex w-sm-100  mt-sm-0">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    New
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                    @can('Create cases')
                                        <li><a class="dropdown-item" href="{{ route('cases.create') }}">Case filing</a></li>
                                    @endcan
                                    @can('Upload cases')
                                        <li><a class="dropdown-item" href="{{ route('upload-cases') }}">Case upload </a></li>
                                    @endcan
                                </ul>
                                {{--                                <a href="{{ route('cases.create') }}" class="btn btn-dark  w-sm-100"><i class="fas fa-plus-circle me-2"></i>New asset</a>--}}
                            </div>
                        @endcanany
                    </div>
                </div>
            </div> <!-- Row end  -->

            @if(!empty(session('already_exist_cases')))
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            The following records were found to be duplicates. <a href="#!" class="clear-session text-secondary ml-2"><i class="fas fa-calendar-times"></i> Clear</a>
                            <table class="table">
                                <tr>
                                    <th>##</th>
                                    <th>Suit number</th>
                                    <th>Case title</th>
                                    <th>Case category</th>
                                    <th>Status</th>
                                </tr>
                                <tbody>
                                @foreach(session('already_exist_cases') as $old_cases)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{  $old_cases['suit_no'] }}</td>
                                        <td>{{  $old_cases['case_title'] }}</td>
                                        <td>{{  $old_cases['case_category'] }}</td>
                                        <td>{{  $old_cases['status'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @livewire('docket-manager')

        </div>

    </div>

@endsection
