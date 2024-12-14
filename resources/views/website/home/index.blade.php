@extends('website.layouts.app')
@section('title',__('titles.home'))
@section('content')
<!-- Start Main Banner Area -->
@includeIf('website.home.sections.slider')

<!-- End Main Banner Area -->

<!-- Start Facility Area -->
@includeIf('website.home.sections.features')

<!-- End Facility Area -->

<!-- Start Products Area -->
@includeIf('website.home.sections.new-arrivals')

<!-- End Products Area -->

<!-- Start Categories Area -->
@includeIf('website.home.sections.categories')
<!-- End Categories Area -->


<!-- Start Offer Area -->
@includeIf('website.home.sections.offer')
<!-- End Offer Area -->

<!-- Start Offer Area -->
{{-- @includeIf('website.home.sections.offer-two') --}}

<!-- End Offer Area -->

<!-- Start Brands Area -->
@includeIf('website.home.sections.brands')

<!-- End Brands Area -->

<!-- Start Products Area -->
@includeIf('website.home.sections.best-sellers')

<!-- End Products Area -->

<!-- Start Offer Area -->
@includeIf('website.home.sections.offer-two')

<!-- End Offer Area -->

<!-- Start Offer Area -->
{{-- @includeIf('website.home.sections.banner') --}}
@includeIf('website.home.sections.best-sellers-2')

<!-- End Offer Area -->

<!-- Start Products Area -->
@includeIf('website.home.sections.special-offers')

<!-- End Products Area -->

@includeIf('website.home.sections.best-sellers-3')

{{-- Testimonial --}}

@includeIf('website.home.sections.testimonials')

<!-- Start Blog Area -->
{{-- @includeIf('website.home.sections.blog') --}}

<!-- End Blog Area -->
@endsection
