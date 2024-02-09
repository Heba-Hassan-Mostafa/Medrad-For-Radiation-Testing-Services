@extends('admin.layouts.master')
@section('title')
{{ trans('dashboard.about_us') }}
@endsection
@section('css')
@endsection
@section('content')

    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{route('admin.about_us.index')}}">
            <span class="fw-light">{{trans('dashboard.about_us')}}</span>
        </a>

    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('admin.about_us.update',$about->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-12 mb-3">
                            <label for="home_about_us" class="form-label">{{ trans('dashboard.home_about_us') }}</label>
                            <input dir="rtl" type="text" name="home_about_us" value="{{ $about->getTranslation('home_about_us','ar') }}" class="form-control"/>
                            @error('home_about_us')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="home_about_us" class="form-label">{{ trans('dashboard.home_about_us_en') }}</label>
                            <input type="text" name="home_about_us_en" value="{{ $about->getTranslation('home_about_us','en') }}" class="form-control"/>
                            @error('home_about_us')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.about_us_ar') }}</label>
                            <textarea rows="5" name="about_us" id="ckeditor1" class="form-control">{!! $about->getTranslation('about_us','ar') !!}</textarea>
                            @error('about_us')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.about_us_en') }}</label>
                            <textarea rows="5" name="about_us_en" id="ckeditor2" class="form-control">{!! $about->getTranslation('about_us','en') !!}</textarea>
                            @error('about_us')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.vision_ar') }}</label>
                            <textarea dir="rtl" rows="5" name="vision" class="form-control">{!! $about->getTranslation('vision','ar') !!}</textarea>
                            @error('vision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.vision_en') }}</label>
                            <textarea rows="5" name="vision_en" class="form-control">{!! $about->getTranslation('vision','en') !!}</textarea>
                            @error('vision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.mission_ar') }}</label>
                            <textarea dir="rtl" rows="5" name="mission" class="form-control">{!! $about->getTranslation('mission','ar') !!}</textarea>
                            @error('mission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.mission_en') }}</label>
                            <textarea rows="5" name="mission_en" class="form-control">{!! $about->getTranslation('mission','en') !!}</textarea>
                            @error('mission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <button type="submit" class="btn btn-primary">{{ trans('dashboard.save') }} </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/texteditor/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('ckeditor1' ,{
        filebrowserImageBrowseUrl: '/file-manager/ckeditor'
    });
</script>
<script>
    CKEDITOR.replace('ckeditor2' ,{
        filebrowserImageBrowseUrl: '/file-manager/ckeditor'
    });
</script>

@endsection
