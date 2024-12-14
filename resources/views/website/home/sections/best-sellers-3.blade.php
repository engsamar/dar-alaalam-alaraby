<div class="products-area pb-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.RecentlyAdded')</h2>
        </div>
        <div class="products-slides owl-carousel owl-theme">
            @if(! empty($result['boldProducts']) && count($result['boldProducts']) > 0)
                @foreach ($result['boldProducts'] as $item)
                    @includeIf('website.pages.store.item',['item' => $item])
                @endforeach
            @endif

        </div>
    </div>
</div>
