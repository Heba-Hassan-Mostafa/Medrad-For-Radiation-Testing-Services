<script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
<script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<!-- endbuild -->
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<!-- Vendors JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>

<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<!-- Form Validation -->
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<!-- Editors -->
<script src="https://cdn.tiny.cloud/1/wfpnmtuhr72rq83u3ac7g2yrxnujpieg0c2dxieie58uoyml/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>

<!-- Page JS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script src="{{asset('assets/vendor/libs/chartjs/chartjs.js')}}"></script>
<script src="{{asset('assets/js/charts-chartjs.js')}}"></script>

<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

@yield('script')

<script>
    @if(\Illuminate\Support\Facades\Session::has('message'))
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{\Illuminate\Support\Facades\Session::get('message')}}',
        showConfirmButton: false,
        timer: 5000
    });
    @endif

  </script>
<script>
    // @if(\Illuminate\Support\Facades\Session::has('message'))
    // Swal.fire({
    //     position: 'top-end',
    //     icon: 'success',
    //     title: '{{\Illuminate\Support\Facades\Session::get('message')}}',
    //     showConfirmButton: false,
    //     timer: 1500
    // });
    // @endif

  function fireDeleteEvent(id) {
    Swal.fire({
      title: "{{ trans('dashboard.delete-confirm') }}",
      text: "{{ trans('dashboard.delete-confirm-message') }}",
      icon: 'warning',
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: "{{ trans('dashboard.close') }}",
      confirmButtonText: "{{ trans('dashboard.yes-delete') }}",
      customClass: {
        confirmButton: 'btn btn-primary me-1',
        cancelButton: 'btn btn-label-secondary'
      },
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "{{ trans('messages.deleted') }}",
          customClass: {
            confirmButton: 'btn btn-primary'
          },
          buttonsStyling: false

        });
        $('#form-' + id).submit();
      }
    })
  } //end fireDeleteEvent
  </script>
  <script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;

        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }

    }
</script>


  @livewireScripts
  <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
