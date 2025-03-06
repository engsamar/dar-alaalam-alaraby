<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/meanmenu.min.js') }}"></script>
<script src="{{ asset('assets/js/appear.min.js') }}"></script>
<script src="{{ asset('assets/js/countrySelect.min.js') }}"></script>
<script src="{{ asset('assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/js/loopcounter.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('assets/js/contact-form-script.js') }}"></script>
<script src="{{ asset('assets/js/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('assets/js/intlTelInput-jquery.min.js')}}" ></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
<script src="https://kit.fontawesome.com/1c7f33407d.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

@yield('js')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".addToFavourite").on('click', function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: "{{ route('website.auth.favourites.store',['locale' => $locale]) }}",
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-slug"),
                },
                success: function(response) {
                    if (response.status == true) {

                        toastr.success("{{ __('titles.AddToFavouriteSuccess') }}")
                    } else if (response.status == false && response.type == 'MaxQty') {
                        toastr.error("{{ __('titles.ExceedMaxQty') }}")
                    }
                }
            });
        });

        $(".addToCart").on('click', function(e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: "{{ route('website.carts.add',['locale' => $locale]) }}",
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-slug"),
                    quantity: $('#quantityVal').val()
                },
                success: function(response) {
                    if (response.status == true) {
                        $('#priceTotal').text(response.sideCart.totalCartPrice)
                        toastr.success("{{ __('titles.AddToCartSuccess') }}")
                    } else if (response.status == false && response.type == 'MaxQty') {
                        toastr.error("{{ __('titles.ExceedMaxQty') }}")

                    }
                }
            });
        });

        $(document).on('click', ".remove-product", function(e) {
            e.preventDefault();
            var ele = $(this);
            if (confirm("{{ __('titles.DeleteQuestion') }}" )) {
                $.ajax({
                    url: "{{ route('website.carts.delete',['locale' => $locale]) }}",
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-slug")
                    },
                    success: function(response) {
                        $('.cartItem').html(response.cartItem)
                        $('#priceTotal').text(response.sideCart.totalCartPrice)
                        toastr.success("{{ __('titles.DeleteCartSuccess') }}")
                    }
                });
            }
        });

    });

</script>
