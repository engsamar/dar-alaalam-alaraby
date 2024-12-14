<form action="{{ route('website.auth.cart.checkout.store',['locale' => $locale]) }}" method="post">
    @csrf

    <div class="cart-table table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">@lang('attributes.product')</th>
                    <th scope="col">@lang('attributes.price')</th>
                    <th scope="col">@lang('attributes.quantity')</th>
                    <th scope="col">@lang('attributes.Total')</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($result['items']))
                    @foreach ($result['items'] as $item)
                        <tr>
                            <td><button class="btn remove remove-product" data-slug="{{ $item->product->slug }}"><i class='bx bx-trash'></i></button></td>
                            <td class="product-thumbnail">
                                <a href="{{ $item->product->url }}">
                                    <img src="{{ $item->product->image_path }}" alt="item">
                                    <h3>{{ $item->product->title }}</h3>
                                </a>
                            </td>
                            <td>{{ $item->product->price_after }} @lang('titles.currency')</td>
                            <td class="product-quantity">
                                <div class="input-counter">

                                    <span class="minus-btn decreaseCart" data-id="{{ $item->id }}"><i class='bx bx-minus'></i></span>
                                    <input type="text" name='quantity' value="{{ $item->quantity }}">
                                    <span class="plus-btn increaseCart" data-id="{{ $item->id }}"><i class='bx bx-plus'></i></span>
                                </div>
                            </td>
                            <td>{{ $item->quantity * $item->product->price_after }} @lang('titles.currency')</td>
                        </tr>
                    @endforeach
                @endif


            </tbody>
        </table>
    </div>

    <div class="cart-buttons">
        <div class="row align-items-center">
            <div class="col-lg-7 col-sm-12 col-md-7">
                <div class="shopping-coupon-code">

                    <input class="coupon_code form-control" value="{{ $result['coupon'] ?? '' }}"
                    name="coupon_code" placeholder="@lang('titles.EnterYourCoupon')">
                    <button type="button" class="checkCode">@lang('titles.ApplyCoupon')</button>

                </div>

            </div>
            <div class="col-lg-5 col-sm-12 col-md-5 text-end">
                <a href="{{ route('website.carts.index',['locale' => $locale]) }}" class="default-btn"><span>Update Cart</span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="cart-totals  col-lg-4 col-sm-4 col-md-4">

        </div>
        <div class="cart-totals col-lg-4 col-sm-4 col-md-4">
            <div class="col-sm-12 col-xl-12">
                <div class="mb20 mt-3">
                    <label class="heading-color ff-heading fw600 mb10">@lang('attributes.address')</label>
                    <input required type="text" name="address" id="address"
                        value="{{ old('address') }}" class="form-control"
                        placeholder="@lang('attributes.address')">
                    @if ($errors->has('address'))
                        <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                    @else
                        <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                            __('attributes.address') ])
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-xl-12">
                <div class="mb20 mt-3">
                    <label class="heading-color ff-heading fw600 mb10">@lang('attributes.city')</label>
                    <div class="location-area">
                        <div class=" bootstrap-select show-tick">
                            <select class="selectpicker form-control" name="city_id">
                                @if (!empty($result['cities']))
                                    @foreach ($result['cities'] as $city)
                                        <option value="{{ $city->id }}"
                                            {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                            {{ $city->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-totals  col-lg-4 col-sm-4 col-md-4">
            <ul>
                <li>@lang('attributes.withoutVat') <span>{{ $result['total'] ?? 0 }}
                    @lang('titles.currency')</span></li>
                <li>@lang('attributes.CouponDiscount') <span>{{ $result['discount'] ?? 0 }}</span></li>
                <li>@lang('attributes.Shipping') <span>{{ $result['shipping_cost'] ?? 0 }}</span></li>
                <li>@lang('attributes.Vat') {{ $result['vatPerecent'] > 0 ? $result['vatPerecent'] . '%' : 0 }} <span>{{ $result['vat'] ?? 0 }} @lang('titles.currency')</span></li>
                <li>@lang('attributes.WithVat') <span>{{ $result['vatTotal'] ?? 0 }}
                    @lang('titles.currency')</span></li>
            </ul>
            <button type="submit" class="default-btn"><span>@lang('attributes.ProceedToCheckOut')</span></button>
        </div>
    </div>
</form>
