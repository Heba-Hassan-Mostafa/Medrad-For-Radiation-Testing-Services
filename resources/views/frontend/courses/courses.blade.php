@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="radiation testing services, radiation testing, radiation measurement, radiation analysis, radiation detection, radiation monitoring, radiation assessment">
<meta name="description" content="Our radiation testing services provide comprehensive analysis and measurement of radiation levels in various environments. We offer precise radiation detection, monitoring, and assessment solutions to ensure safety and compliance. Contact us for reliable radiation testing services and expert analysis of radiation data">
@endsection
@section('title')
    {{ trans('frontend.courses') }}
@endsection
@section('content')
    <!-- start  section -->
    <section class="coursesPage">
        <div class="contactBackground">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 contact_text student">
                        <h1>{{ trans('frontend.courses') }}</h1>
                    </div>
                    <div class="fadeImg coursesImg col-md-6 d-flex justify-content-center">
                        <img src="{{ asset('website/images/student.webp') }}" class="img-fluid fade-out" alt="courses"
                            title="course-banner" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 welcomeCoursesText">
            <p>{{ trans('frontend.title1') }}</p>
            <h1>{{ trans('frontend.courses') }}</h1>
        </div>
        <?php
              $categories = App\Models\Category::with('courses')->Active()->CourseType()->get();
              ?>
        <div class="navCoursesCategories">
            <i class="fa-solid fa-arrow-down"></i>
            <ul class="ulCategoriesList">
                @forelse ($categories as $cat)
                <li><a href="">{{ $cat->name }}</a></li>
                @empty
                <span>{{ trans('frontend.no-cats') }}</span>
                @endforelse
            </ul>
        </div>
        <div class="coursesCard container">
            <div class="row justify-content-center">
                @forelse ($courses as $course)
                <div class="col-md-6 col-lg-3 card">
                    <div class="card-content courses_CardImg">
                        <img class="img-fluid" src="{{ asset('Files/image/Courses/'.$course->image->file_name) }}"
                        alt="{{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}"
                        title="{{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}"/>
                        <h3>{{ app()->getLocale() == 'en' ? $course->getTranslation('name', 'en') : $course->getTranslation('name', 'ar') }}</h3>
                        <p>
                            {{ app()->getLocale() == 'en' ? $course->getTranslation('content_home', 'en') : $course->getTranslation('content_home', 'ar') }}
                        </p>
                    </div>
                    <div class="card-link">
                        <a href="{{ route('website.courses.course_content',$course->slug) }}" class="moreServBtn">{{ trans('frontend.more') }}</a>
                    </div>
                </div>
                @empty
                <span class="text-center fw-bold text-danger">{{ trans('frontend.no-courses') }}</span>
                @endforelse


                <div class="float-right pagiCount">
                    {!! $courses->appends(request()->all())->links() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- end  section -->
@endsection
@section('script')
<script src="{{ asset('website/js/fade.js') }}"></script>

@endsection
