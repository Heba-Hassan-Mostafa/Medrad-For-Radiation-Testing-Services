@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="radiation testing services, radiation testing, radiation measurement, radiation analysis, radiation detection, radiation monitoring, radiation assessment">
<meta name="description" content="Our radiation testing services provide comprehensive analysis and measurement of radiation levels in various environments. We offer precise radiation detection, monitoring, and assessment solutions to ensure safety and compliance. Contact us for reliable radiation testing services and expert analysis of radiation data">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('website/lib/lightgallery.min.css') }}" />
@endsection
@section('title')
    {{ trans('frontend.gallery') }}
@endsection
@section('content')
    <!-- start  section -->
    <section class="blog galleryPage">
        <div class="contactBackground">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 contact_text">
                        <h1>{{ trans('frontend.gallery') }}</h1>
                    </div>
                    <div class="fadeImg galleryImg col-md-6 d-flex justify-content-center">
                        <img src="{{ asset('website/images/z.webp') }}" class="img-fluid fade-out"
                            alt="{{ trans('frontend.gallery') }}" title="{{ trans('frontend.gallery') }}" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
        <!-- gallery -->
        <div class="container gallery_cate mt-5">
            <div class="galleryBox row justify-content-between">
                <div class="col-md-12 col-lg-3 categoryCard">
                    <div class="allCategories">
                        <h1 class="w-100">
                            <i class="fas fa-bars"></i>
                            {{ trans('frontend.categories') }}
                        </h1>
                    </div>
                    <div class="categoriesList">
                        <div class="allLinks">
                            <h2>
                                <i class="fas fa-bars"></i>
                                <a href="{{ route('website.gallery.images') }}">{{ trans('frontend.all-gallery') }}</a>
                            </h2>
                        </div>

                        <div class="categoriesList">
                            @forelse ($categories as $category)
                                <ul>

                                    <i class="fa-solid {{ app()->getLocale() == 'en' ? 'fa-turn-up' : 'fa-turn-down'}} "></i>
                                    <a href="{{ route('website.gallery.category', $category->slug) }}"
                                        title="{{ app()->getLocale() == 'en' ? $category->getTranslation('name', 'en') : $category->getTranslation('name', 'ar') }}">
                                        {{ app()->getLocale() == 'en' ? $category->getTranslation('name', 'en') : $category->getTranslation('name', 'ar') }}</a>
                                </ul>
                            @empty
                                <span class="text-center fw-bold text-danger">{{ trans('frontend.no-images') }}</span>
                            @endforelse

                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="pic row row-cols-1 row-cols-md-3 g-4">
                        @forelse ($images as $image)
                        <a href="{{ asset('Files/image/Gallery/'.$image->file_name) }}" class="col-sm-6 col-md-6 col-lg-4" data-sub-html=" {{ $image->description }} ">
                            <div class="card galleryPageCard h-100">
                                <img src="{{ asset('Files/image/Gallery/'.$image->file_name) }}" class="card-img-top img-zoom" alt="{{ $image->imageable->title }}" title="{{ $image->imageable->title }}" />
                            </div>
                        </a>
                        @empty
                        <span class="text-center fw-bold text-danger m-auto">{{ trans('frontend.no-images') }}</span>
                        @endforelse


                    </div>

                    <div class="float-right pagiCount">
                        {!! $images->appends(request()->all())->links() !!}
                    </div>

                </div>

            </div>
        </div>

    </section>
    <!-- end  section -->
@endsection
@section('script')
    <script src="{{ asset('website/lib/lightgallery.min.js') }}"></script>
    <script src="{{ asset('website/lib/lg-autoplay.min.js') }}"></script>
    <script src="{{ asset('website/js/fade.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.pic').lightGallery()
        })
    </script>
@endsection
