@extends('dashboard.layouts.app')

@section('title', 'Edit court')

@section('setting_active', 'active')


@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Edit court</h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('courts') }}" class="btn btn-info text-white w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->

            <div class="row align-item-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        {{--   <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                              <h6 class="mb-0 fw-bold ">List of courts</h6>
                          </div> --}}
                        <div class="card-body basic-custome-color">
                            <form action="{{ route('courts.edit', $court->slug) }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="court_name" class="form-label">Court name</label>
                                        <input type="text" class="form-control" name="court_name" id="court_name" value="{{ old('court_name', $court->name) }}" required>
                                        <x-input-error :messages="$errors->get('court_name')" class="mt-2 text-danger" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-control select2" name="status" id="status" required>
                                            <option></option>
                                            @foreach(editStatus() as $status)
                                                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : ( $court->status == $status ? 'selected' : '') }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('status')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="court_code"  class="form-label">Code</label>
                                        <input type="text" class="form-control" name="court_code" value="{{ old('court_code', $court->code) }}">
                                        <x-input-error :messages="$errors->get('court_code')" class="mt-2 text-danger" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="court_type"  class="form-label">Court type</label>
                                        <select class="form-control select2" name="court_type"  id="court_type">
                                            <option value=""></option>
                                            @foreach($courttypes as $court_type)
                                                <option value="{{ $court_type->id }}" {{ old('court_type') == $court_type->id ? 'selected' : ( $court->courttype_id == $court_type->id ? 'selected' : '') }} >{{ $court_type->name }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('court_type')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="location"  class="form-label">Location</label>
                                        <select class="form-control select2" name="location"  id="location">
                                            <option value=""></option>
                                            @if(old('court_type'))
                                                @foreach(fetch_locations(old('court_type')) as $location)
                                                    <option value="{{ $location->id }}" {{ old('location') == $location->id ? 'selected' : '' }} >{{ $location->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="{{ $court->locations->id }}" selected>{{ $court->locations->name }}</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('location')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="registry"  class="form-label">Registry</label>
                                        <select class="form-control select2" name="registry"  id="registry">
                                            <option value=""></option>
                                            @if(old('court_type'))
                                                @foreach(fetch_registries(old('location')) as $registry)
                                                    <option value="{{ $registry->id }}" {{ old('registry') == $registry->id ? 'selected' : '' }} >{{ $registry->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="{{ $court->registries?->id }}" selected>{{ $court->registries?->name }}</option>
                                            @endif
                                        </select>
                                        <x-input-error :messages="$errors->get('registry')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="col mb-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="availability" @checked($court->availability)>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Block</label>
                                        </div>
                                        @if($court->availability)
                                            <small class="text-muted">
                                                This court is available to be assigned cases. Unchecking will disable it from new allocations.
                                            </small>
                                        @else
                                            <small class="text-danger">
                                                This court is unavailable for case allocations. Enabling it will make it available for new allocations.
                                            </small>
                                        @endif
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary bg-gradient-primary btn-sm mt-3"><i class="fas fa-save"></i> Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- Row end  -->

        </div>
    </div>
@endsection
