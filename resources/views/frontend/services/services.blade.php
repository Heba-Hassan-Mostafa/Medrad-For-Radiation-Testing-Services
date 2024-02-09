@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="radiation testing services, radiation testing, radiation measurement, radiation analysis, radiation detection, radiation monitoring, radiation assessment">
<meta name="description" content="Our radiation testing services provide comprehensive analysis and measurement of radiation levels in various environments. We offer precise radiation detection, monitoring, and assessment solutions to ensure safety and compliance. Contact us for reliable radiation testing services and expert analysis of radiation data">
@endsection
@section('title')
{{ trans('frontend.services') }}
@endsection
@section('content')
 <!-- start  section -->
 <section class="servicesPage blog galleryPage">
    <div class="contactBackground">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 contact_text">
                    <h1>{{ trans('frontend.services') }}</h1>
                </div>
                <div class="fadeImg galleryImg col-md-6 d-flex justify-content-center">
                    <img src="{{ asset('website/images/z.webp') }}" class="img-fluid fade-out"
                        alt="{{ trans('frontend.gallery') }}" title="{{ trans('frontend.gallery') }}" loading="lazy" />
                </div>
            </div>
        </div>
    </div>

    <div class="servSection pt-4">
      <div class="container">
        <div class="servTitle text-center fw-bold mt-4 mb-5">
          <p>{{ trans('frontend.title1') }}</p>
          <h2 class="fw-bold">{{ trans('frontend.title-service') }}</h2>
        </div>

        <div class="row services_categories m-auto mb-5">
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
                  <a href="{{ route('website.services.all-services') }}" title="{{ trans('frontend.all-services') }}">{{ trans('frontend.all-services') }}</a>
                </h2>
              </div>
              <?php
              $categories = App\Models\Category::with('services')->Active()->ServiceType()->get();
              ?>
              <div class="categoriesList">
                @forelse ($categories as $cat)
                <ul>
                    @if ( app()->getLocale() == 'en')
                    <i class="fa-solid fa-turn-up"></i>
                    @else
                    <i style="font-size: 16px" class="fa-solid fa-arrow-turn-down"></i>
                    @endif
                    <a href="{{ route('website.services.category.services',$cat->slug) }}">{{ app()->getLocale() == 'en' ? $cat->getTranslation('name', 'en') : $cat->getTranslation('name', 'ar') }}</a>
                  </ul>
                @empty
                  <span>{{ trans('frontend.no-cats') }}</span>
                @endforelse

              </div>

            </div>
          </div>

          <div class="col-lg-9 d-flex row justify-content-center">
            @forelse ($services as $service)
            <div class="col-md-6 col-lg-6 col-xl-4 col-servCard">
                <div class="servCard card">
                  <div class="card-content">
                    <img class="img-fluid" src="{{ asset('Files/image/Services/'.$service->image->file_name) }}"  alt="{{ app()->getLocale() == 'en' ? $service->getTranslation('name', 'en') : $service->getTranslation('name', 'ar') }}"
                    title="{{ app()->getLocale() == 'en' ? $service->getTranslation('name', 'en') : $service->getTranslation('name', 'ar') }}" />
                    <h5>{{ app()->getLocale() == 'en' ? $service->getTranslation('name', 'en') : $service->getTranslation('name', 'ar') }}</h5>
                    <p class="fw-bold">
                        {{ app()->getLocale() == 'en' ? $service->getTranslation('content_home', 'en') : $service->getTranslation('content_home', 'ar') }}
                    </p>
                  </div>
                  <div class="card-link".>
                    <a href="{{ route('website.services.service_content',$service->slug) }}" target="_blank" title="{{ trans('frontend.more') }}" class="moreServBtn">{{ trans('frontend.more') }}</a>
                  </div>
                </div>
              </div>
            @empty

            <span class="text-center fw-bold text-danger">{{ trans('frontend.no-services') }}</span>
            @endforelse
            <div class="float-right pagiCount">
                {!! $services->appends(request()->all())->links() !!}
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- end  section -->
@endsection
@section('script')
    <script src="{{ asset('website/js/fade.js') }}"></script>
@endsection
