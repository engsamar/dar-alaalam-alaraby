@extends('website.layouts.app')
@yield('title', __('titles.return_condition'))

@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.return_condition')])
    <div class="terms-conditions-area ptb-100">
        <div class="container">
            <div class="terms-conditions-content">
                <p>{!! $setting->return_description !!}</p>
            </div>
        </div>
    </div>

@endsection
