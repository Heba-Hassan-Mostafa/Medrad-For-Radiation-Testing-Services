<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"  dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
   <!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '269623179094429');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=269623179094429&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="{{ App\Models\Setting::where('key','website_name')->first()->value }}">
  <meta name="google-site-verification" content="YXw8Ik9ax4mZUOxhds6AA7zggJ-xM7euxcQyyc-t8pk" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="" name="twitter:site">
    <meta content="" name="twitter:creator">
    <meta content="" property="fb:pages">
    <meta content="" property="fb:app_id">
    <meta content="" property="fb:admins">
    <meta name="twitter:card" content="summary">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">
  
  
  
  
  @yield('meta')
  @include('feed::links')

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Gabarito&family=Open+Sans:ital,wght@0,400;0,600;0,700;0,800;1,600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('website/lib/awsome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('website/lib/bootstrap.min.css') }}" />
  @yield('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet" />

  <link href="{{ asset('website/lib/owl.carousel.css') }}" rel="stylesheet" />
  <link href="{{ asset('website/lib/owl.theme.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

  @if (App::getLocale() == 'en')
  <link rel="stylesheet" href="{{ asset('website/css/style.css') }}" />
  @else
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;700&amp;display=swap"
  rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('website/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('website/css/arstyle.css') }}" />
  @endif
  <link rel="stylesheet" href="{{ asset('website/css/mediaQ.css') }}" />
  <link rel="icon" href="{{ asset('Files/image/Settings/'.App\Models\Setting::where('key', 'icon')->first()->value) }}">
  {{-- @yield('css') --}}
  <title>@yield('title')</title>
  
  <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
</head>
