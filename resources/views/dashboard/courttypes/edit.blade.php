@extends('dashboard.layouts.app')

@section('title', 'Edit Court type')

@section('setting_active', 'active')


@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="h4 mb-0">Edit Court type</h3>
                <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                    <a href="{{ route('courttypes.index') }}" class="btn btn-info text-white  w-sm-100"><i class="fas fa-chevron-left me-2"></i>Back</a>
                </div>
            </div>
        </div>
    </div> <!-- Row end  -->

    <div class="row align-item-center">
        <div class="col-md-12">
            <div class="card mb-3">
               {{--  <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">New courts</h6>
                </div> --}}
                <div class="card-body basic-custome-color">
                   @if ($errors->any())
                   <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('courttypes.update', $courttype->slug) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="row">


                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required value="{{ $courttype->name }}">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" name="code" class="form-control" required value="{{ $courttype->code }}">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label">Status</label>
                            <select type="text" name="status" class="form-control select2" required style="width: 100%">
                                <option value=""></option>
                                @foreach(editStatus() as $status)
                                <option value="{{ $status }}" {{ $status == $courttype->status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- Row end  -->

</div>
</div>
@endsection
