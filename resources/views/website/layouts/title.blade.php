<div class="page-title-area">
    <div class="container">
        <div class="page-title-content">
            <h1>{{ $title ?? '' }}</h1>
            <ul>
                <li><a href="{{ route('website.home',['locale'=> $locale]) }}">@lang('titles.home')</a></li>
                <li>{{ $title ?? '' }}</li>
            </ul>
        </div>
    </div>
</div>
