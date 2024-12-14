@if(! empty($result['partners']) && count($result['partners']) > 0)
<div class="partners-area pb-100 pt-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.OurPartners')</h2>
        </div>
        <div class="partners-inner">
            <div class="row justify-content-center align-items-center">
                @foreach ($result['partners'] as $item)
                <div class="col-lg-2 col-md-3 col-sm-4 col-4">
                    <div class="single-partners-box">
                        <a href="{{ $item->link ?? '#' }}" class="d-block">
                            <img src="{{ imagePath($item->image) }}" alt="partners-image">
                            <h3>{{ $item->title }}</h3>
                        </a>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
</div>
@endif
