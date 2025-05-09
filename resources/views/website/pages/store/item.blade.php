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
            <li>
                <button type="button" class="addToCart " data-slug="{{ $item->slug }}">
                    <i class='fa fa-cart-shopping'></i>
                    {{-- <span class="">@lang('titles.addToCart')</span> --}}
                </button>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="pro-name">
            <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
        </div>
        <div class="rating">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
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
        <div class="foot-block">
            @if ( $item->author)

            <div class="auth-h">
                <i class="fa fa-user"></i>
                <span>{{ $item->author->title ?? ''  }}</span>
            </div>
            @endif

            @if ( $item->category)

            <div class="auth-h">
                <i class="fa fa-tag"></i>
                <span>{{ $item->category->title ?? ''  }}</span>
                @if($item->sub_category) / <span>{{ $item->sub_category->title ?? ''  }}</span>@endif
            </div>
            @endif

            <div class="tags-h">
                @if (! empty($item->tags))
                    @foreach ($item->tags as $tag )
                    <a href="#">
                        {{ $tag->title ?? '' }}
                    </a>
                    @endforeach

                @endif
                {{-- <a href="#">
                    tag 1
                </a>
                <a href="#">
                    tag 2
                </a>
                <a href="#">
                    tag 3
                </a>
                <a href="#">
                    tag 4
                </a> --}}
            </div>
        </div>
    </div>
</div>
