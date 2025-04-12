@extends('website.layouts.app')
@section('css')
    @if ( $locale == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/ar/dashboard.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    @endif
@endsection
@section('content')
    <div class="dashboard_content_wrapper">
        <div class="dashboard dashboard_wrapper pr30 pr0-md">
            <div class="dashboard__sidebar d-none d-lg-block">
                <div class="dashboard_sidebar_list">
                    <div class="sidebar_list_item">
                        <a href="{{ route('website.auth.profile.home',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.profile.home') ? '-is-active' : '' }}">
                            <i class="bx bx-discovery mr15"></i>@lang('titles.profile')
                        </a>
                    </div>


                    <p class="fz15 fw400 ff-heading mt30">@lang('titles.ManageListing')</p>


                    <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.addresses.index',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('addresses.index') ? '-is-active' : '' }}">
                            <i class="bx bx-map mr15">
                            </i>@lang('titles.myAddresses')
                        </a>
                    </div>


                    <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.orders.index',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.orders.index') && app('request')->type != 'closed' ? '-is-active' : '' }}">
                            <i class="bx bx-basket mr15">
                            </i>@lang('titles.myOrders')
                        </a>
                    </div>
                    <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.orders.index', ['type' => 'closed','locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.orders.index') && app('request')->type == 'closed' ? '-is-active' : '' }}">
                            <i class="bx bx-list-ul mr15"></i>@lang('titles.myOldOrders')</a>
                    </div>
                    {{-- <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.reviews.index',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.reviews.index') ? '-is-active' : '' }}">
                            <i class="bx bx-like mr15"></i>@lang('titles.myReviews')</a>
                    </div> --}}
                    <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.favourites.index',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.favourites.index') ? '-is-active' : '' }}">
                            <i class="bx bx-heart mr15"></i>@lang('titles.myfavourites')</a>
                    </div>

                    <p class="fz15 fw400 ff-heading mt30">@lang('titles.ManageAccount')</p>

                    <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.profile.index',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.profile.index') ? '-is-active' : '' }}">
                            <i class="bx bx-user mr15"></i>@lang('titles.editProfile')
                        </a>
                    </div>
                    <div class="sidebar_list_item ">
                        <a href="{{ route('website.auth.profile.password.edit',['locale' => $locale]) }}"
                            class="items-center {{ Request::routeIs('website.auth.profile.password.edit') ? '-is-active' : '' }}">
                            <i class="bx bx-lock-open mr15"></i>@lang('titles.editPassword')</a>
                    </div>
                    <div class="sidebar_list_item ">
                        <a href="{!! route('website.auth.logout',['locale' => $locale]) !!}" class="items-center"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-lock-alt mr15"></i> @lang('titles.logout')
                        </a>
                        <form id="logout-form" action="{{ route('website.auth.logout',['locale' => $locale]) }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </div>
            </div>
            <div class="dashboard__main pl0-md">
                <div class="dashboard__content property-page bgc-f7">
                    <div class="row pb40 d-block d-lg-none">
                        <div class="col-lg-12">
                            <div class="dashboard_navigationbar">
                                <div class="dropdown">
                                    <button onclick="myFunction()" class="dropbtn">
                                        <i class="fa fa-bars pr10"></i>
                                        @lang('titles.menu')</button>
                                    <ul id="myDropdown" class="dropdown-content">
                                        <li>
                                            <a class=" {{ Request::routeIs('website.auth.profile.home') ? '-is-active' : '' }}"
                                                href="{{ route('website.auth.profile.home',['locale' => $locale]) }}">
                                                <i class="bx bx-discovery mr10"></i>@lang('titles.profile')</a>
                                        </li>

                                        <p class="fz15 fw400 ff-heading mt30">@lang('titles.ManageListing')</p>

                                        <li>
                                            <a class=" {{ Request::routeIs('website.auth.orders.index') ? '-is-active' : '' }}"
                                                href="{{ route('website.auth.orders.index',['locale' => $locale]) }}">
                                                <i class="bx bx-basket mr10">
                                                </i>@lang('titles.myOrders')
                                            </a>
                                        </li>
                                        <li>
                                            <a class=" {{ Request::routeIs('website.auth.orders.index') ? '-is-active' : '' }}"
                                                href="{{ route('website.auth.orders.index',['locale' => $locale]) }}">
                                                <i class="bx bx-list-ul mr10"></i>@lang('titles.myOldOrders')</a>
                                        </li>
                                        <li>
                                            <a class=" {{ Request::routeIs('website.auth.orders.index') ? '-is-active' : '' }}"
                                                href="{{ route('website.auth.orders.index',['locale' => $locale]) }}">
                                                <i class="bx bx-like mr10"></i>@lang('titles.myReviews')</a>
                                        </li>
                                        <div class="sidebar_list_item ">
                                            <a href="{{ route('website.auth.favourites.index',['locale' => $locale]) }}"
                                                class="items-center {{ Request::routeIs('website.auth.favourites.index') ? '-is-active' : '' }}">
                                                <i class="bx bx-heart mr15"></i>@lang('titles.myfavourites')</a>
                                        </div>
                                        <li>
                                            <p class="fz15 fw400 ff-heading mt30 pl30">@lang('titles.ManageAccount')</p>
                                        </li>

                                        <li class="active">
                                            <a href="{{ route('website.auth.profile.index',['locale' => $locale]) }}"
                                                class=" {{ Request::routeIs('website.editProfile') ? '-is-active' : '' }}">
                                                <i class="bx bx-user mr10"></i>@lang('titles.editProfile')
                                            </a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::routeIs('website.auth.profile.password.edit') ? '-is-active' : '' }}"
                                                href="{{ route('website.auth.profile.password.edit',['locale' => $locale]) }}">
                                                <i class="bx bx-lock-open mr10"></i>@lang('titles.editPassword')
                                            </a>
                                        </li>
                                        <li>

                                            <a href="{!! route('website.auth.logout',['locale' => $locale]) !!}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bx bx-lock-alt mr10"></i> @lang('titles.logout')
                                            </a>
                                            <form id="logout-form" action="{{ route('website.auth.logout',['locale' => $locale]) }}"
                                                method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @yield('contentDashboard')
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
