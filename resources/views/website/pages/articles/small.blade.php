<div class="blog-small position-relative">
    <a href="{{ $item->url }}" class="link-block"></a>
    <div class="img">
        <img src="{{ $item->image_path }}"
            alt="#" />
    </div>
    <div class="details">
        <span>
          {{ date('d M, Y', strtotime($item->date)) }}
        </span>
        <h3>
            {{ $item->title }}
        </h3>
    </div>
</div>
