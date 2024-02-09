@extends('admin.layouts.master')
@section('title')
    {{ trans('dashboard.profile') }}
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        {{ trans('dashboard.profile') }}
    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.users.update-profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="first_name" class="form-label">{{ trans('dashboard.first_name') }}</label>
                            <input type="text" name="first_name" value="{{ auth()->user()->first_name }}" class="form-control" />
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="last_name" class="form-label">{{ trans('dashboard.last_name') }}</label>
                            <input type="text" name="last_name" value="{{ auth()->user()->last_name }}" class="form-control" />
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-3">
                            <label for="email" class="form-label">{{ trans('dashboard.email') }}</label>
                            <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" />
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="phone" class="form-label">{{ trans('dashboard.phone') }}</label>
                            <input type="text" name="phone" value="{{ auth()->user()->phone }}" class="form-control" />
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">{{ trans('dashboard.image') }}</label>
                            <input type="file" name="image" class="form-control"/>
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if (!empty(auth()->user()->image->file_name))
                            <img src="{{ asset('Files/image/Users/'.auth()->user()->image->file_name) }}" style="width: 100px;height:100px;padding-top:10px">
                        @endif
                        </div>
                      
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('dashboard.save') }} </button>
                </form>
            </div>
        </div>
    </div>
@endsection
