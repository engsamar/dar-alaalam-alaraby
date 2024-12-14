<article class="item">
    <a href="{{ $item->url }}" class="thumb">
        <img src="{{ imagePath($item->image) }}" alt="blog-image">
    </a>
    <div class="info">
        <h4 class="title"><a href="{{ $item->url }}">{{ $item->title }}</a></h4>
        <div class="star-rating">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
        </div>
        <span class="price">{{ $item->price }} @lang('titles.currency')</span>
    </div>
</article>
