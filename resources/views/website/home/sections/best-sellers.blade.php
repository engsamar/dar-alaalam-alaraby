<div class="products-area pb-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.BestSellers')</h2>
        </div>
        <div class="products-slides owl-carousel owl-theme">
            @if(! empty($result['bestSellers']) && count($result['bestSellers']) > 0)
                @foreach ($result['bestSellers'] as $item)
                    @includeIf('website.pages.store.item',['item' => $item])
                @endforeach
            @endif

        </div>
    </div>
</div>
