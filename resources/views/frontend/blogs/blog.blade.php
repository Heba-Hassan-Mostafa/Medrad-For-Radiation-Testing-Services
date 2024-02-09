@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="radiation testing services, radiation testing, radiation measurement, radiation analysis, radiation detection, radiation monitoring, radiation assessment">
<meta name="description" content="Our radiation testing services provide comprehensive analysis and measurement of radiation levels in various environments. We offer precise radiation detection, monitoring, and assessment solutions to ensure safety and compliance. Contact us for reliable radiation testing services and expert analysis of radiation data">
@endsection
@section('title')
    {{ trans('frontend.blog') }}
@endsection
@section('content')
    <!-- start  section -->
    <section class="blog">
        <div class="contactBackground">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 contact_text">
                        <h1>{{ trans('frontend.blog') }}</h1>
                    </div>
                    <div class="fadeImg blogImg col-md-6 d-flex justify-content-center">
                        <img src="{{ asset('website/images/blog.webp') }}" class="img-fluid fade-out" alt="{{ trans('frontend.blog') }}" title="{{ trans('frontend.blog') }}" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
        <!-- blog cards -->
        <div class="blogCard mt-5 container">
            <!-- <h2>Blog</h2> -->
            <div class="row justify-content-center">
                @forelse ($blogs as $blog)
                <div class="col-md-5 col-lg-3 card">
                    <div class="card-content">
                        <div class="position-relative">
                            <div class="published_date">
                                <p class="date text-center">  {{ \Carbon\Carbon::parse($blog->publish_date)->format('d') }}</p>
                                <p class="month">  {{ \Carbon\Carbon::parse($blog->publish_date)->locale('en')->isoFormat('MMMM') }}</p>
                            </div>
                            <img class="img-fluid" src="{{ asset('Files/image/Blogs/'.$blog->image->file_name) }}"
                            alt="{{ app()->getLocale() == 'en' ? $blog->getTranslation('title', 'en') : $blog->getTranslation('title', 'ar') }}"
                            title="{{ app()->getLocale() == 'en' ? $blog->getTranslation('title', 'en') : $blog->getTranslation('title', 'ar') }}" />
                        </div>

                        <h3>{{ app()->getLocale() == 'en' ? $blog->getTranslation('title', 'en') : $blog->getTranslation('title', 'ar') }}</h3>
                        <p>
                           {!! app()->getLocale() == 'en' ? $blog->getTranslation('content_home', 'en') : $blog->getTranslation('content_home', 'ar')!!}
                        </p>
                    </div>
                    <div class="card-link">
                        <a href="{{ route('website.blog.blog_content',$blog->slug) }}" class="moreServBtn">{{ trans('frontend.more') }}</a>
                    </div>
                </div>
                @empty
                <span class="text-center fw-bold text-danger">{{ trans('frontend.no-blogs') }}</span>
                @endforelse
                <div class="float-right pagiCount">
                    {!! $blogs->appends(request()->all())->links() !!}
                </div>

            </div>
        </div>
    </section>
    <!-- end  section -->
@endsection
@section('script')
<script src="{{ asset('website/js/fade.js') }}"></script>
@endsection
