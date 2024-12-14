@extends('website.layouts.app')

@section('title',__('titles.login'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.login')])
<div class="profile-authentication-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="login-form" >
                    <h2>@lang('titles.login')</h2>
                    <form class=" needs-validation" method="POST"
                    novalidate action="{{ route('website.login.post',['locale' => $locale]) }}">
                    @csrf
                        <div class="form-group">
                            <label>@lang('attributes.mobile')</label>
                            <input required type="text" name="mobile"
                            value="{{ old('mobile') }}"
                            class="form-control phone  @if ($errors->has('mobile')) is-invalid @endif"
                             placeholder="@lang('attributes.mobile')">
                            @if ($errors->has('mobile'))
                                <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.mobile') ])
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('attributes.password')</label>
                            <input required name="password" type="password" class="form-control" placeholder="@lang('attributes.password')">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.password') ])
                                </div>
                            @endif
                        </div>
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 remember-me-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me">
                                    <label class="form-check-label" for="remember-me">@lang('attributes.remember')</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 lost-your-password-wrap">
                                <a href="{{ route('website.forgot-account',['locale' => $locale]) }}" class="lost-your-password">@lang('titles.forgot_password')</a>
                            </div>
                        </div>
                        <button type="submit"> @lang('titles.login')</button>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <a href="{{ route('website.register',['locale' => $locale]) }}" class="lost-your-password text-center">@lang('titles.do_not_have_account')</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-image">
                    <img src="{{  $setting && $setting->login_image ?  imagePath($setting->login_image) :  asset('/assets/img/login.jpeg') }}" alt="about-image">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('/assets/js/validate.js') }}"></script>
    <script>
        const input = document.querySelector(".phone");
        window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
        });
    </script>
@endsection
