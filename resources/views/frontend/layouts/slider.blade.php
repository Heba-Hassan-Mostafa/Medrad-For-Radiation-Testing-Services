<?php
$sliders = \App\Models\Slider::whereStatus(1)
    ->orderBy('order_position', 'asc')
    ->paginate(5);
?>
@if ($sliders->count() > 0)
    <div id="carouselExampleFade" class="carousel slide carousel-fade sliderControl" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('Files/Slider/' . $slider->image) }}" class="d-block w-100"
                        alt="{{ $slider->title }}" title="{{ $slider->title }}" />
                </div>
            @endforeach
        </div>
        <div class="carousel-inner"></div>
        @if ($sliders->count() > 1)
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="prev">
                <span class="chevron" aria-hidden="true">
                    <i class="fa-solid fa-circle-chevron-left"></i>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                data-bs-slide="next">
                <span class="chevron" aria-hidden="true">
                    <i class="fa-solid fa-circle-chevron-right"></i>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
        @endif
    </div>
@else
    <!-- start home defult img -->

    <div class="defult-img position-relative">
        <div class="overlay"></div>
        <div class="titleText position-absolute">
            <h1>Medrad</h1>
            <p class="m-0">For Radiation Testing</p>
            <p class="m-0">Services</p>
            <!-- <a href="" class="btnQuote">Get Quote</a> -->
            <button type="button" class="nav-link navGetQuote btnQuote" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">{{ trans('frontend.get_quote') }}
            </button>
            <div class="social d-flex justify-content-center">
                <span class="socalLine">
                    {{ trans('frontend.social') }}
                    <i class="fa-solid fa-window-minimize socialLine"></i>
                </span>
                <div class="socialMediaIcon">
                    <a href="{{ App\Models\Setting::where('key', 'facebook')->first()->value }}" target="_blank"
                        title="facebook" rel="nofollow"><i class="fa-brands fa-square-facebook"></i></a>
                    <a href="{{ App\Models\Setting::where('key', 'linkedIn')->first()->value }}" target="_blank"
                        title="linkedIn" rel="nofollow"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="{{ App\Models\Setting::where('key', 'instagram')->first()->value }}" target="_blank"
                        title="instagram" rel="nofollow"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ App\Models\Setting::where('key', 'twitter')->first()->value }}" target="_blank"
                        title="twitter" rel="nofollow"><i class="fa-brands fa-square-twitter"></i></a>
                    <a href="https://api.whatsapp.com/send?phone={{ App\Models\Setting::where('key', 'whatsApp')->first()->value }}"
                        target="_blank" title="whatsApp" rel="nofollow"><i class="fa-brands fa-square-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <picture class="">
            <source srcset="" media="(max-width : 200px)" />
            <img class="img-fluid w-100"
                src="{{ asset('Files/image/Settings/' . App\Models\Setting::where('key', 'default_slider')->first()->value) }}"
                alt="defultImg" title="{{ App\Models\Setting::where('key', 'website_name')->first()->value }}">
        </picture>
    </div>





@endif
