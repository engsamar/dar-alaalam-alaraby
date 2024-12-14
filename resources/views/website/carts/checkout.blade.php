@extends('website.layouts.app')

@section('content')
    @includeIf('website.layouts.pages.breadcum', ['title' => __('website.checkout')])

    <section class="cart-page body-inner">
        <div class="container">
            <div class="row cartItem">
                <div class="col-md-6">
                    <div class="headCheckOut">
                        <h4>@lang('attributes.OrderTotals')</h4>
                    </div>
                    <div class="checkOut-in">
                        <div class="headCheckOut">

                            <div class="price-checkOut">
                                <h2>{{ $result['order']['total_price'] ?? 0 }}</h2>
                                <span>
                                    @lang('website.currency')
                                </span>
                            </div>
                        </div>

                        <div class="bodyCheckOut">
                            <ul>
                                <li>
                                    <div class="item">
                                        <h4>@lang('attributes.withoutVat')</h4>

                                    </div>
                                    <div class="item">
                                        <h4>{{ $result['order']['price'] ?? 0 }}
                                            @lang('attributes.currency')</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <h4>@lang('attributes.delivery_cost')</h4>
                                    </div>
                                    <div class="item">
                                        <h4>{{ $result['order']['delivery_cost'] ?? 0 }} @lang('attributes.currency')</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <h4>@lang('attributes.CouponDiscount')</h4>
                                    </div>
                                    <div class="item">
                                        <h4>{{ $result['order']['coupon_value'] ?? 0 }} @lang('attributes.currency')</h4>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <span>@lang('attributes.Vat')
                                            {{ $result['order']['vat'] > 0 ? $result['order']['vat'] . '%' : 0 }}</span>
                                    </div>
                                    <div class="item">
                                        <span>{{ $result['order']['vat_value'] ?? 0 }}
                                            @lang('attributes.currency')</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="item">
                                        <h4>@lang('attributes.WithVat')</h4>
                                    </div>
                                    <div class="item">
                                        <h4>{{ $result['order']['total_price'] ?? 0 }}
                                            @lang('attributes.currency')</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="headCheckOut ">
                        <h4 class="mb-3">@lang('attributes.chooseAddress')</h4>
                        <select name="address_id" class="form-control" required>
                            @if (! empty($result['addresses']))
                                @foreach ($result['addresses'] as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->title }}
                                    </option>
                                @endforeach

                            @endif
                        </select>
                    </div>
                    @includeIf('payment.paymob')
                </div>
            </div>
        </div>
    </section>
@endsection
