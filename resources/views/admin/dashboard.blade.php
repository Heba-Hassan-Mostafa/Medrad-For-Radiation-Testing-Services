@extends('admin.layouts.master')
@section('title')
    {{ trans('dashboard.main') }}
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">

            <div class="col-xl-4 mb-4 col-lg-5 col-12">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-7">
                            <div class="card-body text-nowrap">
                                <h5 style="width: fit-content" class="card-title mb-2">{{ trans('dashboard.welcome') }}
                                    {{ auth()->user()->first_name }}! 🎉</h5>
                                <p class="mb-2">
                                    @if (
                                        !empty(auth()->user()->getRoleNames()
                                        ))
                                        @foreach (auth()->user()->getRoleNames() as $v)
                                            <label class="btn btn-sm btn-success pe-none">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </p>
                                <a href="{{ route('admin.users.profile') }}"
                                    class="btn btn-primary waves-effect waves-light">{{ trans('dashboard.view_profile') }}</a>
                            </div>
                        </div>
                        <div class="col-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/card-advance-sale.png') }}" height="140"
                                    alt="view sales">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $members = App\Models\TeamManagment::latest()->get();
            ?>
            <!-- Website Analytics -->
            <div class="col-lg-7 mb-4">
                <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                    id="swiper-with-pagination-cards">
                    <div class="swiper-wrapper">
                        @foreach ($members as $member)
                            <div class="swiper-slide">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="text-white mb-0 mt-2 mb-2">{{ trans('dashboard.team_managments') }}</h5>
                                        <small>{{ App\Models\TeamManagment::count() }}
                                            {{ trans('dashboard.members') }}</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                                            <h6 class="text-white mt-0 mt-md-3 mb-3">{{ trans('dashboard.name') }}:
                                                {{ $member->name }}</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="d-flex mb-4 align-items-center">
                                                            <p class="mb-0">{{ trans('dashboard.position') }}:
                                                                {{ $member->position }}</p>
                                                        </li>

                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                            @if (!empty($member->image->file_name))
                                                <img src="{{ asset('Files/image/Team/' . $member->image->file_name) }}"
                                                    alt="Website Analytics" width="150" height="150px"
                                                    class="card-website-analytics-img rounded-circle" />
                                            @else
                                                @if ($member->gender == 'male')
                                                    <img src="{{ asset('website/images/manDef.svg') }}" alt=""
                                                        width="150" height="150px" class="card-website-analytics-img">
                                                @else
                                                    <img src="{{ asset('website/images/femaleDef.svg') }}" alt=""
                                                        width="150" height="150px" class="card-website-analytics-img">
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <!--/ Website Analytics -->

            {{-- Statistics --}}
            <div class="col-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">{{ trans('dashboard.statistics') }}</h5>
                            <small class="text-muted">{{ trans('dashboard.last_updated') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-2 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                        <i class="ti ti-medical-cross ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ App\Models\Service::count() }}</h5>
                                        <small>{{ trans('dashboard.stac_services') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-info me-3 p-2">
                                        <i class="ti ti-brand-youtube ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ App\Models\Course::count() }}</h5>
                                        <small>{{ trans('dashboard.stac_courses') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                        <i class="ti ti-highlight ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ App\Models\Blog::count() }}</h5>
                                        <small>{{ trans('dashboard.stac_blogs') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-success me-3 p-2">
                                        <i class="ti ti-photo ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">
                                            {{ App\Models\Image::where('imageable_type', 'App\Models\GalleryImage')->count() }}
                                        </h5>
                                        <small>{{ trans('dashboard.stac_images') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                        <i class="ti ti-user ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ App\Models\Subscriber::count() }}</h5>
                                        <small>{{ trans('dashboard.subscribers') }}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                        <i class="ti ti-file-dollar ti-sm"></i>
                                    </div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ App\Models\Quote::count() }}</h5>
                                        <small>{{ trans('dashboard.stac_quotes') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Statistics --}}

            <!-- Bar Charts -->
            <div class="col-xl-6 col-12 mb-4">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="card-title mb-0">{{ trans('dashboard.stats_quotes') }}</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="barChart" class="chartjs" data-height="400"></canvas>
                    </div>
                </div>
            </div>
            <!-- /Bar Charts -->

            <!-- Doughnut Chart -->
            <div class="col-lg-5 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">{{ trans('dashboard.stac_subscribers') }}</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                    <h1 class="mb-0">{{ App\Models\Subscriber::count() }}</h1>
                                    <p class="mb-0">{{ trans('dashboard.total_subscribers') }}</p>
                                </div>
                            </div>
                      <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
                      </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /Doughnut Chart -->

            <?php
            $orders = App\Models\Quote::latest()
                ->limit(3)
                ->get();
            ?>
            {{-- Quotes --}}
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center">
                            <i class="ti ti-list-details ms-n1 me-2"></i>
                            {{ trans('dashboard.quote_timeline') }}
                        </h5>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="timeline ms-1 mb-0">
                            @foreach ($orders as $order)
                                <li class="timeline-item timeline-item-transparent ps-4">
                                    <span class="timeline-point timeline-point-warning"></span>
                                    <div class="timeline-event">

                                     <div class="row align-items-center">
                                        <div class="col-md-4 avatar me-2">
                                            <img style="width: 40px" src="../../assets/img/avatars/3.png" alt="Avatar"
                                                class="rounded-circle">
                                        </div>

                                        <div class="col-md-8">
                                            <div class="timeline-header">
                                                <h6 class="mb-0">{{ $order->fullname }}</h6>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($order->created_at)->diffforhumans() }}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                        </div>

                                     </div>




                                        <div class="mt-3 ms-1 d-flex">
                                            <i class="menu-icon tf-icons ti ti-mail-filled"></i>
                                            <h6 class="mb-0">{{ $order->email }}</h6>
                                        </div>

                                        <div class="ms-1 d-flex">
                                            <i class="menu-icon tf-icons ti ti-phone"></i>
                                            <h6 class="mb-0">{{ $order->phone }}</h6>
                                        </div>
                                        <div class="ms-1 d-flex flex-wrap">
                                            <div>
                                                <i class="menu-icon tf-icons ti ti-message"></i>
                                                <span>{{ \Illuminate\Support\Str::limit($order->message, 200) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
            {{-- end quotes --}}

            <?php
            $contacts = App\Models\ContactUs::latest()
                ->limit(5)
                ->get();
            ?>
            {{-- contact-us --}}
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0 me-2">{{ trans('dashboard.stac_contact_us') }}</h5>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless border-top">
                            <thead class="border-bottom">
                                <tr>
                                    <th>{{ trans('dashboard.name') }}</th>
                                    <th>{{ trans('dashboard.email') }}</th>
                                    <th>{{ trans('dashboard.phone') }}</th>
                                    <th>{{ trans('dashboard.message') }}</th>
                                    <th>{{ trans('dashboard.options') }}</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center">
                                                {{ $contact->fullname }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <p class="mb-0 fw-medium">{{ $contact->email }}</p>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-label-success">{{ $contact->phone }}</span></td>
                                        <td>
                                            <p class="mb-0 fw-medium">
                                                {{ \Illuminate\Support\Str::limit($contact->message, 40) }}</p>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal"
                                                data-bs-target="#modalCenter-{{ $contact->id }}">
                                                <i class="fa fa-eye"></i>
                                                <span class="text"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    @include('admin.contacts.showContactUsModal')
                                    <!-- modal -->
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- end contact-us --}}
        </div>
    </div>
@endsection
