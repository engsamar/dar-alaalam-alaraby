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
                    <a href="#">
                        <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/02/24.jpg" alt="#" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
