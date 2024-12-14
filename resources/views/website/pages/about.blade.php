@extends('website.layouts.app')

@section('title',__('titles.about'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.about')])
<!-- End Page Title Area -->
<!-- Start About Area -->
<div class="about-area pt-100 pb-75">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="about-text">
                    <h2>{{  $result['page'] && $result['page']['about'] ?  $result['page']['about']->title : '' }}</h2>
                    <p>{!! $result['page'] && $result['page']['about'] ?  $result['page']['about']->description : '' !!}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="about-image">
                    <img src="{{  $result['page'] && $result['page']['about'] ?  $result['page']['about']->image_path : '' }}" alt="about-image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Area -->

<!-- Start About Area -->
<div class="about-area about-vision-h pt-100 pb-100">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-7 col-sm-12">
                <div class="title">
                    <h3>{{  $result['page'] && $result['page']['vision'] ?  $result['page']['vision']->title : '' }}</h3>
                </div>
                <div class="text-about">
                    <p>
                        {!! $result['page'] && $result['page']['vision'] ?  $result['page']['vision']->description : '' !!}
                    </p>
                    </div>
                <div class="title">
                    <h3>{{  $result['page'] && $result['page']['mission'] ?  $result['page']['mission']->title : '' }}</h3>
                </div>
                <div class="text-about">
                    <p>
                        {!! $result['page'] && $result['page']['mission'] ?  $result['page']['mission']->description : '' !!}
                    </p>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="about-image">
                    <div class="img">
                        <img src="{{  $result['page'] && $result['page']['vision'] ?  $result['page']['vision']->image_path : '' }}" alt="about-image">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About Area -->

<!-- Start Facility Area -->
@includeIf('website.home.sections.features')


<!-- Start Partners Area -->
{{-- @includeIf('website.home.sections.clients') --}}

<!-- End Partners Area -->
@endsection
