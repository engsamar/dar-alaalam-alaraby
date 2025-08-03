@php
    $redirectLocale = app()->getLocale() == 'ar' ? 'en' : 'ar';
    \Request::route()->setParameter('locale', $redirectLocale);
    $parameters = \Request::route()->parameters();
@endphp
<div class="navbar-area">
    <div class="patoi-nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-inner">
                        <div class="menu-left">
                            <div >
                                <a class="btn-cat" href="{{ route('website.categories.index', ['locale' => $locale]) }}" class="search-icon">

                                <i class="fal fa-grid"></i>
                                <span>@lang('titles.categories') </span>
                                </a>
                            </div>
                            {{-- <div class="catogories-list">
                                <ul>
                                    @foreach ($topCategories as $cat)
                                    <li>
                                        <a href="{{ route('website.store.index',['locale'=> $locale ]) }}">
                                            <i class="fal fa-grid"></i>
                                            {{ $cat->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div> --}}
                        </div>

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
                                    <li class="nav-item"><a href="{{ route('website.authors.index',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.authors.index') ? 'active' : '' }}">@lang('titles.authors')</a></li>
                                    <li class="nav-item"><a href="{{ route('website.about.show',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.about.show') ? 'active' : '' }}">@lang('titles.about')</a></li>
                                    <li class="nav-item"><a href="{{ route('website.contact.show',['locale'=> $locale]) }}" class="nav-link {{ Route::is('website.contact.show') ? 'active' : '' }}">@lang('titles.contact')</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="others-option-for-responsive">
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
    </div>-->
</div>
