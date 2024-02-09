@extends('admin.layouts.master')
@section('title')
{{ trans('dashboard.edit-role') }}
@endsection
@section('content')

    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{route('admin.roles.index')}}">
            <span class="text-muted fw-light">{{trans('dashboard.roles')}}/</span>
        </a>
        {{ trans('dashboard.edit-role') }}
    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{route('admin.roles.update',$role->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">{{ trans('dashboard.role-name') }}</label>
                            <input type="text" name="name" value="{{ $role->name }}" class="form-control"/>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label
                                    style="font-weight: bold;
                                           font-size: 28px;
                                           color: #03aad7;"
                                    for="permission">{{ trans('dashboard.permissions') }}</label>
                                <br>
                                <input type="checkbox" name="select_all" id="example-select-all" onclick="CheckAll('box1',this)">
                                <label for='selectAll'> {{ trans('dashboard.select-all') }} </label>
                                <br>
                                <div class="row mt-3">
                                    @forelse ($permissions as $permission)
                                    <label class="col-md-3 rolesName">
                                    <input type="checkbox" name="permission[]" class="box1" value= "{{ $permission->id }}"  {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} >
                                    {{ $permission->name }}
                                    </label>
                                    @empty

                                    @endforelse
                                </div>
                                @error('permission')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                        <button type="submit" class="btn btn-primary mt-5">{{ trans('dashboard.save') }} </button>
                </form>
            </div>
        </div>
    </div>
@endsection
