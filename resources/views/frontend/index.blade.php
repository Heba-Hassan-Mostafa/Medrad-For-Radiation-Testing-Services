@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="{{ App\Models\Setting::where('key','keywords')->first()->value }}">
<meta name="description" content="{{ App\Models\Setting::where('key','description')->first()->value }}">
@endsection
@section('title')
   {{ App\Models\Setting::where('key','website_name')->first()->value }}
@endsection

@section('content')

    <!-- start slider -->
    @include('frontend.layouts.slider')
    

    <!-- end slider -->

    <!-- start Our main services -->
    <?php
    $services = App\Models\Service::with('image')
        ->Active()
        ->ShowInHome()
        ->ActiveCategory()
        ->latest()
        ->paginate(8);
    $about_us = App\Models\About::first();
    $comments = App\Models\Comment::whereStatus(1)
        ->latest()
        ->get();

        $members = App\Models\TeamManagment::with('image')->active()->latest()->paginate(10);
    ?>
    <section class="servSection pt-4">
        <div class="container">
            <div class="servTitle text-center fw-bold mt-4 mb-5">
                <p>{{ trans('frontend.title1') }}</p>
                <h2 class="fw-bold">{{ trans('frontend.title-service') }}</h2>
            </div>
            <div class="row justify-content-center m-auto">
                @forelse ($services as $service)
                    <div class="col-md-6 col-lg-4 col-xl-3 col-servCard">
                        <div class="servCard card">
                            <div class="card-content">
                                <img class="img-fluid" 
                                    src="{{ asset('Files/image/Services/' . $service->image->file_name) }}"
                                    alt="{{ $service->getTranslation('name', 'en') }}"
                                    title="{{ $service->getTranslation('name', 'en') }}" />
                                <h3>{{ app()->getLocale() == 'en' ? $service->getTranslation('name', 'en') : $service->getTranslation('name', 'ar') }}
                                </h3>
                                <p class="fw-bold">
                                    {{ app()->getLocale() == 'en' ? $service->getTranslation('content_home', 'en') : $service->getTranslation('content_home', 'ar') }}
                                </p>
                            </div>
                            <div class="card-link">
                                <a href="{{ route('website.services.service_content',$service->slug) }}"
                                
                                aria-label="{{ app()->getLocale() == 'en' ? $service->getTranslation('name', 'en') : $service->getTranslation('name', 'ar') }}"
                               
                                class="moreServBtn">{{ trans('frontend.more') }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <span>{{ trans('frontend.no-services') }}</span>
                @endforelse


            </div>
        </div>
    </section>

    <!-- start about us section -->
    <section class="aboutUsSection mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center aboutImgCard">
                    <img class="staticImg" src="{{ asset('website/images/about.jpg') }}" loading="lazy" alt="about" />
                    <div class="scoundImg">
                        <img src="{{ asset('website/images/about2.webp') }}" loading="lazy" alt="" />
                    </div>
                </div>
                <div class="col-lg-4 AboutContent">
                    <h3>{{ trans('frontend.about-us') }}</h3>
                    <i class="fa-solid fa-turn-up"></i>
                    <p>
                        {{ app()->getLocale() == 'en' ? $about_us->getTranslation('home_about_us', 'en') : $about_us->getTranslation('home_about_us', 'ar') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- start subscribe section -->
    <section class="subscribeSection">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 subscribeForm">
                    <p>
                        {{ trans('frontend.subscribe-title1') }}
                        <span class="d-block mt-2">
                            {{ trans('frontend.subscribe-title2') }}
                        </span>
                    </p>
                    <div class="inputParent position-relative mt-4">
                        <form action="{{ route('website.subscribe') }}" method="POST" class="demo-form3">
                            @csrf
                             <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse3">
                            @error('g-recaptcha-response')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                            <input class="subInput form-control m-auto" type="email" name="subscriber_email"
                                placeholder="{{ trans('frontend.email') }}" />
                            @error('subscriber_email')
                                <span class="text-danger fw-bold text-start">{{ $message }}</span>
                            @enderror
                            <button class="subBtn position-absolute" id="subBtn" type="submit">{{ trans('frontend.subscribe') }}</button>
                        </form>

                    </div>
                </div>
                <div class="col-md-6 subscribeSvg">
                    <img class="" src="{{ asset('website/images/newsletter.svg') }}" loading="lazy" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- start testimonial comments -->
    <section class="testimonial">
        <div class="overlay"></div>
        <div class="container">
            <h4>{{ trans('frontend.testimonial') }}</h4>
            <p class="ourClinetsP">{{ trans('frontend.testimonial-title') }}</p>
            <div>
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div id="owl-comment" class="owl-carousel">
                                @forelse ($comments as $comment)
                                    <div class="item">
                                        <div class="tesCard position-relative">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-circle-user"></i>
                                                <h6>{{ $comment->name }}</h6>
                                            </div>
                                            <p>
                                                {{ $comment->comment_message }}
                                            </p>
                                            <div class="quote-right">
                                                <i class="fa-solid fa-quote-right quote-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start add comment modal -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary addCommentBtn" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                {{ trans('frontend.add-comment') }}
            </button>
        </div>
        <!-- Modal -->
        @include('frontend.partials.CommentModal')
        <!-- end add comment modal  -->
    </section>
    <!-- start get qoute form -->
    <section class="getQuote">
        <div class="container">
            <h5>{{ trans('frontend.get_quote') }}</h5>
            <div class="row columReverse align-items-center justify-content-center mt-4">
                <div class="col-lg-7 quoteForm quoteFooter-">
                    <form action="{{ route('website.quote_index') }}" method="POST" class="demo-form2">
                        @csrf
                          <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse2">
                           @error('g-recaptcha-response')
                             <span class="col-md-10 text-danger fw-bold text-start">{{ $message }}</span>
                         @enderror
                        <div class="quoteInput d-flex row justify-content-center">
                            <input class="col-md-5" type="text" name="first_name_index" value="{{ old('first_name') }}"
                                placeholder="{{ trans('frontend.first_name') }}" />
                            <input class="col-md-5" type="text" name="last_name_index" value="{{ old('last_name') }}"
                                placeholder="{{ trans('frontend.last_name') }}" />

                            @error('first_name_index')
                            <span class="col-md-5 text-danger fw-bold text-center">{{ $message }}</span>
                            @enderror

                            @error('last_name_index')
                            <span class="col-md-5 text-danger fw-bold text-center">{{ $message }}</span>
                            @enderror

                            <input class="col-md-5" type="email" name="email_index" value="{{ old('email') }}"
                                placeholder="{{ trans('frontend.email') }}"
                                style="margin-right : 10"
                                />

                           <div class="inputFlagQuote col-md-5">
                                <input type="tel" name="phone[main]"
                                style=""
                                class="col-md-5 tel quote_number"
                                placeholder="{{ trans('frontend.phone') }}">
                           </div>
                           @error('phone')
                            <span class="col-md-5 text-danger fw-bold text-center">{{ $message }}</span>
                            @enderror

                           @error('email_index')
                           <span class=" col-md-9 text-danger fw-bold text-start">{{ $message }}</span>
                           @enderror


                            <textarea class="col-md-10" name="message_index" id="" cols="30" rows="10"
                                placeholder="{{ trans('frontend.message') }}"></textarea>
                            @error('message_index')
                            <span class="col-md-9 text-danger fw-bold text-start">{{ $message }}</span>
                            @enderror
                        </div>
                        <button class="sendQuote" id="indexQuote" type="submit">{{ trans('frontend.get_quote') }}</button>
                    </form>
                </div>
                <div class="col-lg-5 imgQuote">
                    <img class="img-fluid" src="{{ asset('website/images/quote.jpg') }}" alt="Get Quote"
                        title="Get Quote" />
                </div>
            </div>
        </div>
    </section>
    <!-- start managment Team -->
    <section class="managmentTeam mt-5">
        <h6 class="titleMa">{{ trans('frontend.manage-team') }}</h6>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div id="owl-manager" class="owl-carousel">
                        @forelse ($members as $member)
                        <div class="item">
                            <div class=" managmentCard text-center position-relative">
                                @if (!empty($member->image->file_name))
                                <img class="img-fluid" src="{{ asset('Files/image/Team/'.$member->image->file_name) }}" alt="{{ $member->name }}" title="{{ $member->name }}">
                                @else
                                @if ($member->gender == 'male')
                                <img class="img-fluid" src="{{ asset('website/images/manDef.svg') }}" alt="{{ $member->name }}" title="{{ $member->name }}">
                                @else
                                <img class="img-fluid" src="{{ asset('website/images/femaleDef.svg') }}" alt="{{ $member->name }}" title="{{ $member->name }}">
                                @endif
                                @endif
                                <div class="mt-3">
                                    <h6>{{ $member->name }}</h6>
                                    <span class="position">{{ $member->position }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <span>{{ trans('frontend.no-members') }}</span>
                        @endforelse


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')

<script>
     //index qoute
    document.getElementById('indexQuote').addEventListener("click",function(){
         grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaResponse2').value = token;
              document.querySelector(".demo-form2").submit();
          });
    });
    // index subscriber
    
    document.getElementById('subBtn').addEventListener("click",function(){
         grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaResponse3').value = token;
              document.querySelector(".demo-form3").submit();
          });
    });
    
    //comment
    
    document.getElementById('indexComment').addEventListener("click",function(){
         grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'submit'}).then(function(token) {
              document.getElementById('recaptchaResponse4').value = token;
              document.querySelector(".demo-form4").submit();
          });
    });
    
</script>
@endsection
