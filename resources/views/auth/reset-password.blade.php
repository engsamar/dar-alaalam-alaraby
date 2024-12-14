@extends('website.layouts.app')
@section('title',__('titles.reset'))

@section('content')
    @includeIf('website.layouts.pages.breadcum', ['title' => __('titles.reset')])

    <div class="profile-authentication-area ptb-100">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="login-form" >
                        <h2>@lang('titles.reset')</h2>
                        <form action="{{ route('website.forgot-password.reset',['locale' => $locale]) }}" method="post" novalidate
                            class="needs-validation">
                            @csrf
                            <h2></h2>
                            <div class="login-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('mobile')) is-invalid @endif">
                                            <label for="mobile" class="col-form-labelt">@lang('attributes.mobile')</label>
                                            <input id="mobile" type="text" class="form-control " name="mobile"
                                                value="{{ old('mobile', $result['mobile']) }}" required
                                                autocomplete="mobile" autofocus>

                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                            @else
                                                <div class="invalid-feedback">@lang('validation.required', ['attribute' => __('attributes.mobile')])
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('code')) is-invalid @endif">
                                            <label for="code" class="col-form-labelt">@lang('attributes.code')</label>
                                            <input id="code" type="text" class="form-control " name="code"
                                                value="{{ old('code') }}" required autocomplete="code" autofocus>

                                            @if ($errors->has('code'))
                                                <span class="invalid-feedback">{{ $errors->first('code') }}</span>
                                            @else
                                                <div class="invalid-feedback">@lang('validation.required', ['attribute' => __('attributes.code')])
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group @if ($errors->has('password')) is-invalid @endif">
                                            <label for="password" class="col-form-label">@lang('attributes.password')</label>
                                            <input id="password" type="password"
                                                class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                            @else
                                                <div class="invalid-feedback">@lang('validation.required', ['attribute' => __('attributes.password')])
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-form-label">@lang('attributes.PasswordConfirmation')</label>
                                            <input id="password-confirm" type="password"
                                                class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                                name="password_confirmation" required>
                                            @if ($errors->has('password_confirmation'))
                                                <span
                                                    class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @else
                                                <div class="invalid-feedback">@lang('validation.required', ['attribute' => __('attributes.password_confirmation')])
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if ($errors->any())
                                                <h5 class="text-danger float-left">{{ $errors->first() }}</h5>
                                                <br>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit">@lang('website.send')</button>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                <a href="{{ route('website.login',['locale' => $locale]) }}" class="lost-your-password text-center">
                                                    @lang('titles.have_account')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
@endsection
