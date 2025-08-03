<div class="products-area pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h2>@lang('titles.BestSellers')</h2>
                </div>
            </div>
            <div class="col-md-8">
                <div class="products-slides owl-carousel owl-theme">
                    @if (!empty($result['bestSellers']) && count($result['bestSellers']) > 0)
                        @foreach ($result['bestSellers'] as $item)
                            @includeIf('website.pages.store.item', ['item' => $item])
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="col-md-4">
                <div class="banner-book">
                   @if(! empty($result['random']))
                        <a href="{{ $result['random'][1]->url }}">
                            <img src="{{ $result['random'][1]->image_path }}"
                                alt="#" />
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
