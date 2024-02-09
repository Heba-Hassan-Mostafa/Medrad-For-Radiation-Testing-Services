@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.services') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.services') }}
    </h4>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-2">
        {{ trans('dashboard.add-new-service') }}
    </a>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.service_name') }}</th>
                        <th>{{ trans('dashboard.cat-name') }}</th>
                        <th>{{ trans('dashboard.image') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.publish_date') }}</th>
                        <th>{{ trans('dashboard.show_in_home') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->category->name }}</td>
                            <td>
                                @if(!empty($service->image->file_name))
                                <img src="{{ asset('Files/image/Services/'.$service->image->file_name) }}" style="width:50px;height:50px;">
                                @endif
                            </td>


                            <td><label class="btn btn-sm btn-{{ $service->status ?'success':'danger' }} pe-none">{{ $service->status() }}</label></td>
                            <td>{{ $service->publish_date }}</td>
                            <td>
                                <label class="switch switch-success" for="{{ $service->id }}">
                                    <input type="checkbox" class="switch-input show_home" id="{{ $service->id }}" data-id="{{ $service->id }}"
                                    {{ $service->show_in_home == true ? 'checked' : '' }} />
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
                                        <a href="{{ route('admin.services.edit',$service->id) }}"  class="btn btn-info btn-sm text-white"  title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>


                                    <a onclick="fireDeleteEvent({{ $service->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                        id="form-{{ $service->id }}">
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

        $('#DataTables_Table_0').on('change','.show_home', function() {

            var show_in_home = $(this).prop('checked') == true ? 1 : 0;

            var id = $(this).data('id');
            console.log(show_in_home);

            $.ajax({

                type: "GET",

                dataType: "json",

                url: '{{ route('admin.services.change_show_home') }}',

                data: {
                    'show_in_home': show_in_home,
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
