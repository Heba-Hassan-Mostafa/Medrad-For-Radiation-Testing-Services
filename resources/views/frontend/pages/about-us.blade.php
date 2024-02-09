@extends('frontend.layouts.master')
@section('meta')
<meta name="keywords" content="Radiation Quality Control Testing, Consulting, Radiation Assessment Services,Radiation Protection Training,FANR,DHA,MOH,HAAD,CT, Nuclear Medicine, CT, Cath-lab, C-Arm, Fluoroscopy, Lithotripsy,">
<meta name="description" content="MEDRAD is a Radiation Quality Control Testing, Consulting, Radiation Assessment Services, Lead Lining & Room Preparation, Radiation Protection Training, and Trading company in view of providing range of services in radiation safety will exceed regulatory requirements (FANR, DHA, MOH & HAAD). MEDRAD does all modalities of radiation shielding for radiation generators such as PET CT, Nuclear Medicine, CT, Cath-lab, C-Arm, Fluoroscopy, Lithotripsy, OPG and CBCT">
@endsection
@section('title')
{{ trans('frontend.about-us') }}
@endsection
@section('content')
<!-- start about section -->
<section class="aboutSection">
    <!--<div class="defult-img position-relative">-->
      <!-- <div class="overlay"></div> -->
    <!--  <picture class=" aboutImgResponsive">-->
    <!--    <img-->
    <!--      class="img-fluid w-100 aboutBanner"-->
    <!--      src="{{ asset('website/images/aboutbanner.webp') }}"-->
    <!--      alt="about-us"-->
    <!--      loading="lazy"-->
    <!--    />-->
    <!--  </picture>-->
    <!--</div>-->
    <div class="contactBackground blog">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 contact_text">
                        <h1>{{ trans('frontend.about-us') }}</h1>
                    </div>
                    <div class="fadeImg blogImg col-md-6 d-flex justify-content-center">
                        <img src="{{ asset('website/images/blog.webp') }}" class="img-fluid fade-out" alt="{{ trans('frontend.blog') }}" title="{{ trans('frontend.blog') }}" loading="lazy" />
                    </div>
                </div>
            </div>
        </div>
    <div class="container aboutPage mt-5">
      <div class="row align-items-center">
        <div class="col-lg-5 aboutPageImg">
          <img class="img-fluid" src="{{ asset('website/images/aboutPageCard.webp') }}" alt="" />
        </div>
        <div class="col-lg-7 aboutPageText">
          <h2>{{ trans('frontend.about-us') }}</h2>
          <!--<i class="fa-solid fa-turn-up"></i>-->

            {!! $about->about_us !!}

        </div>
      </div>
    </div>
    <div class="visionMission container mt-4">
      <h2>
        {{ trans('frontend.vision') }}
        <span>&</span>
        {{ trans('frontend.mission') }}
      </h2>
      <p class="pStatement">{{ trans('frontend.statement') }}</p>
      <div class="visionMissionCards row mt-5 justify-content-evenly">
        <div class="col-lg-4 visionCard mt-4">
          <div class="position-relative">
            <div class="overlay"></div>
            <img class="img-fluid" src="{{ asset('website/images/vision.webp') }}" alt="" />
            <p class="statementName">{{ trans('frontend.vision-statement') }}</p>
          </div>

          <p class="statementContent">
            {{ $about->vision }}
          </p>
        </div>
        <div class="col-lg-4 missionCard mt-4">
          <div class="position-relative">
            <div class="overlay"></div>
            <img class="img-fluid" src="{{ asset('website/images/mission.webp') }}" alt="" />
            <p class="statementName">{{ trans('frontend.mission-statement') }}</p>
          </div>

          <p class="statementContent">
            {{ $about->mission }}
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->
  <!-- start managment Team -->
  <?php
    $members = App\Models\TeamManagment::with('image')->active()->latest()->paginate(10);
  ?>
  <section class="managmentTeam mt-5 mb-5">
    <h6 class="titleMa">{{ trans('frontend.manage-team') }}</h6>
    <div class="container">
      <div class="row">
        <div class="span12">
          <div id="owl-manager" class="owl-carousel">
            @forelse ($members as $member)
            <div class="item">
                <div class="managmentCard text-center position-relative">
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

