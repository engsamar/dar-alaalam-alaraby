@if(! empty($result['newArrivals']) && count($result['newArrivals']) > 0)

    <div class="products-area products-h pb-75">
        <div class="container">
            <div class="section-title">
                <h2>@lang('titles.newArrivals')</h2>
            </div>
            <div class="row">
                @foreach ($result['newArrivals'] as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        @includeIf('website.pages.store.item',['item' => $item])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
