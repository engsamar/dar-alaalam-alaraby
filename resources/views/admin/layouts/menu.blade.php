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

                <li>
                    <a href="{{ route('admin.stores.index') }}" class="waves-effect">
                        <i class="bx bx-buildings"></i>
                        <span key="t-stores">@lang('titles.stores')</span>
                    </a>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts">@lang('titles.products')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.products.index') }}" key="t-default">@lang('titles.products')</a></li>
                        <li><a href="{{ route('admin.brands.index') }}" key="t-saas">@lang('titles.brands')</a></li>
                        <li><a href="{{ route('admin.categories.index') }}" key="t-saas">@lang('titles.categories')</a></li>
                        <li><a href="{{ route('admin.sub_categories.index') }}" key="t-crypto">@lang('titles.sub_categories')</a></li>
                        <li><a href="{{ route('admin.colors.index') }}" key="t-crypto">@lang('titles.colors')</a></li>
                        <li><a href="{{ route('admin.sizes.index') }}" key="t-crypto">@lang('titles.sizes')</a></li>

                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-website">@lang('titles.website_setting')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.features.index') }}" key="t-default">@lang('titles.features')</a></li>
                        <li><a href="{{ route('admin.catalogues.index') }}" key="t-catalogues">@lang('titles.catalogues')</a></li>
                        <li><a href="{{ route('admin.articles.index') }}" key="t-saas">@lang('titles.articles')</a></li>
                        <li><a href="{{ route('admin.clients.index') }}" key="t-crypto">@lang('titles.clients')</a></li>
                        <li><a href="{{ route('admin.questions.index') }}" key="t-faqs">@lang('titles.questions')</a></li>
                        <li><a href="{{ route('admin.pages.index') }}" key="t-pages">@lang('titles.pages')</a></li>

                    </ul>

                </li>

                <li class="menu-title" key="t-apps">Apps</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="bx bx-calendar"></i><span class="badge rounded-pill bg-success float-end">New</span>
                        <span key="t-dashboards">Orders</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'new']) }}" key="t-tui-calendar">New
                                Orders</a>
                            </li>
                        <li>
                            <a href="{{ route('admin.orders.index', ['status' => 'past']) }}" key="t-full-calendar">Past
                                Orders</a>
                        </li>
                    </ul>
                </li>



                <li class="menu-title" key="t-settings">App Settings</li>

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
                        <li><a href="{{ route('admin.users.index') }}" key="t-users">@lang('titles.users')</a></li>

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
                        <li><a href="{{ route('admin.banners.index') }}" key="t-banners">@lang('titles.banners')</a></li>
                        <li><a href="{{ route('admin.coupons.index') }}" key="t-coupons">@lang('titles.coupons')</a></li>
                        <li><a href="{{ route('admin.notifications.index') }}" key="t-notifications">@lang('titles.notifications')</a></li>
                    </ul>

                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-cities">@lang('titles.cities')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
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
