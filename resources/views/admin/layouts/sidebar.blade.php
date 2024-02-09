<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link m-0">
            <span class="app-brand-logo demo" style="height: 70px ; width : 100px">

                <img src="{{ URL::asset('Files/image/Settings/' . \App\Models\Setting::where('key', 'logo')->first()->value) }}"
                    alt="logo" class="img-fluid" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            {{-- <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>--}}
            {{-- <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i> --}}
            <i class="ti ti-menu-2"></i>



        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ url()->current() == route('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div>{{ trans('dashboard.main') }} </div>
            </a>
        </li>
        {{-- categories --}}
        <li class="menu-item {{ url()->current() == route('admin.categories.index') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-menu"></i>
                <div>{{ trans('dashboard.categories') }} </div>
            </a>
        </li>
        {{-- services --}}
        <li class="menu-item {{ url()->current() == route('admin.services.index') ? 'active' : '' }}">
            <a href="{{ route('admin.services.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-medical-cross"></i>
                <div>{{ trans('dashboard.services') }} </div>
            </a>
        </li>

        {{-- Courses --}}
        <li class="menu-item {{ url()->current() == route('admin.courses.index') ? 'active' : '' }}">
            <a href="{{ route('admin.courses.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-brand-youtube"></i>
                <div>{{ trans('dashboard.courses') }} </div>
            </a>
        </li>

        <!-- gallery -->
        <li class="menu-item {{ url()->current() == route('admin.gallery.index') ? 'active' : '' }}">
            <a href="{{ route('admin.gallery.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-photo"></i>
                <div>{{ trans('dashboard.gallery') }} </div>
            </a>
        </li>

        <!-- slider -->
        <li class="menu-item {{ url()->current() == route('admin.sliders.index') ? 'active' : '' }}">
            <a href="{{ route('admin.sliders.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-movie"></i>
                <div>{{ trans('dashboard.sliders') }} </div>
            </a>
        </li>

        {{-- blogs --}}
        <li class="menu-item {{ url()->current() == route('admin.blogs.index') ? 'active' : '' }}">
            <a href="{{ route('admin.blogs.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-highlight"></i>
                <div>{{ trans('dashboard.blogs') }} </div>
            </a>
        </li>
        <!-- subscribers -->
        <li class="menu-item {{ url()->current() == route('admin.subscribers.index') ? 'active' : '' }}">
            <a href="{{ route('admin.subscribers.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div>{{ trans('dashboard.subscribers') }} </div>
            </a>
        </li>

        <!-- comments -->
        <li class="menu-item {{ url()->current() == route('admin.comments.index') ? 'active' : '' }}">
            <a href="{{ route('admin.comments.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-message"></i>
                <div>{{ trans('dashboard.comments') }} </div>
            </a>
        </li>



        <!-- team managment -->
        <li class="menu-item {{ url()->current() == route('admin.team_managment.index') ? 'active' : '' }}">
            <a href="{{ route('admin.team_managment.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>{{ trans('dashboard.team_managments') }} </div>
            </a>
        </li>

        <!-- Quote -->
        <li class="menu-item {{ url()->current() == route('admin.quotes.index') ? 'active' : '' }}">
            <a href="{{ route('admin.quotes.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div>{{ trans('dashboard.quotes') }} </div>
            </a>
        </li>


        <!-- about-us -->
        <li class="menu-item {{ url()->current() == route('admin.about_us.index') ? 'active' : '' }}">
            <a href="{{ route('admin.about_us.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-exclamation"></i>
                <div>{{ trans('dashboard.about_us') }} </div>
            </a>
        </li>


        <!-- users -->
        <li class="menu-item ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div style="font-size: 14px">{{ trans('dashboard.users') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ url()->current() == route('admin.roles.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.index') }}" class="menu-link">
                        <div>{{ trans('dashboard.roles') }}</div>
                    </a>
                </li>
            </ul>

            <ul class="menu-sub">
                <li class="menu-item {{ url()->current() == route('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}" class="menu-link">
                        <div>{{ trans('dashboard.users') }}</div>
                    </a>
                </li>
            </ul>
        </li>


        <!-- contact-us-->
        <li class="menu-item {{ url()->current() == route('admin.contact-us.index') ? 'active' : '' }}">
            <a href="{{ route('admin.contact-us.index') }}" class="menu-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-pause me-2"
                    width="22" height="22" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                    </path>
                    <path d="M20 3l0 4"></path>
                    <path d="M16 3l0 4"></path>
                </svg>
                <div>{{ trans('dashboard.contact-us') }}</div>
            </a>
        </li>

        <!-- contact-us-->
        <li class="menu-item {{ url()->current() == route('admin.settings.index') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                <i class="ti ti-settings me-2 ti-sm"></i>
                <div>{{ trans('dashboard.settings') }}</div>
            </a>
        </li>

        <li class="menu-item {{ url()->current() == route('admin.activity-log') ? 'active' : '' }}">
            <a href="{{ route('admin.activity-log') }}" class="menu-link">
                <i class="ti ti-settings me-2 ti-sm"></i>
                <div>{{ trans('dashboard.activity-log') }}</div>
            </a>
        </li>
    </ul>

</aside>
<!-- / Menu -->
