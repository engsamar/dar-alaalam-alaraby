@if(! empty($result['categories']) && count($result['categories']) > 0)

<div class="categories-area pb-50 pt-50">
    <div class="container">
        <div class="categories-slides owl-carousel owl-theme">

            @foreach ($result['categories'] as $item)
                <div class="single-categories-box">
                    <a href="{{ route('website.store.index',['locale' => $locale,'category' => $item->slug]) }}" class="d-block">
                        <div class="img">
                            <img src="{{ $item->image_path }}" alt="categories-image">
                        </div>
                        <div class="details">
                            <h3>{{ $item->title }}</h3>

                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>
@endif
