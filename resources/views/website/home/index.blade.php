@extends('website.layouts.app')
@section('title',__('titles.home'))
@section('content')
<!-- Start Main Banner Area -->
@includeIf('website.home.sections.slider')

<!-- End Main Banner Area -->

<!-- Start Categories Area -->
@includeIf('website.home.sections.categories')
<!-- End Categories Area -->

<!-- Start Offer Area -->
@includeIf('website.home.sections.offer-two')

<!-- End Offer Area -->

<!-- Start Products Area -->
@includeIf('website.home.sections.best-sellers')

<!-- End Products Area -->

<!-- Start Products Area -->
@includeIf('website.home.sections.new-arrivals')

<!-- End Products Area -->

{{-- @includeIf('website.home.sections.banner') --}}
@includeIf('website.home.sections.best-sellers-2')

<!-- End Offer Area -->

<!-- Start Blog Area -->
@includeIf('website.home.sections.blog')

<!-- End Blog Area -->

<!-- Start Facility Area -->
@includeIf('website.home.sections.features')

<!-- End Facility Area -->


<!-- Start Offer Area -->
{{-- @includeIf('website.home.sections.offer') --}}
<!-- End Offer Area -->

<!-- Start Offer Area -->
{{-- @includeIf('website.home.sections.offer-two') --}}

<!-- End Offer Area -->

<!-- Start Offer Area -->

<!-- Start Products Area -->
@includeIf('website.home.sections.special-offers')

<!-- End Products Area -->

@includeIf('website.home.sections.best-sellers-3')

{{-- Start Testimonial --}}

@includeIf('website.home.sections.testimonials')

{{-- End Testimonial --}}

<!-- Start Brands Area -->
{{-- @includeIf('website.home.sections.brands') --}}

<!-- End Brands Area -->

@endsection
