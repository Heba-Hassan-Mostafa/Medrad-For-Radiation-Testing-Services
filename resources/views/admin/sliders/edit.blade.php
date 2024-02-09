@extends('admin.layouts.master')
@section('title')
    {{ trans('dashboard.edit_slider') }}
@endsection
@section('css')
@endsection
@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{ route('admin.sliders.index') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.sliders') }}/</span>
        </a>
        {{ trans('dashboard.edit_slider') }}
    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.sliders.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="title" class="form-label">{{ trans('dashboard.slider_title_ar') }}</label>
                            <input type="text" name="title" value="{{ $slider->getTranslation('title','ar') }}" class="form-control" />
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-6 mb-3">
                            <label for="title" class="form-label">{{ trans('dashboard.slider_title_en') }}</label>
                            <input type="text" name="title_en" value="{{ $slider->getTranslation('title','en') }}" class="form-control" />
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--<div class="col-6 mb-3">-->
                        <!--    <label for="link" class="form-label">{{ trans('dashboard.slider_link') }}</label>-->
                        <!--    <input type="url" name="link" value="{{ $slider->link }}" class="form-control" />-->
                        <!--    @error('link')-->
                        <!--        <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->

                        <div class="col-6 mb-3">
                            <label for="status" class="form-label">{{ trans('dashboard.status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $slider->status) == '1' ? 'selected' : null }}>
                                    {{ trans('dashboard.active') }}</option>
                                <option value="0" {{ old('status', $slider->status) == '0' ? 'selected' : null }}>
                                    {{ trans('dashboard.in-active') }}</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!--<div class="col-12 mb-3">-->
                        <!--    <label for="description" class="form-label">{{ trans('dashboard.slider_description') }}</label>-->
                        <!--    <input type="text" name="description" value="{{ $slider->getTranslation('description','ar') }}"-->
                        <!--        class="form-control" />-->
                        <!--    @error('description')-->
                        <!--        <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <!--<div class="col-12 mb-3">-->
                        <!--    <label for="description" class="form-label">{{ trans('dashboard.slider_description_en') }}</label>-->
                        <!--    <input type="text" name="description_en" value="{{ $slider->getTranslation('description','en') }}"-->
                        <!--        class="form-control" />-->
                        <!--    @error('description')-->
                        <!--        <span class="text-danger">{{ $message }}</span>-->
                        <!--    @enderror-->
                        <!--</div>-->
                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">{{ trans('dashboard.image') }}</label>
                            <span class="d-block fw-bold">Recommended width
                                <span class="text-danger">1600px</span>
                                & height
                                <span class="text-danger">600px</span>
                            </span>
                            <input type="file" accept="image/*" name="image" class="form-control" />
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if (!empty($slider->image))
                            <img src="{{ asset('Files/Slider/'.$slider->image) }}" style="width:400px;height:200px;padding-top:10px">
                        @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('dashboard.save') }} </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
