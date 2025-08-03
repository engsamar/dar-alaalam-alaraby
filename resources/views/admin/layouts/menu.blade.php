<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">@lang('title.Menu')</li>

                <li>
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end">04</span>
                        <span key="t-dashboards">@lang('titles.dashboard')</span>
                    </a>

                </li>

                {{-- <li>
                    <a href="{{ route('admin.stores.index') }}" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-stores">@lang('titles.stores')</span>
                    </a>

                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-products">@lang('titles.products')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.products.index') }}" key="t-products">@lang('titles.products')</a></li>
                        <li><a href="{{ route('admin.authors.index') }}" key="t-products">@lang('titles.authors')</a></li>
                        <li><a href="{{ route('admin.publishers.index') }}" key="t-products">@lang('titles.publishers')</a></li>
                        {{-- <li><a href="{{ route('admin.brands.index') }}" key="t-products">@lang('titles.brands')</a></li> --}}
                        <li><a href="{{ route('admin.categories.index') }}" key="t-products">@lang('titles.categories')</a></li>
                        <li><a href="{{ route('admin.sub_categories.index') }}" key="t-products">@lang('titles.sub_categories')</a></li>
                        {{-- <li><a href="{{ route('admin.colors.index') }}" key="t-products">@lang('titles.colors')</a></li>
                        <li><a href="{{ route('admin.sizes.index') }}" key="t-products">@lang('titles.sizes')</a></li> --}}

                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-default">@lang('titles.website_setting')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.features.index') }}" key="t-default">@lang('titles.features')</a></li>
                        <li><a href="{{ route('admin.clients.index') }}" key="t-default">@lang('titles.clients')</a></li>
                        <li><a href="{{ route('admin.questions.index') }}" key="t-default">@lang('titles.questions')</a></li>
                        <li><a href="{{ route('admin.pages.index') }}" key="t-default">@lang('titles.pages')</a></li>

                    </ul>

                </li>

                <li class="menu-title" key="t-apps">Apps</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-calendar"></i><span class="badge rounded-pill bg-success float-end">New</span>
                        <span key="t-dashboards">@lang('titles.orders')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'new']) }}" key="t-dashboards">
                                @lang('titles.new_orders')</a>
                            </li>
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'past']) }}" key="t-dashboards">
                                 @lang('titles.past_orders')</a>
                        </li>
                    </ul>
                </li>



                <li class="menu-title" key="t-settings">>@lang('titles.website_setting')</li>

                <li>
                    <a href="{{ route('admin.settings.index') }}" class="waves-effect">
                        <i class="bx bx-brightness-half"></i>
                        <span key="t-settings">@lang('titles.settings')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span key="t-customers">@lang('titles.customers')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.users.index') }}" key="t-customers">@lang('titles.users')</a></li>


                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-book"></i>
                        <span key="t-articles">@lang('titles.articles')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.articles.index') }}" key="t-articles">@lang('titles.articles')</a></li>
                        <li><a href="{{ route('admin.catalogues.index') }}" key="t-articles">@lang('titles.catalogues')</a></li>

                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-star"></i>
                        <span key="t-testimonials">@lang('titles.testimonials')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.testimonials.index') }}" key="t-testimonials">@lang('titles.testimonials')</a></li>

                    </ul>

                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-crown"></i>
                        <span key="t-website">@lang('titles.promotions')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.banners.index') }}" key="t-website">@lang('titles.banners')</a></li>
                        <li><a href="{{ route('admin.sliders.index') }}" key="t-website">@lang('titles.sliders')</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}" key="t-website">@lang('titles.coupons')</a></li>
                        {{-- <li><a href="{{ route('admin.notifications.index') }}" key="t-website">@lang('titles.notifications')</a></li> --}}
                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-cities">@lang('titles.cities')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{ route('admin.countries.index') }}" key="t-scrollable">@lang('titles.countries')</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.cities.index') }}" key="t-scrollable">@lang('titles.cities')</a>
                        </li>

                        <li>
                            <a href="{{ route('admin.areas.index') }}" key="t-scrollable">@lang('titles.areas')</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</div>
