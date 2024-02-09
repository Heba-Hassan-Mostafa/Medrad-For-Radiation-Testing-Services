@extends('admin.layouts.master')
@section('css')
<link href="{{ asset('assets/plugins/bootstrap-fileinput/css/fileinput.min.css')}}" rel="stylesheet">

@endsection
@section('title')
{{ trans('dashboard.edit-gallery') }}
@endsection

@section('content')

    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{route('admin.gallery.index')}}">
            <span class="text-muted fw-light">{{trans('dashboard.gallery')}}/</span>
        </a>
        {{ trans('dashboard.edit-gallery') }}
    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('admin.gallery.update',$model->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="title" class="form-label">{{ trans('dashboard.gallery-title') }}</label>
                            <input type="text" name="title" value="{{ $model->title }}" class="form-control"/>
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="col-4 mb-3">
                            <label for="category_id" class="form-label">{{ trans('dashboard.cat-name') }}</label>
                            <select name="category_id" class="form-control">
                                <option selected disabled value="">{{ trans('dashboard.choose_cat') }}</option>
                                @forelse ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $model->category_id) == $cat->id ? 'selected' : null }}>
                                    {{ $cat->name }}</option>
                            @empty
                            @endforelse
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="col-4 mb-3">
                            <label for="status" class="form-label">{{ trans('dashboard.status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1"
                                    {{ old('status', $model->status) == '1' ? 'selected' : null }}>
                                    {{ trans('dashboard.active') }}</option>
                                <option value="0"
                                    {{ old('status', $model->status) == '0' ? 'selected' : null }}>
                                    {{ trans('dashboard.in-active') }}</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="image" class="form-label">{{ trans('dashboard.image') }}</label>
                            <input type="file" class="form-control"  name="images[]" id="gallery" multiple/>
                            @error('image')
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
<script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-fileinput/themes/fas/theme.min.js') }}"></script>

<script>
    $(function() {

        $("#gallery").fileinput({
            theme: "fas",
            maxFileCount: 20,
            allowedFileTypes: ['image'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false,
            initialPreview: [
                @if ($model->images()->count() > 0)
                    @foreach ($model->images as $image)
                        "{{ asset('Files/image/Gallery/' . $image->file_name) }}",
                    @endforeach
                @endif
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
            initialPreviewConfig: [
                @if ($model->images()->count() > 0)
                    @foreach ($model->images as $image)
                        {
                            caption: '{{ $image->file_name }}',
                            width: "120px",
                            url: "{{ route('admin.gallery.remove_image', ['image_id' => $image->id, 'gallery_id' => $model->id, '_token' => csrf_token()]) }}",
                            key: {{ $image->id }},
                            description: `<span>{{ $image->description }}</span>`,
                        },
                    @endforeach
                @endif
            ]
        });


    });
    </script>
@endsection
