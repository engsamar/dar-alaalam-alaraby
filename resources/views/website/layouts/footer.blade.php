<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 up">
                <div class="single-footer-widget">
                    <a href="" class="logo">
                        <img src="{{ isset($setting->logo_white) ? $setting->imagePath('logo_footer') : '' }}" alt="logo" style="max-width: 100px">
                    </a>
                    <ul class="footer-contact-info">
                        <li><span class="text-capitalize">@lang('attributes.mobile')</span> <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a></li>
                        {{-- <li><span class="text-capitalize">@lang('attributes.whats_app'):</span> <a href="tel:{{ $setting->whatsApp }}">{{  $setting->whatsApp }}</a></li> --}}
                        <li><span class="text-capitalize">@lang('attributes.email'):</span> <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
                        <li><span class="text-capitalize">@lang('attributes.address'):</span> {{ $setting->address }}</li>
                    </ul>
                    <div class="s-h">
                    <ul>
                    <li><a href="{{ $setting->facebook ?? '#' }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                    <!-- <li><a href="{{ $setting->twitter ?? '#' }}" target="_blank"><i class='bx bxl-twitter'></i></a></li> -->
                    <li><a href="{{ $setting->twitter ?? '#' }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="{{ $setting->whatsapp ?? '#' }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                    <li><a href="{{ $setting->snapchat ?? '#' }}" target="_blank"><i class="fa-brands fa-snapchat"></i></a></li>

                    <li><a href="{{ $setting->instagram ?? '#' }}" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                    <li><a href="{{ $setting->tiktok ?? '#' }}" target="_blank"><i class='bx bxl-tiktok'></i></a></li>
                    <!-- <li><a href="{{ $setting->youtube ?? '#' }}" target="_blank"><i class='bx bxl-youtube'></i></a></li> -->
                </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 down">
                <div class="single-footer-widget pl-4">
                    <h3>@lang('titles.Information')</h3>
                    <ul class="custom-links">
                        <li><a href="{{ route('website.about.show',['locale' => $locale]) }}">@lang('titles.about')</a></li>
                        <li><a href="{{ route('website.terms.show',['locale' => $locale]) }}">@lang('titles.terms_condition')</a></li>
                        <li><a href="{{ route('website.privacy.show',['locale' => $locale]) }}">@lang('titles.privacy_condition')</a></li>
                        <li><a href="{{ route('website.return.show',['locale' => $locale]) }}">@lang('titles.return_condition')</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 down">
                <div class="single-footer-widget">
                    <h3>@lang('titles.CustomerService')</h3>
                    <ul class="custom-links">
                        <li><a href="{{ route('website.auth.profile.home',['locale' => $locale]) }}">@lang('titles.MyAccount')</a></li>
                        <li><a href="{{ route('website.faqs.index',['locale' => $locale]) }}">@lang('titles.faqs')</a></li>

                        <li><a href="{{ route('website.auth.orders.index',['locale' => $locale]) }}">@lang('titles.OrderHistory')</a></li>
                        <li><a href="{{ route('website.auth.favourites.index',['locale' => $locale]) }}">@lang('titles.Wishlist')</a></li>
                        <li><a href="{{ route('website.auth.addresses.index',['locale' => $locale]) }}">@lang('titles.DeliveryInformation')</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 down">
                <div class="single-footer-widget">
                    <h3>{{ $subscribe ? $subscribe->title : __('titles.SubscribeTitle') }}</h3>
                    <p>{!! $subscribe ? $subscribe->description : __('titles.SubscribeMessage') !!}</p>

                    <form class="newsletter-form needs-validation" novalidate action="{{ route('website.subscribe.store',['locale' => $locale]) }}" method="post">
                        @csrf
                        <input type="email" name="email" class="input-newsletter" placeholder="@lang('attributes.email')" name="EMAIL" required autocomplete="off">
                        <button type="submit"><i class='bx bx-paper-plane'></i></button>
                        <div id="validator-newsletter" class="form-result"></div>
                    </form>
                    <div class="payment-types">
                        <div class="d-flex align-items-center">
                            <span>@lang('titles.WeAccept')</span>
                            <ul>
                                <li><img src="{{ asset('/assets/img/payment/visa.png') }}" alt="visa"></li>
                                <li><img src="{{ asset('/assets/img/payment/mc.png') }}" alt="master-card"></li>
                                <li><img src="{{ asset('/assets/img/payment/ae.png') }}" alt="american-express"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                {{-- Col --}}
                <div class="col-md-6">
                    <p>{{ $setting->copyrights ?? '' }}</p>
                </div>
                {{-- /Col --}}

                {{-- Col --}}
                <div class="col-md-6">
                    <a href="#" target="_blank" class="comany-name">
                        Designed and developed with
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 841.9 419.3" style="enable-background:new 0 0 841.9 419.3;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #fff;
                                }
                            </style>
                            <g>
                                <path class="st0" d="M378.3,222.1h-14.5c-4.8-3.1-16-10.4-18.5-11.6c-3.3-1.6-6.8-2.8-10.4-3.6c-2.7-0.6-5.5-0.9-8.2-0.9h-21.5
