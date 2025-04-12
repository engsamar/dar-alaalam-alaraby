<!doctype html>
<html lang="{{ $locale ?? 'en' }}" dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Link of CSS files -->
        <title>{{ ! empty($setting ) ? $setting->title : '' }} | @yield('title')</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.ico') }}">
        @includeIf('website.layouts.css')
    </head>
    <body>

        <!-- Start Top Header Area -->
        @includeIf('website.layouts.header')
        <!-- End Top Header Area -->

        <!-- Start Navbar Area -->
        @includeIf('website.layouts.header-center')
        <!-- End Navbar Area -->

        <!-- Start Navbar Area -->
        @includeIf('website.layouts.navbar')
        <!-- End Navbar Area -->

        <!-- Search Overlay -->
        @includeIf('website.layouts.search')
        <!-- End Search Overlay -->

        @yield('content')

        <!-- Start Footer Area -->
        @includeIf('website.layouts.footer')

        <!-- End Footer Area -->

        <div class="go-top"><i class='bx bx-upvote'></i></div>

        <!-- Link of JS files -->
        @includeIf('website.layouts.js')
    </body>
</html>
