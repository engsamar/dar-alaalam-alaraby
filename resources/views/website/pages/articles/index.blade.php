@extends('website.layouts.app')

@section('title',__('titles.articles'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.articles')])
<!-- End Page Title Area -->
<div class="blog-area ptb-100">
    <div class="container">
        <div class="row">
            @if(! empty($result['items']) && count($result['items']) > 0)

                @foreach ($result['items'] as $item)
                    <div class="col-lg-4 col-md-6">
                        @includeIf('website.pages.articles.item',['item' => $item])
                    </div>
                @endforeach

                <div class="col-lg-12 col-md-12 col-sm-12">
                    {!! $result['items']->withQueryString()->links() !!}
                </div>

            @endif
        </div>
    </div>
</div>
@endsection
