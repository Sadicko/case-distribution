@extends('dashboard.layouts.app')

@section('title', 'Edit registry')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Edit registry</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 text-danger mt-sm-0">
                            <a href="{{ route('registries') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body basic-custome-color">
                            <form action="{{route('registries.edit', $registry->slug)}}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name"  class="form-label">Registry name</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') ?? $registry->name }}" required>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="registry_code"  class="form-label">Registry code</label>
                                        <input type="text" class="form-control" name="registry_code" value="{{ old('registry_code') ?? $registry->code }}" required>
                                        <x-input-error :messages="$errors->get('registry_code')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email"  class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') ?? $registry->email }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="location"  class="form-label">Location</label>
                                        <select class="form-control select2" name="location" required id="location">
                                            <option value=""></option>
                                            @foreach($locations as $location)
                                                <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : ($registry->location_id == $location->id ? 'selected' : '') }} >{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="court_type"  class="form-label">Court type</label>
                                        <select class="form-control select2" name="court_type">
                                            <option value=""></option>
                                            @foreach($courttypes as $court_type)
                                            <option value="{{ $court_type->id }}" {{ old('court_type') == $court_type->id ? 'selected' : ($registry->courttype_id == $court_type->id ? 'selected' : '') }} >{{ $court_type->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('region')" class="mt-2 text-danger" />
                                        </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status"  class="form-label">Status</label>
                                        <select class="form-control select2" name="status" required>
                                            @foreach(editStatus() as $status)
                                                <option value="{{ $status }}" {{ $registry->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                    </div>



                                    <div class="col-md-12">

                                        <button type="submit" class="btn btn-primary bg-gradient-primary btn-sm mt-3"><i class="fas fa-save"></i> Save changes</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
