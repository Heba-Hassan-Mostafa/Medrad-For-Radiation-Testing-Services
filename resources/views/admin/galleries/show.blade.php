@extends('admin.layouts.master')
@section('title')
    {{ trans('dashboard.add-caption') }}
@endsection

@section('content')
    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{ route('admin.gallery.index') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.gallery') }}/</span>
        </a>
        {{ trans('dashboard.add-caption') }}
    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row m-auto justify-content-center">
                    <form action="{{ route('admin.gallery.caption', $model->id) }}" method="Post"
                        enctype="multipart/form-data">
                        @csrf
                        <input class="text" type="hidden" id="update_all_id" name="update_all_id" value=''>

                        <div class="col-12">
                            <br>
                            @if ($items->count() > 0)
                                <div class="row m-auto justify-content-center">
                                    @foreach ($items as $image)
                                        <div class="file-loading pDiv col-3"
                                            style="
                                                    box-shadow: 1px 1px 10px #ccc;
                                                    padding: 14px;
                                                    border-radius: 10px;
                                                    margin: 25px 5px;">
                                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                                            <img class="img-fluid"
                                                src="{{ asset('Files/image/Gallery/' . $image->file_name) }}"
                                                style="height:200px; width:100%">

                                            <textarea class="allInputs w-100"
                                                style="height: 120px;
                                                        margin-top:14px;
                                                        border: 1px solid #ccc;
                                                        border-radius: 10px"
                                                type="text" name="description" value="" placeholder=" {{ trans('dashboard.add-caption-img') }}">{{ $image->description }}</textarea>

                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="form-group pt-4">
                            <button type="submit" name="save" class="saveInputs btn btn-primary">
                                {{ trans('dashboard.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let saveInputBtn = document.querySelector(".saveInputs");
        let callDiv = document.querySelectorAll(".pDiv");
        let selected = new Array();
        callDiv.forEach(e => {
            let newElement = document.createElement("textarea");
        });
        let callIn = document.querySelectorAll(".allInputs");
        saveInputBtn.onclick = function() {
            callIn.forEach((v) => {
                selected.push(v.value)
                let inputId = document.querySelector("#update_all_id");
                inputId.value = selected;
            })
        }
    </script>
@endsection
