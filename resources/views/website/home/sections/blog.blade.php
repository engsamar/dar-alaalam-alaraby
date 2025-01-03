{{-- @if (!empty($result['articles']) && count($result['articles']) > 0)

    <div class="blog-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <h2>@lang('titles.LatestBlog')</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($result['articles'] as $item)
                    <div class="col-lg-3 col-md-6">
                        @includeIf('website.pages.articles.item',['item' => $item])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif --}}
@if (!empty($result['articles']) && count($result['articles']) > 0)
    <section class="blogs-h">
        <div class="container">
            <div class="row">
                {{-- Col --}}
                <div class="col-md-12">
                    <div class="title-flex">
                        <div class="title">
                            <h3>
                                @lang('titles.LatestBlog')
                            </h3>
                        </div>
                        <a href="{{ route('website.articles.index',['locale' =>$locale]) }}" class="btn">
                            <span>
                                @lang('titles.view_all')
                            </span>
                            <i class="fal fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                {{-- /Col --}}

                {{-- Col --}}
                <div class="col-md-4">
                    <div class="all-blogs">
                        @if(! empty($result['articles']->take(3)))

                            @foreach ($result['articles']->take(3) as $item)
                                @includeIf('website.pages.articles.small',['item' => $item])
                            @endforeach
                        @endif
                    </div>
                </div>
                {{-- /Col --}}

                {{-- Col --}}
                <div class="col-md-4">
                    @if(! empty($result['articles']->skip(3)->take(1)))
                            @foreach ($result['articles']->skip(3)->take(1) as $item)
                            <div class="blog-big position-relative">
                                <a href="{{ $item->url }}" class="link-block"></a>
                                <div class="img">
                                    <img src="{{ $item->image_path }}"
                                        alt="#" />
                                </div>
                                <div class="details">
                                    <span>
                                        October 11, 2022
                                        <a href="#">{{ $item->writer }}</a>
                                    </span>
                                    <h3>
                                        {{ $item->title }}
                                    </h3>
                                    <div class="foot-block">
                                        <span>
                                            In <a href="#">{{ $item->catalogue->title ?? '' }}</a>
                                        </span>

                                        <a href="{{ $item->url }}" class="readMore">
                                            @lang('titles.read_more')
                                            <i class="fal fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif

                </div>
                {{-- /Col --}}


                {{-- Col --}}
                <div class="col-md-4">
                    <div class="all-blogs">
                        @if(! empty($result['articles']->skip(4)->take(3)))
                            @foreach ($result['articles']->skip(4)->take(3) as $item)
                                @includeIf('website.pages.articles.small',['item' => $item])
                            @endforeach
                        @endif
                    </div>
                </div>
                {{-- /Col --}}
            </div>
        </div>
    </section>

@endif
