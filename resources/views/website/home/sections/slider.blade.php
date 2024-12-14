@if(! empty($result['sliders']) && count($result['sliders']) > 0 )
    <div class="main-banner-area">
        <div class="container">
            <div class="row align-items-center owl-carousel banner-slides">
                @foreach ($result['sliders'] as $item )
                    <div class="col-md-12">
                        <div class="main-banner-content">
                            <span class="sub-title">{{ $item->sub_title }}</span>
                            <h1>{{ $item->title }}</h1>
                            <a href="{{ $item->link ?? route('website.store.index',['locale'=> $locale]) }}" class="link-h">
                                <span>@lang('titles.shopNow')</span>
                            </a>
                        </div>

                        <div class="main-banner-image">
                            <img src="{{ imagePath($item->image) ?? asset('assets/img/slide-2.webp') }}" alt="banner-image">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endif

