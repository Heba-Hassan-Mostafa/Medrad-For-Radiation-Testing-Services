@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.gallery') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.gallery') }}
    </h4>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary mb-2">
        {{ trans('dashboard.add-new-gallery') }}
    </a>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                <th>#</th>
                <th>{{ trans('dashboard.gallery-title') }}</th>
                <th>{{ trans('dashboard.gallery-category') }}</th>
                <th>{{ trans('dashboard.image-count') }}</th>
                <th>{{ trans('dashboard.status') }}</th>
                <th>{{ trans('dashboard.creatred-at') }}</th>
                <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $gallery )
                    <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->category->name }}</td>
                            <td>{{ $gallery->images->count() }}</td>
                            <td><label class="btn btn-sm btn-{{ $gallery->status ?'success':'danger' }} pe-none">{{ $gallery->status() }}</label></td>
                            <td>{{ $gallery->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="m-2 d-flex">
                                        <a href="{{ route('admin.gallery.edit',$gallery->id) }}"
                                            class="btn btn-info btn-sm text-white m-1"  title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    <a onclick="fireDeleteEvent({{ $gallery->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white m-1"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST"
                                        id="form-{{ $gallery->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>

                                    <a href="{{ route('admin.gallery.show', $gallery->id) }}"
                                        class="btn btn-success btn-sm font-weight-bold m-1" role="button" aria-pressed="true">
                                         {{ trans('dashboard.caption') }}</a>
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
