@if(! empty($result['two_banners']) && count($result['two_banners']) > 0 )

<div class="offer-area pb-50">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($result['two_banners'] as $item )
                <div class="col-lg-6 col-md-6">
                    <div class="single-offer-box">
                        <a href="{{ route('website.store.index',['locale'=> $locale]) }}" class="d-block">
                            <img src="{{ imagePath($item->image) }}" alt="offer-image">
                            <div class="box-text">
                                <h3>
                                    Books make  great gifts
                                </h3>
                                <p>
                                    Why not send the gift of a
                                    book to family & friends.
                                </p>
                            </div>
                            <div class="icon-sale">
                                <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/11/sale.png" alt="#" />
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
