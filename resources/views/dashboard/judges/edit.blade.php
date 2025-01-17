@extends('dashboard.layouts.app')

@section('title', 'Edit judge')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Edit judge:: {{ $judge->name }}</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('judges') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form action="{{ route('judges.edit', $judge->slug) }}" method="POST">
                                @csrf
                                <input type="hidden" name="slug" value="{{ $judge->slug }}">
                                <div class="row">
                                    <!-- Judge Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Judge Name</label>
                                        <input
                                            type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            name="name"
                                            value="{{ old('name', $judge->name) }}"
                                            placeholder="Enter judge's name" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status*</label>
                                        <select class="form-control select2" name="status" id="status" required>
                                            <option></option>
                                            @foreach(status() as $status)
                                                <option value="{{ $status }}" {{ old('status', $judge->status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="courttype" class="form-label">Court type*</label>
                                        <select class="form-control select2" name="courttype" id="courttype" required>
                                            <option></option>
                                            @foreach($courttypes as $courttype)
                                                <option value="{{ $courttype->id }}" {{ old('courttype', $judge->courttype_id) == $courttype->id ? 'selected' : '' }}>{{ $courttype->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('courttype')" class="mt-2 text-danger" />
                                    </div>

                                    <div class="col mb-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="availability" @checked($judge->availability)>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">@if($judge->availability) Available @else Blocked @endif </label>
                                        </div>
                                        <small class="text-muted">This judge is available to be assigned to a court. Unchecking will set to unavailable to be assigned.</small>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Submit changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- Row end  -->

        </div>
    </div>
@endsection
