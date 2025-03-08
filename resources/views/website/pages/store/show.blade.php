@extends('website.layouts.app')

@section('title',__('titles.store'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.store')])
<!-- End Page Title Area -->
<!-- Start Products Details Area -->
<div class="products-details-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12">
                <div class="products-details-thumbs-image">
                    <ul class="products-details-thumbs-image-slides">
                        <li><img src="{{ $result['item']->image_path }}" alt="image"></li>
                        @if (! empty( $result['item']->images))
                            @foreach ($result['item']->images as $image )
                                <li><img src="{{ $image }}" alt="image"></li>
                            @endforeach
                        @endif
                    </ul>
                    <div class="slick-thumbs">
                        <ul>
                            <li><img src="{{ $result['item']->image_path }}" alt="image"></li>
                            @if (! empty( $result['item']->images))
                            @foreach ($result['item']->images as $image )
                                <li><img src="{{ $image }}" alt="image"></li>
                            @endforeach
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12">
                <div class="products-details-desc">
                    <h3>{{ $result['item']->title }}</h3>
                    <div class="price">
                        <span class="new-price">{{  $result['item']->price_after }}</span>
                        @if($result['item']->discount  > 0)
                            <span class="old-price">{{  $result['item']->price }}</span>
                        @endif
                    </div>
                    <div class="rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                    </div>
                    <p>
                        {!! $result['item']->description  !!}
                    </p>
                    <div class="products-add-to-cart">
                        <div class="input-counter">
                            <span class="minus-btn"><i class='bx bx-minus'></i></span>
                            <input type="text" value="1"  id="quantityVal"  min="1">
                            <span class="plus-btn"><i class='bx bx-plus'></i></span>
                        </div>
                        <button type="button"  class="default-btn addToCart" data-slug="{{ $result['item']->slug }}"><span>@lang('titles.AddToCart') </span></button>
                        <button type="button" class="add-to-wishlist" data-slug="{{ $result['item']->slug }}"><i class='bx bx-heart'></i> @lang('titles.AddToWishlist')</button>
                    </div>
                    <ul class="products-info">
                        <li><span>SKU:</span> {{ $result['item']->sku  }}</li>
                        @if(! empty($result['item']->category))
                            <li><span>@lang('attributes.category'):</span> <a href="{{ $result['item'] ? $result['item']->category->url : ''}}">{{ $result['item']->category->title ?? ''  }}</a></li>
                        @endif

                        @if(! empty($result['item']->author))
                            <li><span>@lang('attributes.author')</span> <a href="{{ $result['item'] ? $result['item']->author->url : '#' }}">{{ $result['item']->author->title ?? ''  }}</a></li>
                        @endif
                        {{-- <li><span>@lang('titles.Availability'):</span> @if( $result['item']->stock > 0) @lang('titles.InStock') ({{ $result['item']->stock }}) @else @lang('titles.SoldOut')  @endif</li> --}}
                        <li><span>@lang('titles.Tags'):</span> @if(! empty($result['tags']))
                            <a href="#" rel="tag">#ثقافة</a>
                            <a href="#" rel="tag">#نشر</a>
                            <a href="#" rel="tag">#كتب</a>


                            @foreach ($result['tags'] as $tag )
                                <a href="{{ $tag->url }}" rel="tag">{{ $tag->title }}</a>
                            @endforeach
                        @endif</li>
                    </ul>
                    <div class="products-share">
                        <ul class="social">
                            <li><span>@lang('titles.share'):</span></li>

{{--
                                <li><a class="whatsapp" target="_blank" href="{{ $result['share']['whatsapp'] ?? '#' }}">
                                    <i class="bx bxl-whatsapp"></i>
                                </a>
                                </li>
                                <li><a  class="twitter" target="_blank" href="{{ $result['share']['twitter'] ?? '#' }}">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                                </li> --}}

                                <li><a class="instagram" target="_blank" href="{{ $result['share']['facebook'] ?? '#' }}">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                                </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Products Details Area -->

<div class="products-area pb-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.RelatedProducts')</h2>
        </div>
        <div class="products-slides owl-carousel owl-theme">
            @if(! empty($result['items']) && count($result['items']) > 0)
                @foreach ($result['items'] as $item)
                    @includeIf('website.pages.store.item',['item' => $item])
                @endforeach
            @endif

        </div>
    </div>
</div>
@endsection
