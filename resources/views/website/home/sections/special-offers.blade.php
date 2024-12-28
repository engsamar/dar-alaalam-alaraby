<div class="products-area best-seller-h pb-50 pt-50">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.SpecialOffers')</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                @if(! empty($result['specialOffers']) && ! empty($result['specialOffers'][0]))
                @php
                    $item = $result['specialOffers'][0];
                @endphp
                <div class="offer-box">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="image">
                                <img src="{{ $item->image_path }}" alt="offer-image">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="content">
                                <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
                                <div class="price-offer">
                                    @if ($item->discount > 0)
                                        <del style="color: red;">
                                            <span class="amount">{{ $item->price }} @lang('titles.currency')</span>
                                        </del>
                                    @endif
                                    <ins>
                                        <span class="amount">{{ $item->price_after }} @lang('titles.currency')</span>
                                    </ins>
                                </div>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <h3>@lang('titles.PlaceOrder')</h3>

                                @if ($item->discount > 0)
                                    <span class="discount">@lang('titles.EnjoyOFF',['discount' => $item->discount]) </span>
                                @endif
                                <div class="counter-class" data-date="{{ date('Y-m-d h:i:s', strtotime($item->offer_expired_at)) }}">
                                    <div><span class="counter-days"></span> Days</div>
                                    <div><span class="counter-hours"></span> Hours</div>
                                    <div><span class="counter-minutes"></span> Minutes</div>
                                    <div><span class="counter-seconds"></span> Seconds</div>
                                </div>
                                <a href="{{ $item->url }}" class="default-btn"><span>@lang('titles.ShopNow')</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>


            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="offers-products-slides owl-carousel owl-theme">
                    @if(! empty($result['specialOffers']) && count($result['specialOffers']) > 0)
                        @for ($i=1; $i < count($result['specialOffers']) ;$i++)
                            <div class="item">
                                @includeIf('website.pages.store.item',['item' => $result['specialOffers'][$i]])
                            </div>
                        @endfor
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
