@extends('website.layouts.app')
@yield('title', __('titles.terms_condition'))

@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.terms_condition')])

    <div class="terms-conditions-area ptb-100">
        <div class="container">
            <div class="terms-conditions-content">
                <p>{!! $setting->terms_condition !!}</p>
            </div>
        </div>
    </div>
@endsection
