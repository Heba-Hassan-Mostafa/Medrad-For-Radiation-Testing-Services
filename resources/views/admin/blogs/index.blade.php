@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.blogs') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.blogs') }}
    </h4>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mb-2">
        {{ trans('dashboard.add-new-blog') }}
    </a>
    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('dashboard.blog_title') }}</th>
                        <th>{{ trans('dashboard.image') }}</th>
                        <th>{{ trans('dashboard.status') }}</th>
                        <th>{{ trans('dashboard.publish_date') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>
                                @if(!empty($blog->image->file_name))
                                <img src="{{ asset('Files/image/Blogs/'.$blog->image->file_name) }}" style="width:50px;height:50px;"></td>

                                @endif
                            <td><label class="btn btn-sm btn-{{ $blog->status ?'success':'danger' }} pe-none">{{ $blog->status() }}</label></td>
                            <td>{{ $blog->publish_date }}</td>
                            <td>
                                <div class="m-2">
                                        <a href="{{ route('admin.blogs.edit',$blog->id) }}"  class="btn btn-info btn-sm text-white"  title="{{ trans('dashboard.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                    <a onclick="fireDeleteEvent({{ $blog->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                                        id="form-{{ $blog->id }}">
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
