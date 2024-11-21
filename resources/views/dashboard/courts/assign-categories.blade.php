@extends('dashboard.layouts.app')

@section('title', 'Assign categories to court')

@section('setting_active', 'Roles')

@section('content')
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="h4 mb-0">Assign categories to <strong>{{ $court->name }}</strong></h3>
                        <div class="col-auto d-flex w-sm-100 mt-2 mt-sm-0">
                            <a href="{{ route('courts') }}" class="btn btn-info btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>


    <div class="row align-item-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-4 text-info">
                        Please note that the category option you choose, would determine the cases assigned to <strong>{{ $court->name }}</strong>
                    </h6>
                    <hr>
                    <div class="d-flex flex-wrap justify-content-between">
                        <h4 class="text-dark">Categories for courts</h4>
                        <div class="form-group">
                            <label class="fancy-checkbox element-left">
                                <input type="checkbox" name="checkAll" id="checkAll" {{ old('checkAll') ? 'checked' : '' }}>
                                <span>Check all categories</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <form method="POST" action="{{ route('courts.assign-categories', $court->slug) }}">
                        @csrf
                        <input type="hidden" name="slug" value="{{!empty($court) ? $court->slug : null }}">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="d-flex flex-wrap justify-content-between mt-2 bg-light pt-3 pl-3 pr-3">
                                    @foreach($categories as $category)
                                        <div class="form-group clearfix m-2">
                                            <label class="fancy-checkbox element-left">
                                                <input type="checkbox" name="categories[]" class="singleCheck"

                                                       @if(old('categories') && in_array($category->id, old('categories')))
                                                           checked
                                                       @else

                                                           @foreach ($court->categories as $court_category)
                                                               @if ($court_category->id == $category->id)
                                                                   checked
                                                       @endif
                                                       @endforeach

                                                       @endif
                                                       value="{{ $category->id }}">
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <hr>
                            <div class="form-group col-md-12">
                                <button class="btn btn-primary btn-round float-right"> <i class="fas fa-check"></i> Assign Categories</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
