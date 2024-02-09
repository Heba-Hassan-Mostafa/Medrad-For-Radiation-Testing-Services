<div class="main-nav container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('website.index') }}">
                <img class="nav-img-logo"
                    src="{{ asset('Files/image/Settings/' . App\Models\Setting::where('key', 'logo')->first()->value) }}"
                    alt="{{ App\Models\Setting::where('key', 'website_name')->first()->value }}"
                    title="{{ App\Models\Setting::where('key', 'website_name')->first()->value }}" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="togglerIcon">
                    <i class="fa-solid fa-bars"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ route('website.index') }}">{{ trans('frontend.home') }}</a>
                    <a class="nav-link" href="{{ route('website.about-us') }}">{{ trans('frontend.about-us') }}</a>
                    <a class="nav-link" href="{{ route('website.services.all-services') }}">{{ trans('frontend.services') }}</a>
                    <a class="nav-link" href="{{ route('website.courses.all-courses') }}">{{ trans('frontend.courses') }}</a>
                    <a class="nav-link" href="{{ route('website.gallery.images') }}">{{ trans('frontend.gallery') }}</a>
                    <a class="nav-link" href="{{ route('website.contact-us') }}">{{ trans('frontend.contact-us') }}</a>
                    <a class="nav-link" href="{{ route('website.blog.blog') }}">{{ trans('frontend.blog') }}</a>
                    <div class="globalQuote">

                        <div class="dropdown-center changeLangBtn">
                            @if (App::getLocale() == 'ar')
                                <button type="button" class="nav-link  hide-arrow" 
                                    data-bs-toggle="dropdown">
                                    English
                                </button>
                            @else
                                <button type="button" class="nav-link  hide-arrow" 
                                    data-bs-toggle="dropdown">
                                    العربية
                                </button>
                            @endif
                            <i class="globalIcon fa-solid fa-globe"></i>

                            <ul class="dropdown-menu">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                            <i class="globalIcon fa-solid fa-globe"></i>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>





                        <button type="button" class="nav-link navGetQuote" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">{{ trans('frontend.get_quote') }}
                        </button>
                        

                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
