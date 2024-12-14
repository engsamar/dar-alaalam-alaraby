@extends('website.layouts.app')

@section('title',__('titles.articles'))
@section('seo')
    <meta name='description' itemprop='description' content='{{ $result['item']->sub_title }}'>
    <meta name='keywords' content='key1, key2, key3'>
    <meta property="og:description" content="{{ $result['item']->sub_title }}">
    <meta property="og:title" content="{{ $result['item']->title }}">
    <meta property="og:url" content="{{ $result['item']->url }}">
    <meta property="og:type" content="item">
    <meta property="og:site_name" content="cardinal">
    <meta property="og:image" content="{{ $result['item']->image }}">
    <meta property="og:image:url" content="{{ $result['item']->image }}">
    <meta property="og:image:size" content="300">

    <meta name="twitter:card" content="{{ $result['item']->sub_title }}">
    <meta name="twitter:title" content="{{ $result['item']->title }}">
    <meta name="twitter:site" content="{{ $result['item']->url }}">
@endsection
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.articles')])
<!-- End Page Title Area -->
<!-- Start Blog Details Area -->
<div class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="blog-details-desc">
                    <div class="post-thumb">
                        <img src="{{ $result['item']->image_path ?? '' }}" alt="blog-details">
                    </div>
                    <h4>{{ $result['item']->title ?? '' }}</h4>
                    <div class="post-meta">
                        <ul>
                            <li><i class='bx bx-calendar'></i>  {{ $result['item']->date != null ? date('M d, Y', strtotime($result['item']->date ) ) : '' }}</li>
                            <li><i class='bx bx-comment-detail'></i> <a href="{{ $result['item']->catalogue->url ?? '#' }}">{{ $result['item']->catalogue->title ?? '' }}</a></li>
                        </ul>
                    </div>
                    {!!  $result['item']->description ?? '' !!}
                    @if(! empty($result['item']->images ))
                        <ul class="wp-block-gallery columns-3">
                            @foreach ($result['item']->images  as $image )
                                <li class="blocks-gallery-item">
                                    <figure>
                                        <img src="{{ $image }}" alt="image">
                                    </figure>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="post-footer">
                        <div class="post-tags">
                            <span class="sub">@lang('titles.Tags'):</span>
                            @if(! empty($result['item']->tags ))
                                <ul>
                                    @foreach ($result['item']->tags  as $tag )
                                        <li><a href="{{ $tag->url }}" rel="tag">{{ $tag->title }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="article-share">
                            <ul class="social">
                                <li><span>@lang('titles.share')</span></li>
                                <li><a target="_blank" href="{{ $result['share']['whatsapp'] ?? '#' }}">
                                    <i class="bx bxl-whatsapp"></i>
                                </a>
                                </li>
                                <li><a target="_blank" href="{{ $result['share']['twitter'] ?? '#' }}">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                                </li>

                                <li><a target="_blank" href="{{ $result['share']['facebook'] ?? '#' }}">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-12">
                <aside class="widget-area right-sidebar">
                    <div class="widget widget_search">
                        <form class="search-form" method="get">
                            <input type="search" name="search" class="search-field" placeholder="Search...">
                            <button type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>
                    {{-- <div class="widget widget_author">
                        <img src="assets/img/team/team2.jpg" alt="author">
                        <h3>Sarah Taylor</h3>
                        <span>Blogger</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                        <img src="assets/img/signature.png" alt="signature">
                    </div> --}}
                    <div class="widget widget_follow_us">
                        <h3 class="widget-title"><span>@lang('titles.FollowUs')</span></h3>
                        <ul>

                            @includeIf('website.layouts.social')
                        </ul>
                    </div>
                    <div class="widget widget_patoi_posts_thumb">
                        <h3 class="widget-title"><span>@lang('titles.PopularPosts')</span></h3>
                        @if(! empty($result['items'] ))
                            @foreach ($result['items']  as $article )
                                <article class="item">
                                    <a href="{{ $article->url }}" class="thumb">
                                        <img src="{{ $article->image_path }}" alt="blog-image">
                                    </a>
                                    <div class="info">
                                        <h4 class="title"><a href="{{ $article->url }}">{{ $article->title }}</a></h4>
                                        <span class="date">{{ date('d M', strtotime($article->date)) }}</span>
                                    </div>
                                </article>
                            @endforeach

                        @endif

                    </div>
                    <div class="widget widget_categories">
                        <h3 class="widget-title"><span>@lang('titles.catalogues')</span></h3>
                        <ul>
                            @if(! empty($result['catalogues']))
                                @foreach ($result['catalogues'] as $catalogue )
                                <li><a href="{{ $catalogue->url }}" rel="catalogue">{{ $catalogue->title }}</a></li>
                                @endforeach
                            @endif

                        </ul>
                    </div>
                    <div class="widget widget_tag_cloud">
                        <h3 class="widget-title"><span>@lang('titles.Tags')</span></h3>
                        <div class="tagcloud">
                            @if(! empty($result['tags']))
                                @foreach ($result['tags'] as $tag )
                                    <a href="{{ $tag->url }}" rel="tag">{{ $tag->title }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- End Blog Details Area -->
@endsection
