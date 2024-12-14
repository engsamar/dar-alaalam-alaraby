<div class="products-area best-seller-h pb-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.SpecialOffers')</h2>
        </div>
        <div class="row ">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">
                @if(! empty($result['products']) && ! empty($result['products'][0]))
                @php
                    $item = $result['products'][0];
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
                                <span class="price">{{ $item->price_after }} @lang('titles.currency')</span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <!-- <p>{{ $item->description }}</p> -->
                                <h3>Place an order now</h3>
                                <span class="discount">Enjoy 30% OFF</span>
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

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">
                @if(! empty($result['products']) && ! empty($result['products'][0]))
                @php
                    $item = $result['products'][0];
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
                                <span class="price">{{ $item->price_after }} @lang('titles.currency')</span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>

                                <h3>@lang('titles.PlaceOrder')</h3>
                                <span class="discount">Enjoy 30% OFF</span>
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
        </div>
    </div>
</div>
