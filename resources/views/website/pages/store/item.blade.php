<div class="single-products-box ">
    <div class="image">
        <a href="{{ $item->url }}" class="d-block">
            <img src="{{ imagePath($item->image) }}" alt="products-image">
        </a>
        <span class="badge bg-success position-absolute top-0 start-0" style="font-size: 18px;">New</span>
        <ul class="products-button">
            <li><button type="button" class="addToFavourite" data-slug="{{ $item->slug }}"><i
                        class='bx bx-heart'></i></button></li>
            <li><a class="btn" href="{{ $item->url }}"><i class='bx bx-link-alt'></i></a></li>
        </ul>
    </div>
    <div class="content">
        <div class="pro-name">
            <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
            <button type="button" class="addToCart " data-slug="{{ $item->slug }}">
                <i class='bx bx-cart-alt'></i>
                <span class="">@lang('titles.addToCart')</span>
            </button>
        </div>
        <div class="price">

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
        </div>
        <div class="rating">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
        </div>
    </div>
</div>
