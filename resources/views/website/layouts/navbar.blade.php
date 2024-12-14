@php
    $redirectLocale = app()->getLocale() == 'ar' ? 'en' : 'ar';
    \Request::route()->setParameter('locale', $redirectLocale);
    $parameters = \Request::route()->parameters();
@endphp
<div class="navbar-area">
    <div class="patoi-responsive-nav">
        <div class="container">
            <div class="patoi-responsive-menu">
                <div class="logo">
                    <a href="{{ route('website.home',['locale'=> $locale]) }}"><img src="{{ isset($setting->logo) ? $setting->logoPath($locale)  : '' }}" alt="logo"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="patoi-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <div class="collapse navbar-collapse mean-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('website.home',['locale'=> $locale]) }}"
                                class="nav-link {{ Route::is('website.home') ? 'active' : '' }}">@lang('titles.home')
                            </a>
                        </li>

                        <li class="nav-item"><a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.store.index') && request()->special == false  && request()->best_seller == false ? 'active' : '' }}">@lang('titles.store')</a></li>
                        <li class="nav-item"><a href="{{ route('website.store.index',['locale'=> $locale,'special' => true]) }}" class="nav-link {{ Route::is('website.store.index') && request()->special  ? 'active' : '' }}">@lang('titles.BestSellers')</a></li>
                        <li class="nav-item"><a href="{{ route('website.store.index',['locale'=> $locale,'best_seller' => true]) }}" class="nav-link {{ Route::is('website.store.index') && request()->best_seller ? 'active' : '' }}">@lang('titles.OurBestSellers')</a></li>
                        <li class="nav-item"><a href="{{ route('website.brands.index',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.brands.index') ? 'active' : '' }}">@lang('titles.brands')</a></li>
                        <li class="nav-item"><a href="{{ route('website.about.show',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.about.show') ? 'active' : '' }}">@lang('titles.about')</a></li>
                        <li class="nav-item"><a href="{{ route('website.contact.show',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.contact.show') ? 'active' : '' }}">@lang('titles.contact')</a></li>
                    </ul>
                    <div class="others-option">
                        <div class="d-flex align-items-center">
                            <ul>
                                @if (! empty($locales))
                                    <li>
                                        <a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $parameters) }}">
                                            <i class="fa-solid fa-globe language-switch" style="cursor: pointer;margin-left: 0;font-size: 24px;"></i>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ auth()->guest() ? route('website.login',['locale'=> $locale]) : route('website.auth.profile.home',['locale'=> $locale]) }}">
                                        <i class='bx bx-user-circle'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="others-option-for-responsive">
        <div class="container">
            <div class="dot-menu">
                <div class="inner">
                    <div class="circle circle-one"></div>
                    <div class="circle circle-two"></div>
                    <div class="circle circle-three"></div>
                </div>
            </div>
            <div class="container">
                <div class="option-inner">
                    <div class="others-option">
                        <ul>
                            @if (! empty($locales))
                                <li>
                                    <a href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $parameters) }}">
                                        <i class="fa-solid fa-globe language-switch" style="cursor: pointer; color: #fff;margin-left: 0;font-size: 24px;"></i>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="search-icon">
                                    <i class='bx bx-search'></i>
                                </a>
                            </li>
                            <li><a href="{{ route('website.login',['locale'=> $locale]) }}"><i class='bx bx-user-circle'></i></a></li>
                            <li><a href="{{ route('website.carts.index',['locale'=> $locale]) }}"><i class='bx bx-cart'></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="header-mobile">
    <div class="item">
        <a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="search-icon">
            <i class='bx bx-search'></i>
            <span>@lang('titles.Search')</span>
        </a>
    </div>
    <div class="item">
        <a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.store.index') ? 'active' : '' }}">
            <i class='bx bx-store'></i>
            <span>
                @lang('titles.store')
            </span>
        </a>
    </div>
    <div class="item">
        <a href="{{ route('website.home',['locale'=> $locale]) }}"
            class="nav-link {{ Route::is('website.home') ? 'active' : '' }}">
            <i class='bx bx-home'></i>
            <span>@lang('titles.home')</span>
        </a>
    </div>
    <div class="item">
        <a href="{{ route('website.carts.index', ['locale' => $locale]) }}">
            <i class='bx bx-cart'></i>
            <span>
                @lang('titles.Cart')
            </span>
        </a>
    </div>
    <div class="item">
        <a href="{{ auth()->guest() ? route('website.login',['locale'=> $locale]) : route('website.auth.profile.home',['locale'=> $locale]) }}">
            <i class='bx bx-user'></i>
            <span>@lang('titles.profile')</span>
        </a>
    </div>
</div>
