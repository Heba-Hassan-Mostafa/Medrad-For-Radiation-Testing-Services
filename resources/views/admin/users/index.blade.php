@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.users') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.users') }}
    </h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">
        {{ trans('dashboard.add-new-user') }}
    </a>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.image') }}</th>
                        <th>{{ trans('dashboard.name') }}</th>
                        <th>{{ trans('dashboard.email') }}</th>
                        <th>{{ trans('dashboard.user-role') }}</th>
                        <th>{{ trans('dashboard.phone') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if (!empty($user->image->file_name))
                                <img src="{{ asset('Files/image/Users/'.$user->image->file_name) }}" style="width:50px;height:50px;" />
                                @else
                                <img src="{{ asset('Files/image/avatar.jpg') }}" style="width:50px;height:50px;" />
                                @endif

                            </td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->email }}</td>
                             <td class="text-center" style="width: 200px">
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="btn btn-success">{{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <label class="switch switch-success" for="{{ $user->id }}">
                                    <input type="checkbox" class="switch-input status" id="{{ $user->id }}"
                                        data-id="{{ $user->id }}" {{ $user->status == true ? 'checked' : '' }} />
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
                                        <a href="{{ route('admin.users.edit',$user->id) }}"  class="btn btn-info btn-sm text-white"  title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @if (!$user->hasRole('admin'))
                                        <a onclick="fireDeleteEvent({{ $user->id }})" type="button"
                                            title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                            class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            id="form-{{ $user->id }}">
                                            @csrf
                                            @method('Delete')
                                        </form>
                                        @endif

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
<script>
    $(function() {

        $('#DataTables_Table_0').on('change','.status',  function() {

            var status = $(this).prop('checked') == true ? 1 : 0;

            var id = $(this).data('id');
            console.log(status);

            $.ajax({

                type: "GET",

                dataType: "json",

                url: '{{ route('admin.users.change_status') }}',

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
