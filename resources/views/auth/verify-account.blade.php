@extends('website.layouts.app')
@section('title',__('titles.profile'))

@section('content')
    @includeIf('website.layouts.pages.breadcum', ['title' => __('website.forgot')])

    <section class="login-page body-inner cart-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-image">
                        <img src="{{  $setting && $setting->login_image ?  imagePath($setting->login_image) :  asset('/assets/img/login.jpeg') }}" alt="about-image">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-inner">
                        <form action="{{ route('website.verify-account.post',['locale' => $locale]) }}" method="post" novalidate
                            class="needs-validation">
                            @csrf
                            <div class="login-head">
                                <img width="50%" class="d-block mt-3 m-auto" alt="logo"
                                    src="{{ asset('/assets/img/logo/logo.png') }}">
                                <h3>@lang('titles.verifyAccount')</h3>
                            </div>
                            <div class="login-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group @if ($errors->has('mobile')) is-invalid @endif">
                                            <label for="mobile" class="col-form-labelt">@lang('attributes.mobile')</label>
                                            <input id="mobile" type="text" class="form-control " name="mobile"
                                                value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                            @else
                                                <div class="invalid-feedback">@lang('validation.required', ['attribute' => __('attributes.mobile')])
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
                                            <button type="submit"
                                                class="btn btn-primary w-100 text-white">@lang('titles.send')</button>
                                            <a href="{{ route('website.login',['locale' => $locale]) }}"
                                                class="btn btn-border">
                                                <span>@lang('titles.login')</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{ asset('/assets/js/validate.js') }}"></script>
@endsection
