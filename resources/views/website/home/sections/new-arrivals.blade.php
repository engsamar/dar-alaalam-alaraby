@if (!empty($result['newArrivals']) && count($result['newArrivals']) > 0)

    <div class="products-area products-h pb-25">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>@lang('titles.newArrivals')</h2>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="products-slides owl-carousel owl-theme">
                        @foreach ($result['newArrivals'] as $item)
                            <div class="item">
                                @includeIf('website.pages.store.item', ['item' => $item])
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="banner-book">
                        @if(! empty($result['random']))
                            <a href="{{ $result['random'][0]->url }}">
                                <img src="{{ $result['random'][0]->image_path }}"
                                    alt="#" />
                            </a>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
