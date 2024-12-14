@if(! empty($result['articles']) && count($result['articles']) > 0)

    <div class="blog-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <h2>@lang('titles.LatestBlog')</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($result['articles'] as $item)
                    <div class="col-lg-3 col-md-6">
                        @includeIf('website.pages.articles.item',['item' => $item])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

