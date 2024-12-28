@if (!empty($result['testimonials']) && count($result['testimonials']) > 0)
    <div class="testimonials-area testimonials-h pb-75 pt-75">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="section-title">
                        <h2>@lang('titles.testimonials')</h2>
                        <p>
                            Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. Capitalize on low hanging fruit to identify a ballpark value added activity to beta test.
                        </p>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="testimonials-inner">
                        <div class="owl-carousel owl-theme testimonials-slides ">
                            @foreach ($result['testimonials'] as $item)
                                <div class="item">
                                    <div class="testimonials-box">
                                        <div class="user-name">
                                            <img src="{{ imagePath($item->image) }}" alt="testimonials-image"
                                                class="testimonials">
                                            <div class="user-in">
                                                <h3>{{ $item->title }}</h3>
                                                <span>customer</span>
                                            </div>
                                        </div>
                                        <!-- ///star  -->
                                        <div class="rating bottom">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <p>{{ $item->description }}</p>
                                            {{-- <div class="bottom-2">
                                                <img src="https://html.creativegigstf.com/babun/babun/images/icon/icon_28.svg"
                                                    alt="">
                                            </div> --}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
