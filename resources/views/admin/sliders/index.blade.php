@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.sliders') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.sliders') }}
    </h4>
    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary mb-2">
        {{ trans('dashboard.add-new-slider') }}
    </a>
    <a href="{{ route('admin.sliders.sort_slider') }}" class="btn btn-warning mb-2"
    role="button" aria-pressed="true"> <i class="fas fa-sort"></i>
    {{ trans('dashboard.change_order') }}</a>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.slider_title') }}</th>
                        <th>{{ trans('dashboard.image') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $slider->title }}</td>
                            <td>
                                @if(!empty($slider->image))
                                <img src="{{ asset('Files/Slider/'.$slider->image) }}" style="width:200px;height:100px;"></td>

                                @endif
                                <td>
                                    <label class="switch switch-success" for="{{ $slider->id }}">
                                        <input type="checkbox" class="switch-input status" id="{{ $slider->id }}" data-id="{{ $slider->id }}"
                                        {{ $slider->status == true ? 'checked' : '' }} />
                                        <span class="switch-toggle-slider">
                                          <span class="switch-on">
                                            <i class="ti ti-check"></i>
                                          </span>
                                          <span class="switch-off">
                                            <i class="ti ti-x"></i>
                                          </span>
                                        </span>
                                      </label>
                                </td>
                            <td>
                                <div class="m-2">
                                        <a href="{{ route('admin.sliders.edit',$slider->id) }}"  class="btn btn-info btn-sm text-white"  title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    <a onclick="fireDeleteEvent({{ $slider->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST"
                                        id="form-{{ $slider->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
@toastr_js
@toastr_render
<script>
    $(function() {

        $('#DataTables_Table_0').on('change','.status',  function() {

            var status = $(this).prop('checked') == true ? 1 : 0;

            var id = $(this).data('id');
            console.log(status);

            $.ajax({

                type: "GET",

                dataType: "json",

                url: '{{ route('admin.sliders.change_status') }}',

                data: {
                    'status': status,
                    'id': id
                },

                success: function(data) {

                    console.log(data.success)

                }

            });

        })

    })
</script>
@endsection
