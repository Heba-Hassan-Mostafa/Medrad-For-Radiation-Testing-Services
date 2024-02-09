<script src="{{ asset('website/lib/jq.min.js') }}"></script>
<script src="{{ asset('website/lib/bootstrap.min.js') }}"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>-->

<script src="{{ asset('website/lib/awsome.min.js') }}"></script>
<script src="{{ asset('website/lib/owl.carousel.js') }}"></script>
<script src="{{ asset('website/js/main.js') }}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script>
    var phone_number = window.intlTelInput(document.querySelector(".phone_number"), {
        separateDialCode: true,
        preferredCountries: ["ae"],
        hiddenInput: "full",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });

    $("#modalQuote").submit(function() {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone[full]'").val(full_number);
        alert(full_number);
    });
</script>
<script>
    var phone_number = window.intlTelInput(document.querySelector(".quote_number"), {
        separateDialCode: true,
        preferredCountries: ["ae"],
        hiddenInput: "full",
        utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js"
    });

    $("#indexQuote").submit(function() {
        var full_number = phone_number.getNumber(intlTelInputUtils.numberFormat.E164);
        $("input[name='phone[full]'").val(full_number);
        alert(full_number);
    });
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G01Q1T0W79"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G01Q1T0W79');
</script>

  
  
    <script>
    
    // modal quote
    document.getElementById('modalQuote').addEventListener("click",function(){
         grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaResponse1').value = token;
              document.querySelector(".demo-form1").submit();
          });
    });
    
  </script>





  <script>
    
    jQuery.event.special.touchstart = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.touchmove = {
    setup: function( _, ns, handle ) {
        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
    }
};
jQuery.event.special.wheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("wheel", handle, { passive: true });
    }
};
jQuery.event.special.mousewheel = {
    setup: function( _, ns, handle ){
        this.addEventListener("mousewheel", handle, { passive: true });
    }
};
</script>
@yield('script')
