@extends('website.layouts.app')
@section('title', __('titles.categories'))
@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.categories')])

    @if (! empty($result['items']))
        <div class="brands-area ptb-100">
            <div class="container">

                <div class="row justify-content-center align-items-center">
                    @foreach ($result['items'] as $item)
                        <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                            <div class="single-brands-box">
                                <a href="{{ route('website.store.index',['locale' => $locale,'category' => $item->slug]) }}" class="d-block">
                                    <img src="{{ imagePath($item->image) }}" alt="{{ $item->title }}">
                                    <h3>{{ $item->title }}</h3>
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
