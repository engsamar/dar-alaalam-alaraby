@if ( $locale == 'en')

<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/owl.theme.default.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/rangeSlider.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/odometer.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/boxicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/slick.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/countrySelect.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/meanmenu.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/intlTelInput.css')}}" >
<link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">

@if ( $locale == 'ar')
    <link rel="stylesheet" href="{{ asset('/assets/css/ar/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/ar/style-ar.css') }}">
@endif


@yield('css')
