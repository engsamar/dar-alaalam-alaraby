@if (! empty($result['brands']) && count($result['brands']) > 0)
    <div class="brands-area pb-75">
        <div class="container">
            <div class="section-title">
                <h2>@lang('titles.topBrands')</h2>
            </div>
            <div class="row justify-content-center align-items-center">
                @foreach ($result['brands'] as $item)
                    <div class="col-sm-4 col-md-4 col-4 col-lg-2">
                        <div class="single-brands-box">
                            <a href="{{ route('website.store.index',['locale' => $locale,'brand' => $item->slug]) }}" class="d-block">
                                <img src="{{ imagePath($item->image) }}" alt="brands">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
<!-- col-lg-2 col-md-3 col-sm-4 col-4 -->