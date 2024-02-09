@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="Radiation Quality Control Testing, Consulting, Radiation Assessment Services,Radiation Protection Training,FANR,DHA,MOH,HAAD,CT, Nuclear Medicine, CT, Cath-lab, C-Arm, Fluoroscopy, Lithotripsy,x ray">
<meta name="description" content="Baynunah Tower, AlHisn Al Markhaziyah West Office 07,Floor No:03, Abu Dhabi medrad for radiation testing services +971 528991866 +971 527477666 info@medradservices.com">
@endsection
@section('title')
    {{ trans('frontend.contact-us') }}
@endsection

@section('content')
    <!-- start  section -->
    <section class="contactUsPage">
        <div class="contactBackground">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 contact_text">
                        <h1>{{ trans('frontend.contact-us') }}</h1>
                        <p>{{ trans('frontend.contact-us-title') }}</p>
                    </div>
                    <div class="fadeImg contactImg col-md-6 d-flex justify-content-center">
                        <img src="{{ asset('website/images/contact-img.webp') }}" class="img-fluid fade-out" alt=""
                            loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
        <!-- contact form -->
        <div class="contactForm container">

            <div class="contactFormBox">
                <h5 class="text-center fw-bold">{{ trans('frontend.contact-us') }}</h5>
                <form action="{{ route('website.add-contact-us') }}" method="POST" class="demo-form5">
                    @csrf
                     <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse5">
                     @error('g-recaptcha-response')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                    <div class="quoteInput d-flex row justify-content-center">
                        <input class="col-md-5" type="text" name="contact_first_name" value="{{ old('first_name') }}"
                            placeholder="{{ trans('frontend.first_name') }}" />
                        @error('contact_first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input class="col-md-5" type="text" name="contact_last_name" value="{{ old('last_name') }}"
                            placeholder="{{ trans('frontend.last_name') }}" />
                        @error('contact_last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input class="col-md-5" type="email" name="email" value="{{ old('email') }}"
                            placeholder="{{ trans('frontend.email') }}" />
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input class="col-md-5" type="text" name="contact_phone" value="{{ old('phone') }}"
                            placeholder="{{ trans('frontend.phone') }}" />
                        @error('contact_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <textarea class="col-md-10" name="contact_message" cols="30" rows="10" placeholder="{{ trans('frontend.message') }}"></textarea>
                        @error('contact_message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button  class="sendQuote"  type="submit" id="indexContactUs">{{ trans('frontend.send') }}</button>

                </form>
            </div>
        </div>
        <!-- map -->
        <div class="mapLocation container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7262.161894630102!2d54.350016!3d24.482652!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e667705d3471b%3A0xf2e1ae270d3548f4!2sBaynunah%202%20Tower!5e0!3m2!1sen!2sin!4v1698249499433!5m2!1sen!2sin"
                width="100%" height="500" style="border: 0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
    <!-- end  section -->
@endsection
@section('script')
    <script src="{{ asset('website/js/fade.js') }}"></script>
   
    <script>
    document.getElementById('indexContactUs').addEventListener("click",function(){
         grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaResponse5').value = token;
              document.querySelector(".demo-form5").submit();
          });
    });
    </script>
@endsection
