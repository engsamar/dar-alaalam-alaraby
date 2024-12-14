@if(! empty($result['full_banners']) && count($result['full_banners']) > 0 )

<div class="offer-area pb-75">
    <div class="container">
        <div class="single-offer-box">
            <a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="d-block">
                <img src="{{ imagePath($result['full_banners'][0]->image) }}" alt="offer-image">
            </a>
        </div>
    </div>
</div>
@endif
