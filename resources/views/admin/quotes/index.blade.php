@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.quotes') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.quotes') }}
    </h4>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.name') }}</th>
                        <th>{{ trans('dashboard.email') }}</th>
                        <th>{{ trans('dashboard.phone') }}</th>
                        <th>{{ trans('dashboard.message') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotes as $quote)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $quote->fullname }}</td>
                            <td>{{ $quote->quote_email }}</td>
                            <td>{{ $quote->phone }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($quote->message, 40) }}</td>
                            <td>
                                <div class="m-2">

                                    <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter-{{ $quote->id }}">
                                    <i class="fa fa-eye"></i>
                                    <span class="text"></span>
                                </button>


                                    <a onclick="fireDeleteEvent({{ $quote->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.quotes.destroy', $quote->id) }}" method="POST"
                                        id="form-{{ $quote->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>
                                </div>
                            </td>

                        </tr>
                          <!-- Modal -->
                          <div class="modal fade" id="modalCenter-{{ $quote->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">
                                            {{ trans('dashboard.show_quote') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body pd-20">
                                        <div class="row">
                                            <div class="col-10">
                                                {{ $quote->message }}
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
@toastr_js
@toastr_render

@endsection
