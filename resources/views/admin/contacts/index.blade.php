@extends('admin.layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ trans('dashboard.contact-us') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.contact-us') }}
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
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contact->fullname }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->contact_phone }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($contact->contact_message, 40) }}</td>
                            <td>
                                <div class="m-2 d-inline-block">

                                    <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalCenter-{{ $contact->id }}">
                                        <i class="fa fa-eye"></i>
                                        <span class="text"></span>
                                    </button>

                                    <a onclick="fireDeleteEvent({{ $contact->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.contact-us.destroy', $contact->id) }}" method="POST"
                                        id="form-{{ $contact->id }}">
                                        @csrf
                                        @method('Delete')
                                    </form>


                                </div>
                            </td>

                        </tr>
                        <!-- Modal -->
                     @include('admin.contacts.showContactUsModal')
                        <!-- modal -->
        </div>
        @endforeach
        </tbody>
        </table>
    </div>
    </div>
@endsection
