@extends('website.layouts.app')

@section('title',__('titles.register'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.register')])
<div class="profile-authentication-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="register-form" >
                    <h2>@lang('titles.register')</h2>
                    <form class=" needs-validation" method="POST"
                    novalidate action="{{ route('website.register.post',['locale' => $locale]) }}">
                    @csrf

                    <div class="form-group">
                        <label>@lang('attributes.name')</label>
                        <input required value="{{ old('name') }}" name="name" type="text"
                        class="form-control  @if ($errors->has('name')) is-invalid @endif"
                         placeholder="@lang('attributes.name')">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                        @else
                            <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                __('attributes.name') ])
                            </div>
                        @endif
                    </div>

                        <div class="form-group">
                            <label>@lang('attributes.mobile')</label>
                            <input required value="{{ old('mobile') }}" type="text" name="mobile"
                            class="form-control phone @if ($errors->has('mobile')) is-invalid @endif"
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
                            <label>@lang('attributes.email')</label>
                            <input required value="{{ old('email') }}" name="email" type="email"
                            class="form-control  @if ($errors->has('email')) is-invalid @endif"
                             placeholder="@lang('attributes.email')">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.email') ])
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('attributes.password')</label>
                            <input required value="" name="password" type="password"
                            class="form-control  @if ($errors->has('password')) is-invalid @endif"
                             placeholder="@lang('attributes.password')">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.password') ])
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>@lang('attributes.password_confirmation')</label>
                            <input required value="" name="password_confirmation" type="password"
                            class="form-control  @if ($errors->has('password_confirmation')) is-invalid @endif"
                             placeholder="@lang('attributes.password_confirmation')">
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.password_confirmation') ])
                                </div>
                            @endif
                        </div>

                        <button type="submit"> @lang('titles.register')</button>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <a href="{{ route('website.login',['locale' => $locale]) }}" class="lost-your-password text-center">
                                @lang('titles.have_account')</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-image">
                    <img src="{{  $setting && $setting->register_image ?  imagePath($setting->register_image) : asset('/assets/img/login.jpeg') }}" alt="about-image">
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