v16.1h-9v-41.2h9v16.1h21.5c2.9,0,5.9-0.3,8.7-1.1c3.4-0.9,6.7-2.1,9.9-3.6c2.8-1.3,14.2-9,17.9-11.4h14.5
c1.1,0-14.5,11.2-15.7,12.1c-1.5,1.1-3,2.1-4.5,3.1c-1.5,0.9-3,1.9-4.6,2.7s-3.3,1.8-5.1,2.7c1.8,0.9,3.5,1.8,5.1,2.6
c1.6,0.9,3.1,1.8,4.6,2.7C358.7,207.6,378.3,222.1,378.3,222.1z"></path>
                                <g>
                                    <path class="st0" d="M294.8,239.7v-9h3.6c0.7,0,1.4,0.1,2,0.3c0.6,0.2,1.1,0.5,1.5,0.9c0.4,0.4,0.8,0.9,1,1.4s0.3,1.2,0.3,1.9
    s-0.1,1.3-0.3,1.9s-0.5,1-1,1.4s-0.9,0.7-1.5,0.9c-0.6,0.2-1.3,0.3-2,0.3L294.8,239.7L294.8,239.7z M295.8,238.8h2.5
    c0.6,0,1.1-0.1,1.6-0.2c0.5-0.2,0.9-0.4,1.2-0.7s0.6-0.7,0.8-1.1c0.2-0.4,0.3-0.9,0.3-1.5c0-0.6-0.1-1.1-0.3-1.5
    c-0.2-0.4-0.4-0.8-0.8-1.1s-0.8-0.6-1.2-0.7s-1-0.2-1.6-0.2h-2.5L295.8,238.8L295.8,238.8z"></path>
                                    <path class="st0" d="M308.2,230.6h6.8v0.9h-5.9v3.1h5.2v0.9h-5.2v3.3h6v0.9h-7V230.6z"></path>
                                    <path class="st0" d="M319,230.6h1.1l3.5,7.8h0l3.5-7.8h1.1l-4,9h-1L319,230.6z"></path>
                                    <path class="st0" d="M332.4,230.6h6.8v0.9h-5.9v3.1h5.2v0.9h-5.2v3.3h6v0.9h-7V230.6z"></path>
                                    <path class="st0" d="M344.2,239.7v-9h1v8.1h5.3v0.9H344.2z"></path>
                                    <path class="st0" d="M354.5,235.1c0-0.7,0.1-1.3,0.4-1.9s0.6-1.1,1-1.5s0.9-0.7,1.5-1c0.6-0.2,1.2-0.4,1.9-0.4s1.3,0.1,1.9,0.4
    c0.6,0.2,1.1,0.6,1.5,1c0.4,0.4,0.7,0.9,1,1.5s0.4,1.2,0.4,1.9s-0.1,1.3-0.4,1.9s-0.6,1.1-1,1.5s-0.9,0.7-1.5,1
    c-0.6,0.2-1.2,0.4-1.9,0.4c-0.7,0-1.3-0.1-1.9-0.4c-0.6-0.2-1.1-0.6-1.5-1c-0.4-0.4-0.7-0.9-1-1.5S354.5,235.8,354.5,235.1z
     M355.5,235.1c0,0.6,0.1,1.1,0.3,1.5c0.2,0.5,0.4,0.9,0.8,1.2c0.3,0.3,0.7,0.6,1.1,0.8c0.5,0.2,0.9,0.3,1.5,0.3s1-0.1,1.5-0.3
    s0.8-0.4,1.1-0.8s0.6-0.7,0.8-1.2c0.2-0.5,0.3-1,0.3-1.5c0-0.6-0.1-1.1-0.3-1.5c-0.2-0.5-0.4-0.9-0.8-1.2
    c-0.3-0.3-0.7-0.6-1.1-0.8c-0.4-0.2-0.9-0.3-1.5-0.3c-0.5,0-1,0.1-1.5,0.3c-0.5,0.2-0.8,0.4-1.1,0.8s-0.6,0.7-0.8,1.2
    S355.5,234.6,355.5,235.1z"></path>
                                    <path class="st0" d="M372.2,230.6c1.2,0,2.1,0.3,2.7,0.8s1,1.3,1,2.2c0,0.5-0.1,0.9-0.3,1.3s-0.4,0.7-0.7,1
    c-0.3,0.3-0.7,0.5-1.2,0.6c-0.5,0.1-1,0.2-1.5,0.2h-2.4v3h-1v-9L372.2,230.6L372.2,230.6z M372.2,235.8c0.9,0,1.5-0.2,2-0.5
    c0.5-0.4,0.7-0.9,0.7-1.6c0-0.7-0.2-1.2-0.7-1.6s-1.1-0.5-2-0.5h-2.4v4.2H372.2z"></path>
                                    <path class="st0" d="M388.7,230.6h0.9v9h-1v-7.2l-3.4,5.5h-0.4l-3.4-5.5v7.2h-1v-9h0.9l3.7,6L388.7,230.6z"></path>
                                    <path class="st0" d="M395,230.6h6.8v0.9H396v3.1h5.2v0.9H396v3.3h6v0.9h-7V230.6z"></path>
                                    <path class="st0" d="M406.8,239.7v-9h0.9l5.9,7.3v-7.3h1v9h-0.8l-5.9-7.3v7.3H406.8z"></path>
                                    <path class="st0" d="M426.2,230.6v0.9h-3.1v8.1h-1v-8.1h-3.1v-0.9H426.2z"></path>
                                    <path class="st0" d="M440.3,239.8c-0.7,0-1.4-0.1-2-0.4s-1.1-0.6-1.6-1l0.5-0.8c0.4,0.4,0.9,0.7,1.5,0.9c0.5,0.2,1.1,0.3,1.7,0.3
    c0.7,0,1.3-0.1,1.7-0.4s0.6-0.7,0.6-1.1c0-0.2,0-0.5-0.1-0.6s-0.2-0.3-0.5-0.5s-0.5-0.2-0.8-0.3s-0.7-0.2-1.1-0.3
    c-0.5-0.1-1-0.2-1.4-0.4s-0.7-0.3-1-0.5c-0.3-0.2-0.5-0.4-0.6-0.7c-0.1-0.3-0.2-0.6-0.2-1c0-0.4,0.1-0.8,0.2-1.1s0.4-0.6,0.7-0.8
    c0.3-0.2,0.6-0.4,1-0.5c0.4-0.1,0.8-0.2,1.3-0.2c0.6,0,1.1,0.1,1.6,0.3c0.5,0.2,1,0.4,1.4,0.8l-0.5,0.7c-0.4-0.2-0.8-0.4-1.2-0.6
    s-0.9-0.2-1.4-0.2c-0.7,0-1.2,0.1-1.6,0.4s-0.6,0.7-0.6,1.2c0,0.2,0,0.4,0.1,0.6c0.1,0.2,0.2,0.3,0.4,0.5s0.4,0.2,0.8,0.4
    c0.3,0.1,0.7,0.2,1.1,0.3c0.5,0.1,1,0.2,1.4,0.4c0.4,0.1,0.7,0.3,1,0.5c0.3,0.2,0.5,0.4,0.6,0.7s0.2,0.6,0.2,1
    c0,0.4-0.1,0.7-0.2,1.1c-0.2,0.3-0.4,0.6-0.7,0.8c-0.3,0.2-0.6,0.4-1.1,0.5S440.8,239.8,440.3,239.8z"></path>
                                    <path class="st0" d="M448,235.1c0-0.7,0.1-1.3,0.4-1.9s0.6-1.1,1-1.5s0.9-0.7,1.5-1c0.6-0.2,1.2-0.4,1.9-0.4s1.3,0.1,1.9,0.4
    c0.6,0.2,1.1,0.6,1.5,1c0.4,0.4,0.7,0.9,1,1.5s0.4,1.2,0.4,1.9s-0.1,1.3-0.4,1.9s-0.6,1.1-1,1.5s-0.9,0.7-1.5,1
    c-0.6,0.2-1.2,0.4-1.9,0.4c-0.7,0-1.3-0.1-1.9-0.4c-0.6-0.2-1.1-0.6-1.5-1c-0.4-0.4-0.7-0.9-1-1.5S448,235.8,448,235.1z
     M449.1,235.1c0,0.6,0.1,1.1,0.3,1.5c0.2,0.5,0.4,0.9,0.8,1.2c0.3,0.3,0.7,0.6,1.1,0.8c0.5,0.2,0.9,0.3,1.5,0.3s1-0.1,1.5-0.3
    s0.8-0.4,1.1-0.8s0.6-0.7,0.8-1.2c0.2-0.5,0.3-1,0.3-1.5c0-0.6-0.1-1.1-0.3-1.5c-0.2-0.5-0.4-0.9-0.8-1.2
    c-0.3-0.3-0.7-0.6-1.1-0.8c-0.4-0.2-0.9-0.3-1.5-0.3c-0.5,0-1,0.1-1.5,0.3c-0.5,0.2-0.8,0.4-1.1,0.8s-0.6,0.7-0.8,1.2
    C449.2,234.1,449.1,234.6,449.1,235.1z"></path>
                                    <path class="st0" d="M462.4,239.7v-9h1v8.1h5.3v0.9H462.4z"></path>
                                    <path class="st0" d="M472.8,230.6h1v5.1c0,0.9,0.2,1.7,0.8,2.2s1.2,0.8,2,0.8c0.9,0,1.5-0.3,2-0.8s0.8-1.2,0.8-2.2v-5.1h1v5.3
    c0,0.6-0.1,1.1-0.3,1.6c-0.2,0.5-0.4,0.9-0.8,1.2s-0.7,0.6-1.2,0.8c-0.5,0.2-1,0.3-1.6,0.3s-1.1-0.1-1.6-0.3s-0.9-0.4-1.2-0.8
    c-0.3-0.3-0.6-0.7-0.8-1.2c-0.2-0.5-0.3-1-0.3-1.6L472.8,230.6L472.8,230.6z"></path>
                                    <path class="st0" d="M491.9,230.6v0.9h-3.1v8.1h-1v-8.1h-3.1v-0.9H491.9z"></path>
                                    <path class="st0" d="M496.4,239.7v-9h1v9H496.4z"></path>
                                    <path class="st0" d="M502.3,235.1c0-0.7,0.1-1.3,0.4-1.9s0.6-1.1,1-1.5s0.9-0.7,1.5-1c0.6-0.2,1.2-0.4,1.9-0.4s1.3,0.1,1.9,0.4
    c0.6,0.2,1.1,0.6,1.5,1c0.4,0.4,0.7,0.9,1,1.5s0.4,1.2,0.4,1.9s-0.1,1.3-0.4,1.9s-0.6,1.1-1,1.5s-0.9,0.7-1.5,1
    c-0.6,0.2-1.2,0.4-1.9,0.4c-0.7,0-1.3-0.1-1.9-0.4c-0.6-0.2-1.1-0.6-1.5-1c-0.4-0.4-0.7-0.9-1-1.5S502.3,235.8,502.3,235.1z
     M503.4,235.1c0,0.6,0.1,1.1,0.3,1.5c0.2,0.5,0.4,0.9,0.8,1.2c0.3,0.3,0.7,0.6,1.1,0.8c0.5,0.2,0.9,0.3,1.5,0.3s1-0.1,1.5-0.3
    s0.8-0.4,1.1-0.8s0.6-0.7,0.8-1.2c0.2-0.5,0.3-1,0.3-1.5c0-0.6-0.1-1.1-0.3-1.5c-0.2-0.5-0.4-0.9-0.8-1.2
    c-0.3-0.3-0.7-0.6-1.1-0.8c-0.4-0.2-0.9-0.3-1.5-0.3c-0.5,0-1,0.1-1.5,0.3c-0.5,0.2-0.8,0.4-1.1,0.8s-0.6,0.7-0.8,1.2
    S503.4,234.6,503.4,235.1z"></path>
                                    <path class="st0" d="M516.7,239.7v-9h0.9l5.8,7.3v-7.3h1v9h-0.8l-5.9-7.3v7.3H516.7z"></path>
                                    <path class="st0" d="M532.7,239.8c-0.7,0-1.4-0.1-2-0.4s-1.2-0.6-1.6-1l0.5-0.8c0.4,0.4,0.9,0.7,1.5,0.9c0.5,0.2,1.1,0.3,1.7,0.3
    c0.7,0,1.3-0.1,1.7-0.4s0.6-0.7,0.6-1.1c0-0.2,0-0.5-0.2-0.6c-0.1-0.2-0.2-0.3-0.5-0.5s-0.5-0.2-0.8-0.3s-0.7-0.2-1.1-0.3
    c-0.5-0.1-1-0.2-1.4-0.4s-0.7-0.3-1-0.5c-0.3-0.2-0.5-0.4-0.6-0.7c-0.1-0.3-0.2-0.6-0.2-1c0-0.4,0.1-0.8,0.2-1.1s0.4-0.6,0.7-0.8
    c0.3-0.2,0.6-0.4,1-0.5c0.4-0.1,0.8-0.2,1.3-0.2c0.6,0,1.1,0.1,1.7,0.3c0.5,0.2,1,0.4,1.4,0.8l-0.5,0.7c-0.3-0.2-0.8-0.4-1.2-0.6
    s-0.9-0.2-1.4-0.2c-0.7,0-1.2,0.1-1.6,0.4s-0.6,0.7-0.6,1.2c0,0.2,0,0.4,0.1,0.6c0.1,0.2,0.2,0.3,0.4,0.5s0.4,0.2,0.8,0.4
    c0.3,0.1,0.7,0.2,1.1,0.3c0.5,0.1,1,0.2,1.4,0.4c0.4,0.1,0.7,0.3,1,0.5c0.3,0.2,0.5,0.4,0.6,0.7s0.2,0.6,0.2,1
    c0,0.4-0.1,0.7-0.2,1.1c-0.2,0.3-0.4,0.6-0.7,0.8c-0.3,0.2-0.7,0.4-1.1,0.5S533.2,239.8,532.7,239.8z"></path>
                                </g>
                                <path class="st0" d="M441.5,196.5c-1-0.2-2.1-0.4-3.1-0.6c-3.4-0.9-6.7-2.1-9.9-3.6c-2.8-1.3-14.2-9-17.9-11.4H396
