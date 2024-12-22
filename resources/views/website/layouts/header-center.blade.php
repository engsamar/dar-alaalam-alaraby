@php
    $redirectLocale = app()->getLocale() == 'ar' ? 'en' : 'ar';
    \Request::route()->setParameter('locale', $redirectLocale);
    $parameters = \Request::route()->parameters();
@endphp
<div class="center-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <a class="logo-h" href="{{ route('website.home', ['locale' => $locale]) }}">
                    {{-- <img src="{{ isset($setting->logo) ? $setting->logoPath($locale)  : '' }}" alt="logo"> --}}
                    <img src="{{ asset('/assets/img/logo.jpeg') }}" alt="logo">
                </a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="search-h">
                    <form action="{{ route('website.store.index', ['locale' => $locale]) }}" method="get"
                        id="searchForm">
                        <input type="search" name="search" placeholder="@lang('titles.searchText')" />
                        <select onchange="this.form.submit()" name="category" id="">
                            <option value="" selected disabled> @lang('titles.categories') </option>
                            @foreach ($topCategories as $cat)
                                <option value="{{ $cat->slug }}">{{ $cat->title }}</option>
                            @endforeach

                        </select>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">

                <div class="others-option">
                    <div class="d-flex align-items-center">
                        <ul>
                            @if (!empty($locales))
                                <li>
                                    <a
                                        href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $parameters) }}">
                                        <i class="fal fa-earth-asia"></i>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a
                                    href="{{ auth()->guest() ? route('website.login', ['locale' => $locale]) : route('website.auth.profile.home', ['locale' => $locale]) }}">
                                    <i class="fal fa-user-vneck"></i>
                                </a>
                            </li>
                            <li>

                                <div class="cart-h">
                                    <a href="{{ route('website.carts.index', ['locale' => $locale]) }}">
                                        <div class="icon">
                                            <i class='fal fa-cart-shopping'></i>
                                            <u class="count-cart">{{ $sideCart['itemCount'] ?? 0 }}</u>
                                        </div>

                                        {{--<span>
                                            @lang('titles.Shopping') <br /> @lang('titles.Cart')
                                        </span>--}}
                                    </a>
                                </div>
                            </li>
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
