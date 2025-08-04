@extends('website.layouts.app')

@section('title',__('titles.carts'))
@section('content')
<!-- Start Page Title Area -->
@includeIf('website.layouts.title',['title' => __('titles.carts')])
<!-- Start Cart Area -->
<div class="cart-area ptb-100">
    <div class="container cartItem" >
        @includeIf('website.carts.item')

    </div>
</div>
<!-- End Cart Area -->
@endsection

@section('js')
<script>
    $(document).ready(function() {
        let locale = "{{ $locale }}";
        $(document).on('click', ".increaseCart", function(e) {
            e.preventDefault();
            var ele = $(this);
            let url = "{{ route('website.carts.increase',['locale' => ':locale']) }}";
            url = url.replace(':locale' , locale)

            $.ajax({
                url: url,
                method: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                },
                success: function(response) {

                    if (response.status == true) {
                        $('.cartItem').html(response.cartItem)
                        $('#itemCount').text(response.sideCart.itemCount)
                        $('#shopRight').html(response.sideCart.side_cart)
                        $('#priceTotal').text(response.sideCart.totalCartPrice)
                        toastr.success("{{ __('titles.IncreaseCartSuccess') }}")
                    } else if (response.status == false && response.type == 'MaxQty') {
                        toastr.error("{{ __('titles.ExceedMaxQty') }}")

                    }
                }
            });
        });

        $(document).on('click', ".decreaseCart", function(e) {
            e.preventDefault();
            var ele = $(this);
            let url = "{{ route('website.carts.decrease',['locale' => ':locale']) }}";
            url = url.replace(':locale' , locale)

            $.ajax({
                url: url,
                method: "put",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                },
                success: function(response) {
                    if (response.status == true) {
                        $('#shopRight').html(response.sideCart.side_cart)
                        $('#itemCount').text(response.sideCart.itemCount)
                        $('.cartItem').html(response.cartItem)
                        $('#priceTotal').text(response.sideCart.totalCartPrice)

                        toastr.success("{{ __('titles.DecreaseCartSuccess') }}")
                    }
                }
            });
        });

        $(document).on('click', '.checkCode', function(e) {
            e.preventDefault();
            var coupon_code = $('.coupon_code').val();
            if (!coupon_code) {
                toastr.error("{{ __('titles.InvalidCouponCode') }}")
                return false;
            }
            $('.checkCode').prop('disabled', true);
            let url = "{{ route('website.carts.validateCoupon',['locale' => ':locale']) }}";
            url = url.replace(':locale' , locale)


            $.ajax({
                url: url,
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon: coupon_code,
                },
                success: function(response) {
                    $('.checkCode').prop('disabled', false);
                    if (response.status == true) {
                        $('#shopRight').html(response.sideCart.side_cart)
                        $('#itemCount').text(response.sideCart.itemCount)
                        $('.cartItem').html(response.cartItem)
                        $('#priceTotal').text(response.sideCart.totalCartPrice)

                        toastr.success("{{ __('titles.CouponAppliedSuccess') }}")

                    } else {
                        toastr.error("{{ __('titles.CouponAppliedFailed') }}")
                        $('.coupon_code').val('');
                    }
                }
            });
        });
    });
</script>
@endsection
