<section class="offers-h offers-new-h pt-75 pb-75">
    <div class="container">
        <div class="row">
            @if (!empty($result['three_banners']) && count($result['three_banners']) > 0)

                @foreach ($result['three_banners'] as $item)
                    <div class="item">
                        <div class="single-offer-box">
                            <a href="{{ route('website.store.index', ['locale' => $locale]) }}" class="d-block">
                                <img src="{{ imagePath($item->image) }}" alt="offer-image">
                            </a>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
        <div class="row">
            @if (!empty($result['two_banners']) && count($result['two_banners']) > 0)

                @foreach ($result['two_banners'] as $item)
                    <div class="item">
                        <div class="single-offer-box">
                            <a href="{{ route('website.store.index', ['locale' => $locale]) }}" class="d-block">
                                <img src="{{ imagePath($item->image) }}" alt="offer-image">
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
