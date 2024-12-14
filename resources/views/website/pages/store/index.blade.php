@extends('website.layouts.app')

@section('title',__('titles.store'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.store')])
<!-- End Page Title Area -->

<!-- Start Products Area -->
<div class="products-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <aside class="widget-area">
                    @if(! empty($result['categories']) && count($result['categories']) > 0)
                        <div class="widget widget_categories">
                            <h3 class="widget-title"><span>@lang('titles.categories')</span></h3>
                            <ul>
                                @foreach ($result['categories'] as $item)
                                    <li><a href="{{ route('website.store.index',['locale' => $locale,'category' => $item->slug]) }}">{{ $item->title }}</a></li>
                                @endforeach
                             </ul>

                        </div>
                    @endif

                    @if(! empty($result['brands']) && count($result['brands']) > 0)
                        <div class="widget widget_categories">
                            <h3 class="widget-title"><span>@lang('titles.brands')</span></h3>
                            <ul>
                                @foreach ($result['brands'] as $item)
                                    <li><a href="{{ route('website.store.index',['locale' => $locale,'brand' => $item->slug]) }}">{{ $item->title }}</a></li>
                                @endforeach
                             </ul>

                        </div>
                    @endif

                    <div class="widget widget_price_filter">
                        <h3 class="widget-title"><span>@lang('titles.FilterByPrice')</span></h3>
                        <div class="collection_filter_by_price">
                            <input class="js-range-of-price" type="text" data-min="0"
                            data-max="1055" name="filter_by_price" data-step="10">
                        </div>
                    </div>

                    @if(! empty($result['tags']) && count($result['tags']) > 0)

                        <div class="widget widget_tag_cloud">
                            <h3 class="widget-title"><span>@lang('titles.Tags')</span></h3>
                            <div class="tagcloud">
                                @foreach ($result['tags'] as $item)
                                    <a href="{{ route('website.store.index',['locale' => $locale,'tag' => $item->slug]) }}">{{ $item->title }}</a>
                                @endforeach

                            </div>
                        </div>
                    @endif

                    <div class="widget widget_follow_us">
                        <h3 class="widget-title"><span>@lang('titles.FollowUs')</span></h3>
                        <ul>
                            <li><a href="{{ $setting->facebook ?? '#' }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                            <li><a href="{{ $setting->twitter ?? '#' }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                            <li><a href="{{ $setting->whatsapp ?? '#' }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                            <li><a href="{{ $setting->snapchat ?? '#' }}" target="_blank"><i class="fa-brands fa-snapchat"></i></a></li>
                            <li><a href="{{ $setting->instagram ?? '#' }}" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                            <li><a href="{{ $setting->tiktok ?? '#' }}" target="_blank"><i class='bx bxl-tiktok'></i></a></li>
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="patoi-grid-sorting row align-items-center">
                    <div class="col-lg-6 col-md-6 result-count">
                        <p>{!!  __('titles.WeFound',['count' => $result['couts'] ?? 0]) !!} </p>
                    </div>
                    <div class="col-lg-6 col-md-6 ordering">
                        {{-- <div class="select-box">
                            <label>Sort By:</label>
                            <select>
                                <option>Default</option>
                                <option>Popularity</option>
                                <option>Latest</option>
                                <option>Price: low to high</option>
                                <option>Price: high to low</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="row justify-content-center data">

                    @if (request('special') == true && ! empty($result['products']) && count($result['products']) > 0)
                        @includeIf('website.pages.store.special')
                    @else
                        @if(! empty($result['products']) && count($result['products']) > 0)
                            @foreach ($result['products'] as $item)
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    @includeIf('website.pages.store.item',['item' => $item])
                                </div>
                            @endforeach
                        @endif
                    @endif

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        {!! $result['products']->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Products Area -->
@endsection

@section('scripts')
    <script>
        function searchPrice() {
            let price = $('#price').val();
            price = price.replace(";", ",");

            //got to search link
            let url = "{{ route('website.store.index',['locale' => $locale]) }}";
            location.href = url + "?price=" + price;
        }
    </script>
@endsection
