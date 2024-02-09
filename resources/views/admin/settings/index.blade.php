@extends('admin.layouts.master')
@section('title')
    {{ trans('dashboard.settings') }}
@endsection
@section('css')
@endsection
@section('content')

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h4 class="py-3 mb-4">
        <a href="{{ route('admin.dashboard') }}">
            <span class="fw-light">{{ trans('dashboard.main') }}/ </span>
        </a>
        <a href="{{ route('admin.settings.index') }}">
            <span class="fw-light">{{ trans('dashboard.settings') }}</span>
        </a>

    </h4>
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.settings.update','test') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-12 mb-3">
                            <label for="website_name" class="form-label">{{ trans('dashboard.website_name') }}</label>
                            <input type="text" name="website_name"
                                value="{{ $setting['website_name'] }}" class="form-control" />
                            @error('website_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="website_mail" class="form-label">{{ trans('dashboard.website_mail') }}</label>
                            <input type="text" name="website_mail"
                                value="{{ $setting['website_mail'] }}" class="form-control" />
                            @error('website_mail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="website_mailService" class="form-label">{{ trans('dashboard.website_mailService') }}</label>
                            <input type="text" name="website_mailService"
                                value="{{ $setting['website_mailService'] }}" class="form-control" />
                            @error('website_mailService')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="website_phone" class="form-label">{{ trans('dashboard.website_phone') }}</label>
                            <input type="text" name="website_phone"
                                value="{{ $setting['website_phone'] }}" class="form-control" />
                            @error('website_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="website_phone2" class="form-label">{{ trans('dashboard.website_phone2') }}</label>
                            <input type="text" name="website_phone2"
                                value="{{ $setting['website_phone2'] }}" class="form-control" />
                            @error('website_phone2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="facebook" class="form-label">{{ trans('dashboard.facebook') }}</label>
                            <input type="text" name="facebook"
                                value="{{ $setting['facebook'] }}" class="form-control" />
                            @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label for="twitter" class="form-label">{{ trans('dashboard.twitter') }}</label>
                            <input type="text" name="twitter"
                                value="{{ $setting['twitter'] }}" class="form-control" />
                            @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="instagram" class="form-label">{{ trans('dashboard.instagram') }}</label>
                            <input type="text" name="instagram"
                                value="{{ $setting['instagram'] }}" class="form-control" />
                            @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="linkedIn" class="form-label">{{ trans('dashboard.linkedIn') }}</label>
                            <input type="text" name="linkedIn"
                                value="{{ $setting['linkedIn'] }}" class="form-control" />
                            @error('linkedIn')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="whatsApp" class="form-label">{{ trans('dashboard.whatsApp') }}</label>
                            <input type="text" name="whatsApp"
                                value="{{ $setting['whatsApp'] }}" class="form-control" />
                            @error('whatsApp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">{{ trans('dashboard.address') }}</label>
                            <input type="text" name="address"
                                value="{{ $setting['address'] }}" class="form-control" />
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="logo" class="form-label">{{ trans('dashboard.logo') }}</label>
                            <input type="file" name="logo" class="form-control"/>
                            @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if (!empty($setting['logo']))
                        <div class="mt-3">
                            <img style="width: 150px" height="150px" src="{{ URL::asset('Files/image/Settings/'.$setting['logo']) }}" alt="">
                        </div>
                        @endif
                        </div>
                        <div class="col-12 mb-3">
                            <label for="logo_footer" class="form-label">{{ trans('dashboard.logo-footer') }}</label>
                            <input type="file" name="logo_footer" class="form-control"/>
                            @error('logo_footer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if (!empty($setting['logo_footer']))
                        <div class="mt-3">
                            <img style="width: 150px" height="150px" src="{{ URL::asset('Files/image/Settings/'.$setting['logo_footer']) }}" alt="">
                        </div>
                        @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label for="icon" class="form-label">{{ trans('dashboard.icon') }}</label>
                            <input type="file" name="icon" class="form-control"/>
                            @error('icon')
                            <span class="text-danger">{{ $message }}</span>
                         @enderror
                         @if (!empty($setting['icon']))
                         <div class="mt-3">
                             <img style="width: 150px" height="150px" src="{{ URL::asset('Files/image/Settings/'.$setting['icon']) }}" alt="">
                         </div>
                         @endif
                        </div>
                        <div class="col-12 mb-3">
                            <label for="default_slider" class="form-label">{{ trans('dashboard.default_slider') }}</label>
                            <input type="file" name="default_slider" class="form-control"/>
                            @error('default_slider')
                            <span class="text-danger">{{ $message }}</span>
                         @enderror
                         @if (!empty($setting['default_slider']))
                         <div class="mt-3">
                             <img style="width: 300px" height="150px" src="{{ URL::asset('Files/image/Settings/'.$setting['default_slider']) }}" alt="">
                         </div>
                         @endif
                        </div>
                        <div class="col-12 mb-3">
                            <label for="website_footer_text" class="form-label">{{ trans('dashboard.website_footer_text') }}</label>
                            <input type="text" name="website_footer_text"
                                value="{{ $setting['website_footer_text'] }}" class="form-control" />
                            @error('website_footer_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="website_copyRight" class="form-label">{{ trans('dashboard.copyRight') }}</label>
                            <input type="text" name="website_copyRight"
                                value="{{ $setting['website_copyRight'] }}" class="form-control" />
                            @error('website_copyRight')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="keywords" class="form-label">{{ trans('dashboard.keywords') }}</label>
                            <input type="text" name="keywords"
                                value="{{ $setting['keywords'] }}" class="form-control" />
                            @error('keywords')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('dashboard.description') }}</label>
                            <textarea rows="5" cols="5" name="description" class="form-control" />{!!  $setting['description']  !!}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ trans('dashboard.save') }} </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/texteditor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.config.language = 'ar';
        CKEDITOR.replace('ckeditor', {
            filebrowserImageBrowseUrl: '/file-manager/ckeditor'
        });
    </script>
@endsection
