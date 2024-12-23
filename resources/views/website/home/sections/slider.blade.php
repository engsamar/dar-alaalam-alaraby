@if (!empty($result['sliders']) && count($result['sliders']) > 0)
    <div class="main-banner-area">
        <div class="align-items-center owl-carousel banner-slides">
            @foreach ($result['sliders'] as $item)
                <div class="-item-banner">
                    <div class="overlay-img">
                        <img src="{{ imagePath($item->image) ?? asset('assets/img/slide-2.webp') }}" alt="banner-image">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner-content">
                                    <span class="sub-title">{{ $item->sub_title }}</span>
                                    <h1>{{ $item->title }}</h1>
                                    <a href="{{ $item->link ?? route('website.store.index', ['locale' => $locale]) }}"
                                        class="link-h">
                                        <span>@lang('titles.shopNow')</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endif
