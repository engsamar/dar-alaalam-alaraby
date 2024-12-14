@if(! empty($result['testimonials']) && count($result['testimonials']) > 0)
<div class="testimonials-area pb-100 pt-75">
    <div class="container">
        <div class="section-title">
            <h2>@lang('titles.testimonials')</h2>
        </div>
        <div class="testimonials-inner">
            <div class="row justify-content-center align-items-center owl-carousel owl-theme testimonials-slides ">
                @foreach ($result['testimonials'] as $item)
                <div class="col-lg-3  col-md-6 col-sm-4 col-4 text-card">
                    <div class="single-testimonials-box">
                        <a href="#" class="d-block">
                            <img src="{{ imagePath($item->image) }}" alt="testimonials-image" class="testimonials">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                            <!-- ///star  -->
             
                           <div class="rating bottom">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
<div class="bottom-2" >
<img src="https://html.creativegigstf.com/babun/babun/images/icon/icon_28.svg" alt="">
</div>                        </a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endif