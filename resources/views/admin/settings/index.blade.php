@extends('admin.layouts.app')

@section('tab_name', __('admin.EditAppSetting'))
@section('content')
    @include('admin.layouts.title',['subTitle' => __('titles.AppSetting') , 'title' => __('titles.EditAppSetting')])
    <div class="row">
        <div class="col-12">
            <form class="needs-validation" action="{{ route('admin.settings.update', $setting->id) }}" method="POST"
                enctype='multipart/form-data' novalidate>
                <input type="hidden" name="_method" value="PUT">

                @csrf
                <div class="checkout-tabs">
                    <div class="row ">
                        <div class="col-xl-2 col-sm-3">

                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                <a class="nav-link mb-2 active" id="home-tab-vertical" data-bs-toggle="pill" href="#home-2"
                                    role="tab" aria-controls="home-2" aria-selected="true">
                                    <i class="bx bx-exit text-primaryd-block check-nav-icon mt-4 mb-2"></i>
                                    <p>@lang('admin.About')</p>

                                </a>
                                <a class="nav-link mb-2" id="info-2-tab" data-bs-toggle="pill" href="#info-2" role="tab"
                                    aria-controls="info-2" aria-selected="false">
                                    <i class="bx bx-map text-warningd-block check-nav-icon mt-4 mb-2"></i>
                                    <p>@lang('admin.Address')</p>

                                </a>
                                <a class="nav-link mb-2" id="profile-2-tab" data-bs-toggle="pill" href="#profile-2"
                                    role="tab" aria-controls="profile-2" aria-selected="false">
                                    <i class="bx bx-share-alt text-successd-block check-nav-icon mt-4 mb-2"></i>
                                    <p>@lang('admin.SocialLinks')</p>
                                </a>

                                <a class="nav-link mb-2" id="terms-tab" data-bs-toggle="pill" href="#terms" role="tab"
                                    aria-controls="terms" aria-selected="false">
                                    <i class="bx bx-store text-successd-block check-nav-icon mt-4 mb-2"></i>
                                    <p>@lang('titles.TermsConditions')</p>
                                </a>
                                <a class="nav-link" id="upload-tab" data-bs-toggle="pill" href="#uploads-tab" role="tab"
                                    aria-controls="upload-tab" aria-selected="false">
                                    <i class="bx bx-upload text-info d-block check-nav-icon mt-4 mb-2"></i>
                                    <p>@lang('admin.Uploads')</p>

                                </a>
                            </div>

                        </div>
                        <div class="col-xl-10 col-sm-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content tab-content-vertical text-muted mt-4 mt-md-0">
                                        <div class="tab-pane fade show active" id="home-2" role="tabpanel"
                                            aria-labelledby="home-tab-vertical">
                                            <div class="row">

                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="title_{{ $Key }}-field">
                                                                    @lang('admin.Title')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <input required id="title_{{ $Key }}-field"
                                                                    type="text" class="form-control @if ($errors->has('title' . '[' . $Key . ']')) is-invalid @endif"
                                                                name='{{ 'title' . '[' . $Key . ']' }}'
                                                                value="{{ $setting->getTranslation('title', $Key) ?? old($Key . '.title') }}"
                                                                />
                                                                @if ($errors->has('title' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('title' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).' '.trans('attributes.title') ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="email-field">@lang('admin.E-mail')</label>
                                                        <input id="email-field" type="email" required
                                                            class="form-control @if ($errors->has('email')) is-invalid @endif" name="email"
                                                        value="{{ old('email', $setting->email) }}" />
                                                        @if ($errors->has('email'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('email') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                trans('attributes.email') ])</div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="phone-field">@lang('admin.Phone')</label>

                                                        <input id="phone-field" type="text" class="form-control @if ($errors->has('phone')) is-invalid @endif"
                                                        name="phone"
                                                        value="{{ old('phone', $setting->phone) }}" />
                                                        @if ($errors->has('phone'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                trans('attributes.phone') ])
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="whatsApp-field">@lang('admin.Whatsapp')</label>

                                                        <input id="whatsApp-field" type="text"
                                                            class="form-control @if ($errors->has('whatsApp')) is-invalid @endif"
                                                        name="whatsApp"
                                                        value="{{ old('whatsApp', $setting->whatsApp) }}" />
                                                        @if ($errors->has('whatsApp'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('whatsApp') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                trans('attributes.whatsapp') ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="vat-field">@lang('attributes.vat')</label>

                                                        <input id="vat-field" type="text"
                                                            class="form-control @if ($errors->has('vat')) is-invalid @endif"
                                                        name="vat"
                                                        value="{{ old('vat', $setting->vat) }}" />
                                                        @if ($errors->has('vat'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('vat') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                trans('attributes.vat') ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="delivery_cost-field">@lang('attributes.delivery_cost')</label>

                                                        <input id="delivery_cost-field" type="text"
                                                            class="form-control @if ($errors->has('delivery_cost')) is-invalid @endif"
                                                        name="delivery_cost"
                                                        value="{{ old('delivery_cost', $setting->delivery_cost) }}" />
                                                        @if ($errors->has('delivery_cost'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('delivery_cost') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                trans('attributes.delivery_cost') ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>


                                                <div class="col-md-12"></div>
                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="about_{{ $Key }}-field">
                                                                    @lang('admin.About')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="about_{{ $Key }}-field" rows="6"
                                                                    class=" form-control @if ($errors->has('about' . '[' . $Key . ']')) is-invalid @endif"
                                                                    name='{{ 'about' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('about', $Key) ?? old($Key . '.about') }}</textarea>
                                                                @if ($errors->has('about' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('about' . '[' . $Key . ']') }}
                                                                    </span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).' '.trans('attributes.about') ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="footer_{{ $Key }}-field">
                                                                    @lang('attributes.top')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="footer_{{ $Key }}-field" rows="6"
                                                                    class="form-control @if ($errors->has('footer' . '[' . $Key . ']')) is-invalid @endif"
                                                                    name='{{ 'footer' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('footer', $Key) ?? old($Key . '.footer') }}</textarea>
                                                                @if ($errors->has('footer' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('footer' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).' '.trans('attributes.footer')
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="copyrights_{{ $Key }}-field">
                                                                    @lang('attributes.copyrights')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="copyrights_{{ $Key }}-field" rows="6"
                                                                    class="form-control @if ($errors->has('copyrights' . '[' . $Key . ']')) is-invalid @endif"
                                                                    name='{{ 'copyrights' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('copyrights', $Key) ?? old($Key . '.copyrights') }}</textarea>
                                                                @if ($errors->has('copyrights' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('copyrights' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).' '.trans('attributes.copyrights')
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="info-2" role="tabpanel"
                                            aria-labelledby="info-tab-vertical">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="map-field">@lang('attributes.map')</label>
                                                        <input id="map-field" type="map"
                                                            class="form-control @if ($errors->has('map')) is-invalid @endif" name="map"
                                                        value="{{ old('map', $setting->map) }}" />
                                                        @if ($errors->has('map'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('map') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                trans('attributes.map') ])</div>
                                                        @endif

                                                    </div>
                                                </div>
                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="address_{{ $Key }}-field">
                                                                    @lang('admin.Address')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="address_{{ $Key }}-field" rows="6"
                                                                    class="form-control @if ($errors->has('address' . '[' . $Key . ']')) is-invalid @endif"
                                                                     name='{{ 'address' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('address', $Key) ?? old($Key . '.address') }}</textarea>
                                                                @if ($errors->has('address' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('address' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).' '.trans('attributes.address')
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif


                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="profile-2" role="tabpanel"
                                            aria-labelledby="profile-tab-vertical">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="facebook-field">
                                                            @lang('admin.Facebook')
                                                        </label>

                                                        <input id="facebook-field" type="url"
                                                            class="form-control @if ($errors->has('facebook')) is-invalid @endif"
                                                        name="facebook"
                                                        value="{{ old('facebook', $setting->facebook) }}" />
                                                        @if ($errors->has('facebook'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('facebook') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.facebook')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="instagram-field">@lang('admin.Instagram')</label>

                                                        <input id="instagram-field" type="url"
                                                            class="form-control @if ($errors->has('instagram')) is-invalid @endif"
                                                        name="instagram"
                                                        value="{{ old('instagram', $setting->instagram) }}" />
                                                        @if ($errors->has('instagram'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('instagram') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.instagram')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="twitter-field">@lang('admin.Twitter')
                                                        </label>

                                                        <input id="twitter-field" type="url" class="form-control @if ($errors->has('twitter')) is-invalid @endif"
                                                        name="twitter"
                                                        value="{{ old('twitter', $setting->twitter) }}" />
                                                        @if ($errors->has('twitter'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('twitter') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.twitter')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="snapchat-field">@lang('admin.snapchat')
                                                        </label>

                                                        <input id="snapchat-field" type="url"
                                                            class="form-control @if ($errors->has('snapchat')) is-invalid @endif"
                                                        name="snapchat"
                                                        value="{{ old('snapchat', $setting->snapchat) }}" />
                                                        @if ($errors->has('snapchat'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('snapchat') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.snapchat')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="linkedIn-field">@lang('admin.linkedIn')
                                                        </label>

                                                        <input id="linkedIn-field" type="url"
                                                            class="form-control @if ($errors->has('linkedIn')) is-invalid @endif"
                                                        name="linkedIn"
                                                        value="{{ old('linkedIn', $setting->linkedIn) }}" />
                                                        @if ($errors->has('linkedIn'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('linkedIn') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.linkedIn')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="youTube-field">@lang('admin.Youtube')
                                                        </label>

                                                        <input id="youTube-field" type="url" class="form-control @if ($errors->has('youTube')) is-invalid @endif"
                                                        name="youTube"
                                                        value="{{ old('youTube', $setting->youTube) }}" />
                                                        @if ($errors->has('youTube'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('youTube') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.youTube')
                                                                ])
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="appStore-field">@lang('admin.appStore')
                                                        </label>

                                                        <input id="appStore-field" type="url"
                                                            class="form-control @if ($errors->has('appStore')) is-invalid @endif"
                                                        name="appStore"
                                                        value="{{ old('appStore', $setting->appStore) }}" />
                                                        @if ($errors->has('appStore'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('appStore') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.appStore')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="googlePlay-field"
                                                            class="col-sm-3 col-form-label">@lang('admin.googlePlay')
                                                        </label>

                                                        <input id="googlePlay-field" type="url"
                                                            class="form-control @if ($errors->has('googlePlay')) is-invalid @endif"
                                                        name="googlePlay"
                                                        value="{{ old('googlePlay', $setting->googlePlay) }}" />
                                                        @if ($errors->has('googlePlay'))
                                                            <span
                                                                class="invalid-feedback">{{ $errors->first('googlePlay') }}</span>
                                                        @else
                                                            <div class="invalid-feedback">
                                                                @lang('validation.required',['attribute'=>
                                                                strtolower($locale).' '.trans('attributes.googlePlay')
                                                                ])
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="terms" role="tabpanel"
                                            aria-labelledby="contact-tab-vertical">
                                            <div class=" row ">
                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="terms_condition_{{ $Key }}-field">
                                                                    @lang('titles.TermsConditions')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="terms_condition_{{ $Key }}-field"
                                                                    rows="6" class="tinyMceExample form-control @if ($errors->has('terms_condition' . '[' . $Key . ']')) is-invalid @endif"
                                                                                       name='{{ 'terms_condition' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('terms_condition', $Key) ?? old($Key . '.terms_condition') }}</textarea>
                                                                @if ($errors->has('terms_condition' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('terms_condition' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).'
                                                                        '.trans('attributes.terms_condition')
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="return_description_{{ $Key }}-field">
                                                                    @lang('titles.return_condition')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="return_description_{{ $Key }}-field"
                                                                    rows="6" class="tinyMceExample form-control @if ($errors->has('return_description' . '[' . $Key . ']')) is-invalid @endif"
                                                                                       name='{{ 'return_description' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('return_description', $Key) ?? old($Key . '.return_description') }}</textarea>
                                                                @if ($errors->has('return_description' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('return_description' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).'
                                                                        '.trans('attributes.return_description')
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif


                                                @if (!empty($locales))
                                                    @foreach ($locales as $Key => $locale)

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3 ">
                                                                <label for="privacy_description_{{ $Key }}-field">
                                                                    @lang('titles.privacy')
                                                                    {{ strtoupper($Key) }} </label>
                                                                <textarea id="privacy_description_{{ $Key }}-field"
                                                                    rows="6" class="tinyMceExample form-control @if ($errors->has('privacy_description' . '[' . $Key . ']')) is-invalid @endif"
                                                                                       name='{{ 'privacy_description' . '[' . $Key . ']' }}'>{{ $setting->getTranslation('privacy_description', $Key) ?? old($Key . '.privacy_description') }}</textarea>
                                                                @if ($errors->has('privacy_description' . '[' . $Key . ']'))
                                                                    <span
                                                                        class="invalid-feedback">{{ $errors->first('privacy_description' . '[' . $Key . ']') }}</span>
                                                                @else
                                                                    <div class="invalid-feedback">
                                                                        @lang('validation.required',['attribute'=>
                                                                        strtolower($locale).'
                                                                        '.trans('attributes.privacy_description')
                                                                        ])
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="uploads-tab" role="tabpanel"
                                            aria-labelledby="upload-tab-vertical">
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group mb-3 row ">
                                                        <label for="logo-field"
                                                            class="col-sm-3 col-form-label">@lang('admin.Logo')
                                                        </label>

                                                        <div class="col-sm-9">
                                                            <div style="width: 100px;height: 100px;">
                                                                <img src="{{ old('logo', $setting->imagePath('logo')) }}"
                                                                    id="preview" width="100%">
                                                            </div>
                                                            <input type="file" name="logo" class="custom-file-input"
                                                                id="logo-field">
                                                            @if ($errors->has('logo'))
                                                                <span
                                                                    class="invalid-feedback">{{ $errors->first('logo') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3 row ">
                                                        <label for="logo_footer-field"
                                                            class="col-sm-3 col-form-label">@lang('admin.logo_footer')
                                                        </label>

                                                        <div class="col-sm-9">
                                                            <div style="width: 100px;height: 100px;">
                                                                <img src="{{ old('logo_footer', $setting->imagePath('logo_footer')) }}"
                                                                    id="preview" width="100%">
                                                            </div>
                                                            <input type="file" name="logo_footer" class="custom-file-input"
                                                                id="logo_footer-field">
                                                            @if ($errors->has('logo_footer'))
                                                                <span
                                                                    class="invalid-feedback">{{ $errors->first('logo_footer') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group mb-3 row ">
                                                        <label for="breadcrumb-field"
                                                            class="col-sm-3 col-form-label">@lang('admin.breadcrumb')
                                                        </label>

                                                        <div class="col-sm-9">
                                                            <div style="width: 100px;height: 100px;">
                                                                <img src="{{ old('breadcrumb', $setting->imagePath('breadcrumb')) }}"
                                                                    id="preview" width="100%">
                                                            </div>
                                                            <input type="file" name="breadcrumb" class="custom-file-input"
                                                                id="breadcrumb-field">
                                                            @if ($errors->has('breadcrumb'))
                                                                <span
                                                                    class="invalid-feedback">{{ $errors->first('breadcrumb') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2 mt-2">
                    <hr>
                    <button type="submit" name="action" value="save" style="width:150px"
                        class="btn text-white btn-primary  waves-effect waves-light">@lang('admin.Save')</button>

                    <a class="btn text-white btn-danger float-end  waves-effect waves-light"
                        href="{{ route('admin.settings.index') }}" style="float: right">
                        @lang('admin.Cancel') <i class="bx bx-exit"></i></a>
                </div>

            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.tiny.cloud/1/z4r871g6sjhoi8cm8vidvde8cedb47jwuhfdwxfdw1av9wpi/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="{{ asset('panel/js/pages/form-validation.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            0 < $(".tinyMceExample").length && tinymce.init({
                selector: "textarea.tinyMceExample",
                height: 300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [{
                    title: "Bold text",
                    inline: "b"
                }, {
                    title: "Red text",
                    inline: "span",
                    styles: {
                        color: "#ff0000"
                    }
                }, {
                    title: "Red header",
                    block: "h1",
                    styles: {
                        color: "#ff0000"
                    }
                }, {
                    title: "Example 1",
                    inline: "span",
                    classes: "example1"
                }, {
                    title: "Example 2",
                    inline: "span",
                    classes: "example2"
                }, {
                    title: "Table styles"
                }, {
                    title: "Table row 1",
                    selector: "tr",
                    classes: "tablerow1"
                }]
            })
        });

    </script>
@endsection
