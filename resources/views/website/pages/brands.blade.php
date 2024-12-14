@extends('website.layouts.app')
@section('title', __('titles.brands'))
@section('content')
    @includeIf('website.layouts.title', ['title' => __('titles.brands')])

    @if (! empty($result['items']))
        <div class="brands-area ptb-100">
            <div class="container">

                <div class="row justify-content-center align-items-center">
                    @foreach ($result['items'] as $item)
                        <div class="col-lg-2 col-md-4 col-sm-4 col-4">
                            <div class="single-brands-box">
                                <a href="{{ route('website.store.index',['locale' => $locale,'brand' => $item->slug]) }}" class="d-block">
                                    <img src="{{ imagePath($item->image) }}" alt="{{ $item->title }}">
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