c-1.1,0,14.5,11.2,15.7,12.1c1.5,1.1,3,2.1,4.5,3.1c1.5,0.9,3,1.9,4.6,2.7s3.3,1.8,5.1,2.7c-1.8,0.9-3.5,1.8-5.1,2.6
c-1.6,0.9-3.1,1.8-4.6,2.7c-1.1,0.7-20.7,15.2-20.7,15.2H410c4.8-3.1,16-10.4,18.5-11.6c3.3-1.6,6.8-2.8,10.4-3.6
c0.9-0.2,1.8-0.4,2.6-0.5L441.5,196.5L441.5,196.5z"></path>
                                <path class="st0" d="M534.8,194.3c-0.8-2.4-1.9-4.6-3.4-6.6c-1.5-2-3.3-3.6-5.4-4.9s-4.5-1.9-7.2-1.9l-58.9,0v7.8v28.8v4.5h3.2h0.6
h56c2.5-0.1,4.8-0.8,6.8-2.1s3.7-2.9,5.1-4.9c1.4-1.9,2.5-4.1,3.2-6.5c0.8-2.4,1.1-4.8,1.1-7.1
C535.9,199.1,535.5,196.7,534.8,194.3z M526.8,205.2c-0.3,1.4-0.8,2.6-1.6,3.7c-0.8,1.1-1.8,2.1-3.2,2.9c-1.4,0.8-3.1,1.2-5.2,1.2
h-48v-23l29.8,0v0h18.2c2.1,0,3.9,0.4,5.2,1.2c1.4,0.8,2.4,1.8,3.2,2.9c0.8,1.1,1.3,2.4,1.6,3.7c0.3,1.4,0.4,2.6,0.4,3.7
C527.2,202.6,527.1,203.9,526.8,205.2z"></path>
                            </g>
                        </svg>
                    </a>
                </div>
                {{-- /Col --}}
            </div>
        </div>
    </div>
</footer>

<a href="https://wa.me/{{ $setting->whatsApp }}" target="_blank" class="whatsapp-icon">
    <i class="bx bxl-whatsapp"></i>
</a>