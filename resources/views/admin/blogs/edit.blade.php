@extends('admin.layouts.master')
@section('title')
{{ trans('dashboard.edit-blog') }}
@endsection
@section('css')

    <link rel="stylesheet" href="{{ asset('assets/plugins/pickadate/themes/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/pickadate/themes/classic.date.css') }}">
    <style>
        .picker__select--month,
        .picker__select--year {
            padding: 0 !important;
        }
    </style>
@endsection
@section('content')

    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{route('admin.blogs.index')}}">
            <span class="text-muted fw-light">{{trans('dashboard.blogs')}}/</span>
        </a>
        {{ trans('dashboard.edit-blog') }}
    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('admin.blogs.update',$blog->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="title" class="form-label">{{ trans('dashboard.blog_title_ar') }}</label>
                            <input dir="rtl" type="text" name="title" value="{{ $blog->getTranslation('title','ar') }}" class="form-control"/>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="title" class="form-label">{{ trans('dashboard.blog_title_en') }}</label>
                            <input type="text" name="title_en" value="{{ $blog->getTranslation('title','en') }}" class="form-control"/>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="col-6 mb-3">
                            <label for="status" class="form-label">{{ trans('dashboard.status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $blog->status) == '1' ? 'selected' : null }}>
                                    {{ trans('dashboard.active') }}</option>
                                <option value="0" {{ old('status', $blog->status) == '0' ? 'selected' : null }}>
                                    {{ trans('dashboard.in-active') }}</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-3">
                            <label for="publish_date" class="form-label">{{ trans('dashboard.publish_date') }}</label>
                            <input type="text" id="publish_date" name="publish_date" value="{{ $blog->publish_date }}" class="form-control">
                            @error('publish_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="content_home" class="form-label">{{ trans('dashboard.content_home') }}</label>
                            <input dir="rtl" type="text" name="content_home" value="{{ $blog->getTranslation('content_home','ar') }}" class="form-control"/>
                            @error('content_home')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="content_home" class="form-label">{{ trans('dashboard.content_home_en') }}</label>
                            <input type="text" name="content_home_en" value="{{ $blog->getTranslation('content_home','en') }}" class="form-control"/>
                            @error('content_home')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.content') }}</label>
                            <textarea rows="5" name="content" id="ckeditor1" class="form-control">{!! $blog->getTranslation('content','ar') !!}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.content_en') }}</label>
                            <textarea rows="5" name="content_en" id="ckeditor2" class="form-control">{!! $blog->getTranslation('content','en') !!}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">{{ trans('dashboard.image') }}</label>
                            <input type="file" name="image" class="form-control"/>
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if (!empty($blog->image->file_name))
                            <img src="{{ asset('Files/image/Blogs/'.$blog->image->file_name) }}" style="width: 100px;height:100px;padding-top:10px">
                        @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label for="keywords" class="form-label">{{ trans('dashboard.keywords') }}</label>
                            <input type="text" name="keywords" value="{{ $blog->keywords  }}" class="form-control"/>
                            @error('keywords')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ trans('dashboard.description') }}</label>
                            <textarea rows="5" name="description" class="form-control">{!! $blog->description !!}</textarea>
                            @error('description')
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

    <!-- datepicker -->
    <script src="{{ asset('assets/plugins/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/plugins/pickadate/picker.date.js') }}"></script>
    <script>
        $('#publish_date').pickadate({
            format: 'yyyy-mm-dd',
            selectMonths: true, // Creates a dropdown to control month
            selectYears: false, // Creates a dropdown to control month
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: true // Close upon selecting a date,
        });
        var publishdate = $('#publish_date').pickadate('picker');


        $('#publish_date').change(function() {
            selected_ci_date = "";
            selected_ci_date = $('#publish_date').val();
            if (selected_ci_date != null) {
                var cidate = new Date(selected_ci_date);
                min_codate = "";
                min_codate = new Date();
                min_codate.setDate(cidate.getDate() + 1);

            }
        });
    </script>

@endsection
