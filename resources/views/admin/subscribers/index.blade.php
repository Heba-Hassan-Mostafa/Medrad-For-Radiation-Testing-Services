@extends('admin.layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
    {{ trans('dashboard.subscribers') }}
@endsection

@section('content')
    <h4 class="py-3">
        <a href="{{ route('admin.dashboard') }}">
            <span class="text-muted fw-light">{{ trans('dashboard.main') }}/
            </span>
        </a>
        {{ trans('dashboard.subscribers') }}
    </h4>

    <button type="button" class="btn btn-danger mb-4" id="btn_delete_all" data-bs-toggle="modal" data-bs-target="#modalCenter">
        <i class="fa fa-trash"></i> {{ trans('dashboard.delete_checkbox') }}
      </button>

    <div class="card">
        <div class="table-responsive p-2">
            <table class="myDatatable table table-bordered">
                <thead>

                    <tr>
                        <th class="wd-15p border-bottom-0">
                            <input type="checkbox" name="select_all" id="example-select-all" onclick="CheckAll('box1',this)">
                        </th>
                        <th>#</th>
                        <th>{{ trans('dashboard.subscriber_email') }}</th>
                        <th>{{ trans('dashboard.options') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscribers as $subscriber)
                        <tr>
                            <td><input type="checkbox" value="{{ $subscriber->id }}" class="box1"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subscriber->subscriber_email }}</td>
                            <td>
                                <div class="m-2">

                                    <a onclick="fireDeleteEvent({{ $subscriber->id }})" type="button"
                                        title="{{ trans('dashboard.delete') }}" data-toggle="tooltip"
                                        class="btn btn-danger btn-sm text-white"><i class="fas fa-trash-alt"></i></a>

                                    <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST"
                                        id="form-{{ $subscriber->id }}">
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

        <!-- Modal -->


  <!-- Modal -->
  <div class="modal fade" id="modalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"> {{ trans('dashboard.delete_subscribers') }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.subscribers.delete_all') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
               <span class="text-center" style="font-size: 18px">{{ trans('dashboard.warning-for-delete-all') }}</span>
                <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
            </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('dashboard.close') }}</button>
          <button type="submit" class="btn btn-danger">{{ trans('dashboard.save') }} </button>
        </div>
        </form>
      </div>
    </div>
  </div>





    </div>
@endsection
@section('script')
@toastr_js
@toastr_render
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#DataTables_Table_0 input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
                 //console.log(selected);
            });
            if (selected.length > 0) {
                $('#modalCenter').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>
@endsection
