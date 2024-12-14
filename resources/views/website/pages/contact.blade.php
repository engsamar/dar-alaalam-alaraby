@extends('website.layouts.app')

@section('title',__('titles.contact'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.contact')])
<!-- End Page Title Area -->
<!-- Start Contact Us Area -->
<div class="contact-area pt-100 pb-75">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="contact-form">
                    <h3>@lang('titles.GetInTouch')</h3>
                    <form  class=" needs-validation" method="POST"
                    novalidate action="{{ route('website.contact.store',['locale' =>$locale]) }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="text-capitalize">@lang('attributes.name')</label>
                                    <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="name"
                                    required data-error="@lang('attributes.pleaseEnter',['input' => __('titles.name')] )">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                    @else
                                        <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                            __('attributes.name') ])
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="text-capitalize"> @lang('attributes.email')</label>
                                    <input value="{{ old('email') }}" type="email" name="email" class="form-control" id="email" required
                                     data-error="@lang('attributes.pleaseEnter',['input' => __('attributes.name')] )">
                                     @if ($errors->has('email'))
                                     <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                 @else
                                     <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                         __('attributes.email') ])
                                     </div>
                                 @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="text-capitalize"> @lang('attributes.mobile')</label>
                                    <input value="{{ old('mobile') }}" type="text" name="mobile" class="form-control phone" id="mobile" required
                                     data-error="@lang('attributes.pleaseEnter',['input' => __('attributes.mobile')] )">

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                    @else
                                        <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                            __('attributes.mobile') ])
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group mb-3">
                                    <label class="text-capitalize">@lang('attributes.subject')</label>
                                    <input value="{{ old('subject') }}" type="text" name="subject" class="form-control" id="subject" required
                                     data-error="@lang('attributes.pleaseEnter',['input' => __('attributes.subject')] )">
                                     @if ($errors->has('subject'))
                                     <span class="invalid-feedback">{{ $errors->first('subject') }}</span>
                                 @else
                                     <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                         __('attributes.subject') ])
                                     </div>
                                 @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group mb-3">
                                    <label class="text-capitalize">@lang('attributes.message')...</label>
                                    <textarea name="message" id="message" class="form-control" cols="30" rows="4" required
                                     data-error="@lang('attributes.pleaseEnter',['input' => __('attributes.message')] )">{{ old('message') }}</textarea>
                                     @if ($errors->has('message'))
                                     <span class="invalid-feedback">{{ $errors->first('message') }}</span>
                                 @else
                                     <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                         __('attributes.message') ])
                                     </div>
                                 @endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-check mb-3">
                                    <input type="checkbox" class="form-check-input" id="checkme">
                                    <label class="text-capitalize" class="form-check-label" for="checkme">
                                        @lang('titles.Accept') <a href="{{ route('website.terms.show',['locale'=>$locale]) }}">
                                            @lang('titles.terms')</a> @lang('titles.and')
                                            <a href="{{ route('website.privacy.show',['locale'=>$locale]) }}">
                                                @lang('titles.privacy')
                                            </a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="submit" class="default-btn"><span>@lang('titles.SendMessage')</span></button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="contact-info">
                    <h3>@lang('titles.ContactInformation')</h3>
                    <ul>
                        <li><span class="text-capitalize">@lang('attributes.mobile')</span> <a href="tel:{{ $setting->phone }}"><u>{{ $setting->phone }}</u></a></li>
                        <li><span class="text-capitalize">@lang('attributes.whats_app'):</span> <a href="tel:{{ $setting->whatsApp }}"><u>{{  $setting->whatsApp }}</u></a></li>
                        <li><span class="text-capitalize">@lang('attributes.email'):</span> <a href="mailto:{{ $setting->email }}"><u>{{ $setting->email }}</u></a></li>
                        <li><span class="text-capitalize">@lang('attributes.address'):</span> {{ $setting->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="maps">
            {!! $setting->map !!}
        </div>
    </div>
</div>
<!-- End Contact Us Area -->
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
