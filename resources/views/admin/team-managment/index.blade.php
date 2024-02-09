@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.team_managments') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.team_managments') }}
    </h4>
    <a type="button" class="btn btn-primary mb-2 text-white" data-bs-toggle="modal" data-bs-target="#modalCenter">
        {{ trans('dashboard.add-new-member') }}
    </a>
    @include('admin.team-managment.create')
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.member_name') }}</th>
                        <th>{{ trans('dashboard.image') }}</th>
                        <th>{{ trans('dashboard.position') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->name }}</td>
                            <td>
                                @if(!empty($member->image->file_name))
                                <img src="{{ asset('Files/image/Team/'.$member->image->file_name) }}" style="width:50px;height:50px;">
                                @else
                                @if($member->gender == 'male')
                                <img src="{{ asset('website/images/manDef.svg') }}" style="width:50px;height:50px;">
                                @else
                                <img src="{{ asset('website/images/femaleDef.svg') }}" style="width:50px;height:50px;">
                                @endif

                                @endif
                            </td>
                            <td>{{ $member->position }}</td>


                            <td>
                                <label class="switch switch-success" for="{{ $member->id }}">
                                    <input type="checkbox" class="switch-input status" id="{{ $member->id }}" data-id="{{ $member->id }}"
                                    {{ $member->status == true ? 'checked' : '' }} />
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

                                        <a type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $member->id }}" title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @include('admin.team-managment.edit')

                                    <a onclick="fireDeleteEvent({{ $member->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.team_managment.destroy', $member->id) }}" method="POST"
                                        id="form-{{ $member->id }}">
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

                url: '{{ route('admin.team_managment.change_status') }}',

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
