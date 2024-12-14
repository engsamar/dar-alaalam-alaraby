@extends('website.layouts.app')

@section('content')
    @includeIf('website.layouts.pages.breadcum', ['title' => __('website.thanks')])

    <section class="faq box-spach">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 "></div>
                <div class="col-lg-10 ">
                    <div class="left-content">
                        <div class="section-title v1">
                            <h6> عملية الدفع تمت بنجاح</h6>
                            <h2>عسلك  </h2>
                        </div>
                        <p>
                            أنشئ منتجك, تبنى إحدى خلايا النحل وسيقوم النحال بالاعتناء بها, ثم تابع تطور خليتك وإنتاجها
                            ومعرفة موقعها في صفحتك الخاصة وبإمكانك زيارتها, وأخيراً أحصل على العسل مباشرة الى المنزل بمجرد
                            أن يكون جاهزًا!
                        </p>
                        <a href="{{ route('website.contact.show') }}" class="link-anime v2">تواصل معنا</a>
                    </div>


                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let url = "{{ route('website.auth.orders.show', ':id') }}";
        let id = "{{ $result['order']->reference_number }}"
        url = url.replace(':id', id)

        var timer = setTimeout(function() {
            window.location = url
        }, 3000);
    </script>
@endsection
