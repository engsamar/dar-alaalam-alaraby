@extends('website.layouts.app')
@section('title', __('titles.authors'))
@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.authors')])

    @if (! empty($result['items']))
        <div class="brands-area ptb-100">
            <div class="container">

                <div class="row justify-content-center align-items-center">
                    @foreach ($result['items'] as $item)
                        <div class="col-lg-4 col-md-2 col-sm-12">
                            <div class="single-brands-box">
                                <a href="{{ route('website.store.index',['locale' => $locale,'author' => $item->slug]) }}" class="d-block">
                                    <img src="{{ $item->image_path}}" alt="{{ $item->title }}">
                                    <p>{{ $item->title }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        {!! $result['items']->withQueryString()->links() !!}

                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
