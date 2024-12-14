@extends('website.layouts.app')
@yield('title', __('titles.privacy_condition'))

@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.privacy_condition')])

    <div class="terms-conditions-area ptb-100">
        <div class="container">
            <div class="terms-conditions-content">
                <p>{!! $setting->privacy_description !!}</p>
            </div>
        </div>
    </div>
@endsection
