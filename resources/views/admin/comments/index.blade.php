@extends('admin.layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('dashboard.comments') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.comments') }}
    </h4>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.comment_name') }}</th>
                        <th>{{ trans('dashboard.comment_email') }}</th>
                        <th>{{ trans('dashboard.comment_message') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->comment_email }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($comment->comment_message, 40) }}</td>
                            <td>
                                <label class="switch switch-success" for="{{ $comment->id }}">
                                    <input type="checkbox" class="switch-input status" id="{{ $comment->id }}"
                                        data-id="{{ $comment->id }}" {{ $comment->status == true ? 'checked' : '' }} />
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
                                <div class="m-2 d-inline-block">

                                    <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalCenter-{{ $comment->id }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="text"></span>
                                    </button>

                                    <a onclick="fireDeleteEvent({{ $comment->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                                        id="form-{{ $comment->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>


                                </div>
                            </td>

                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter-{{ $comment->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">
                                            {{ trans('dashboard.show_comment') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body pd-20">
                                        <div class="row">
                                            <div class="col-10">
                                                {{ $comment->comment_message }}
                                            </div>
                                        </div>

                                    </div><!-- modal-body -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ trans('dashboard.close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->
        </div>
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

                    url: '{{ route('admin.comments.change_status') }}',

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
