@include('frontend.partials.quoteModal')
 <!-- section contact Us -->
 <section class="contactUS mt-5">
     <div class="container">
         <h5>{{ trans('frontend.contact-us') }}</h5>
         <div class="row mt-5 justify-content-center text-center">
             <div class="contactCard col-lg-3">
                 <i class="fa-solid fa-location-dot"></i>
                 <h6 class="contactTitle">{{ trans('frontend.head-office') }}</h6>
                 <p class="contactText">{{ App\Models\Setting::where('key','address')->first()->value }}</p>
             </div>
             <div class="contactCard col-lg-3">
                 <i class="fa-solid fa-phone"></i>
                 <h6 class="contactTitle">{{ trans('frontend.call-us') }}</h6>
                 <p class=" contactText contactPhone">
                     <span>{{ App\Models\Setting::where('key','website_phone')->first()->value }}</span>
                     <span>{{ App\Models\Setting::where('key','website_phone2')->first()->value }}</span>
                 </p>
             </div>
             <div class="contactCard col-lg-3">
                 <i class="fa-solid fa-envelope"></i>
                 <h6 class="contactTitle">{{ trans('frontend.email-address') }}</h6>
                 <p class="contactText">{{ App\Models\Setting::where('key','website_mail')->first()->value }}</p>
             </div>

         </div>
     </div>
 </section>
 <!-- end section -->

 <footer>
     <div class="container footerLogo">
         <div class="row justify-content-center">
             <div class="col-md-6 col-lg-4">
                 <img class="img-fluid wLogo" src="{{ asset('Files/image/Settings/'.App\Models\Setting::where('key', 'logo_footer')->first()->value) }}" alt="{{ App\Models\Setting::where('key', 'website_name')->first()->value }}"
                 title="{{ App\Models\Setting::where('key', 'website_name')->first()->value }}">
                 <p class="footerText">
                    {{ App\Models\Setting::where('key', 'website_footer_text')->first()->value }}
                 </p>
                 <div class="footerSocial">
                     <a href="{{ App\Models\Setting::where('key', 'facebook')->first()->value }}" target="_blank" rel="nofollow" title="Facebook"><i class="fa-brands fa-facebook"></i></a>
                     <a href="{{ App\Models\Setting::where('key', 'linkedIn')->first()->value }}" target="_blank" rel="nofollow" title="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                     <a href="{{ App\Models\Setting::where('key', 'instagram')->first()->value }}" target="_blank" rel="nofollow" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                     <a href="{{ App\Models\Setting::where('key', 'twitter')->first()->value }}" target="_blank" rel="nofollow" title="Twitter"><i class="fa-brands fa-square-twitter"></i></a>
                     <a href="https://api.whatsapp.com/send?phone={{ App\Models\Setting::where('key', 'whatsApp')->first()->value }}" target="_blank" rel="nofollow" title="WhatsApp"><i class="fa-brands fa-square-whatsapp"></i></a>
                 </div>
             </div>
         </div>

     </div>
     <hr />
     <div class="copyRight">
         <p>
            {{ App\Models\Setting::where('key', 'website_copyRight')->first()->value }}
         </p>
         <p>
             Developed By <a href="{{ route('website.index') }}">We Can</a>
         </p>
     </div>

     <button id="scrollToTop">
         <i class="fas fa-chevron-circle-up"></i>
     </button>
     <div itemscope="" itemtype="http://schema.org/Movie"></div>
 </footer>
