@if(! empty($result['two_banners']) && count($result['two_banners']) > 0 )

<div class="offer-area pb-50">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($result['two_banners'] as $item )
                <div class="col-lg-6 col-md-6">
                    <div class="single-offer-box">
                        <a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="d-block">
                            <img src="{{ imagePath($item->image) }}" alt="offer-image">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
