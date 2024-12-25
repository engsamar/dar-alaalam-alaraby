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

<section class="blogs-h">
    <div class="container">
        <div class="row">
            {{-- Col --}}
            <div class="col-md-12">
                <div class="title-flex">
                    <div class="title">
                        <h3>
                            Latest blog post
                        </h3>
                    </div>
                    <a href="#" class="btn">
                        <span>
                            View All
                        </span>
                        <i class="fal fa-angle-right"></i>
                    </a>
                </div>
            </div>
            {{-- /Col --}}

            {{-- Col --}}
            <div class="col-md-4">
                <div class="all-blogs">
                    <div class="blog-small position-relative">
                        <a href="#" class="link-block"></a>
                        <div class="img">
                            <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/11/blog_7-900x600.jpg"
                                alt="#" />
                        </div>
                        <div class="details">
                            <span>
                                November 14, 2022
                            </span>
                            <h3>
                                5 Attractive Bookstore WordPress Themes
                            </h3>
                        </div>
                    </div>

                    <div class="blog-small position-relative">
                        <a href="#" class="link-block"></a>
                        <div class="img">
                            <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/02/blog_4-750x500.jpg"
                                alt="#" />
                        </div>
                        <div class="details">
                            <span>
                                November 14, 2022
                            </span>
                            <h3>
                                5 Attractive Bookstore WordPress Themes
                            </h3>
                        </div>
                    </div>

                    <div class="blog-small position-relative">
                        <a href="#" class="link-block"></a>
                        <div class="img">
                            <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/02/blog_2-900x600.jpg"
                                alt="#" />
                        </div>
                        <div class="details">
                            <span>
                                November 14, 2022
                            </span>
                            <h3>
                                5 Attractive Bookstore WordPress Themes
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Col --}}

            {{-- Col --}}
            <div class="col-md-4">
                <div class="blog-big position-relative">
                    <a href="#" class="link-block"></a>
                    <div class="img">
                        <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/02/blog_6-750x500.jpg"
                            alt="#" />
                    </div>
                    <div class="details">
                        <span>
                            October 11, 2022
                             <a href="#">By admin</a>
                        </span>
                        <h3>
                            Behind the Scenes with Author Victoria Aveyard
                        </h3>
                        <div class="foot-block">
                            <span>
                                In <a href="#">Cultural</a>
                            </span>

                            <a href="#" class="readMore">
                                Read More
                                <i class="fal fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Col --}}


            {{-- Col --}}
            <div class="col-md-4">
                <div class="all-blogs">
                    <div class="blog-small position-relative">
                        <a href="#" class="link-block"></a>
                        <div class="img">
                            <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/11/blog_7-900x600.jpg"
                                alt="#" />
                        </div>
                        <div class="details">
                            <span>
                                November 14, 2022
                            </span>
                            <h3>
                                5 Attractive Bookstore WordPress Themes
                            </h3>
                        </div>
                    </div>

                    <div class="blog-small position-relative">
                        <a href="#" class="link-block"></a>
                        <div class="img">
                            <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/02/blog_4-750x500.jpg"
                                alt="#" />
                        </div>
                        <div class="details">
                            <span>
                                November 14, 2022
                            </span>
                            <h3>
                                5 Attractive Bookstore WordPress Themes
                            </h3>
                        </div>
                    </div>

                    <div class="blog-small position-relative">
                        <a href="#" class="link-block"></a>
                        <div class="img">
                            <img src="https://demo2.pavothemes.com/bookory/wp-content/uploads/2022/02/blog_2-900x600.jpg"
                                alt="#" />
                        </div>
                        <div class="details">
                            <span>
                                November 14, 2022
                            </span>
                            <h3>
                                5 Attractive Bookstore WordPress Themes
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /Col --}}
        </div>
    </div>
</section>
