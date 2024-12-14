@if(! empty($result['features']) && count($result['features']) > 0)
    <div class="facility-h pt-5">
        <div class="container">
            <div class="facility-inner-h">
                <div class="row">
                    @foreach ($result['features'] as $item)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
                            <div class="single-facility-box">
                                <img src="{{ imagePath($item->image) }}" alt="icon">
                                <h3>{{ $item->title }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
