<div class="single-blog-post">
    <div class="image">
        <a href="{{ $item->url }}" class="d-block">
            <img src="{{ $item->image_path }}" alt="blog-image">
        </a>
    </div>
    <div class="content">
        <span class="date">
            <span>{{ date('d M', strtotime($item->date)) }}</span> {{ date('Y', strtotime($item->date)) }}
        </span>
        <a href="{{ $item->catalogue->url ?? '#' }}" class="category">{{ $item->catalogue->title ?? '' }}</a>
        <h3><a href="{{ $item->url }}">{{ $item->title }}</a></h3>
    </div>
</div>
