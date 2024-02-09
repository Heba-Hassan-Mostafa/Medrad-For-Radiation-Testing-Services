@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.categories') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.service-categories') }}
    </h4>
    <a type="button" class="btn btn-primary mb-2 text-white" data-bs-toggle="modal" data-bs-target="#modalCenter">
        {{ trans('dashboard.add-new-cat') }}
    </a>
    @include('admin.categories.create')
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.cat-name') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.category_type') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>{{ $cat->status() }}</td>
                            <td>{{ __('messages.' . $cat->category_type) }}</td>
                            <td>
                                <div class="m-2">
                                        <a type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalCenter-{{ $cat->id }}" title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @include('admin.categories.edit')

                                    <a onclick="fireDeleteEvent({{ $cat->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST"
                                        id="form-{{ $cat->id }}">
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
@endsection
