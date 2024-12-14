@if(! empty($result['categories']) && count($result['categories']) > 0)

<div class="categories-area pb-75 pt-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.shop_by_categories')</h2>
        </div>
        <div class="categories-slides owl-carousel owl-theme">

            @foreach ($result['categories'] as $item)
                <div class="single-categories-box">
                    <a href="{{ route('website.store.index',['locale' => $locale,'category' => $item->slug]) }}" class="d-block">
                        <div class="img">
                            <img src="{{ imagePath($item->image) }}" alt="categories-image">
                        </div>
                        <div class="details">
                            <h3>{{ $item->title }}</h3>
                            {{-- <span class="cat-count">(10)</span> --}}
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endif
