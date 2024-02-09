@extends('frontend.layouts.master')
@section('meta')
    <meta name="keywords" content="{{ $course->keywords }}">
    <meta name="description" content="{{ $course->description }}">
    <meta property="og:title" content="{{ $course->name }}">
    <meta property="og:image" content="{{ asset('Files/image/Courses/'.$course->image->file_name) }}">
    <meta property="og:url" content="https://medradservices.com/courses/{{ $course->slug }}">
    <meta id="faceDes" property="og:description">
    <meta property="og:sitename" content="{{ App\Models\Setting::where('key', 'website_name')->first()->value }}">
@endsection
@section('title')
    {{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}
@endsection
@section('content')
    <!-- start  section -->
    <section class="servicesContent">
        <div class="defult-img position-relative">
            <div class="overlay"></div>
            <picture class="servicesImgResponsive">
                <img class="img-fluid w-100 aboutBanner categoriesBanner"
                    src="{{ asset('website/images/servicesContent.jpg') }}" alt="course-content-banner" title="banner"
                    loading="lazy" />
            </picture>
        </div>
        <div class="navPath container">
            <i class="fa-solid fa-house"></i>
            <a href="{{ route('website.index') }}">{{ trans('frontend.home') }}</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a href="{{ route('website.courses.all-courses') }}">{{ trans('frontend.courses') }}</a>
            <i class="fa-solid fa-chevron-right"></i>
            <a
                href="{{ route('website.courses.category.courses', $course->category->slug) }}">{{ $course->category->name }}</a>
        </div>
        <div class="servicesDetails container mt-5">
            <div class="row justify-content-around">
                <div class="col-lg-7 detailsSer">
                    <img class="img-fluid detailsSerImg" src="{{ asset('Files/image/Courses/'.$course->image->file_name) }}"
                    alt="{{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}"
                    title="{{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}" loading="lazy" />
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1> {{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}</h1>
                        </div>
                        <div class="shareSocial">
                            <span class="shareIcon"> {{ trans('frontend.share') }} :</span>
                                <button class="button" data-sharer="twitter"
                                    data-url="{{ route('website.courses.course_content',$course->slug) }}">
                                    <i class="fa-brands fa-square-twitter"></i>
                                </button>
                                <button class="button" data-sharer="facebook"
                                data-url="{{ route('website.courses.course_content',$course->slug) }}">
                                <i class="fa-brands fa-square-facebook"></i>
                            </button>
                                <button class="button" data-sharer="linkedin"
                                    data-url="{{ route('website.courses.course_content',$course->slug) }}">
                                    <i class="fa-brands fa-linkedin"></i>
                                </button>
                                <button class="button" data-sharer="whatsapp"
                                    data-url="{{ route('website.courses.course_content',$course->slug) }}">
                                    <i class="fa-brands fa-square-whatsapp"></i>
                                </button>
                                <button class="button" data-sharer="telegram"
                                    data-url="{{ route('website.courses.course_content',$course->slug) }}">
                                    <i class="fa-brands fa-telegram"></i>
                                </button>
                                <button class="button" data-sharer="email"
                                    data-url="{{ route('website.courses.course_content',$course->slug) }}">
                                    <i class="fa-solid fa-envelope"></i>
                                </button>



                        </div>
                    </div>
                    <p class="contentText">
                       {!! $course->content !!}
                    </p>
                </div>
                <div class="col-lg-5 relatedServices">
                    <h2 class="relatedHead">{{ trans('frontend.related-courses') }}</h2>
                    <div class="row relatedCards">
                        @forelse ($randomCourses as $random)
                        <div class="col-12 relatedCardBox">
                            <a href="{{ route('website.courses.course_content',$random->slug) }}" class="row">
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{ asset('Files/image/Courses/'.$random->image->file_name) }}"
                                    alt="{{ app()->getLocale() == 'en' ? $random->getTranslation('name', 'en') : $random->getTranslation('name', 'ar') }}"
                                    title="{{ app()->getLocale() == 'en' ? $random->getTranslation('name', 'en') : $random->getTranslation('name', 'ar') }}" loading="lazy" />
                                </div>
                                <div class="col-md-8">
                                    <h6>{{ app()->getLocale() == 'en' ? $random->getTranslation('name', 'en') : $random->getTranslation('name', 'ar') }}</h6>
                                    <p>
                                        {{ $random->content_home }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @empty
                        <span>{{ trans('frontend.no-courses') }}</span>
                        @endforelse



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end  section -->
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
@endsection
