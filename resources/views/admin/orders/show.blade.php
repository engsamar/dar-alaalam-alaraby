@extends('admin.layouts.app')
@section('tab_name', __('titles.orders'))

@section('content')

    <!-- start page title -->
    @include('admin.layouts.title', [
        'subTitle' => __('attributes.list', ['item' => __('titles.orders')]),
        'title' => __('titles.orders') . ' #' . $item->id,
        'createBtn' => false,
        'btnTitle' => false,
        'btnUrl' => false,
    ])
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16">Order # {{ $item->reference_number }}</h4>
                        <div class="mb-4">
                            {!! QrCode::size(60)->generate($item->reference_number) !!}
                            {{-- <img src="assets/images/logo-dark.png" alt="logo" height="20" /> --}}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>Delivered To:</strong><br>
                                {{ $item->name }}<br>
                                {{ $item->mobile }}<br>
                                {{ $item->email }}<br>
                                {{ $item->to_address }}
                            </address>

                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <address class="mt-2 mt-sm-0">
                                <strong>From:</strong><br>
                                {{ $item->from_address }}<br><br>
                                @if (! empty($item->store ))
                                    <address class="mt-2 mt-sm-0">
                                        <strong>Store:</strong><br>
                                        {{ $item->store->title ?? '' }}<br>
                                        {!! $item->store->email ?? '' !!}<br>
                                        {!! $item->store->phone ?? '' !!}<br>
                                        {!! $item->store->address ?? '' !!}<br>

                                    </address>

                                @endif

                                <strong>By Delegate:</strong><br>

                                {{ $item->delegate->name ?? '' }}<br>
                                {!! $item->delegate->email ?? '' !!}<br>
                                {!! $item->delegate->mobile ?? '' !!}<br>

                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Payment Method:</strong><br>
                                {!! $item->payment_method_span !!}<br>

                            </address>
                        </div>
                        <div class="col-sm-6 mt-3 text-sm-end">
                            <address>
                                <strong>Order Date:</strong><br>
                                {{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}<br><br>
                                {!! $item->status_span !!}
                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 fw-bold">Order summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <caption></caption>
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Item</th>
                                    <th class="text-end">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($item->order_type == 'chat')
                                    <tr>
                                        <td>01</td>
                                        <td>{{ $item->details }}</td>
                                        <td class="text-end">{{ $item->total_price }}</td>

                                    </tr>
                                @else
                                    @if (! empty($item->products))
                                        @foreach($item->products as $product)
                                            <tr>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->title }}</td>
                                                <td class="text-end">{{ $product->total_price }}</td>
                                            </tr>
                                        @endforeach

                                    @endif
                                @endif



                                {{-- <tr>
                                    <td>03</td>
                                    <td>Veltrix - Admin Dashboard Template</td>
                                    <td class="text-end">$499.00</td>
                                </tr> --}}
                                <tr>
                                    <td colspan="2" class="text-end">Sub Total</td>
                                    <td class="text-end">{{ $item->total_price }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-end">
                                        <strong>Shipping</strong>
                                    </td>
                                    <td class="border-0 text-end">{{ $item->delivery_cost }} @lang('titles.currency')</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="border-0 text-end">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="border-0 text-end">
                                        <h4 class="m-0">{{ $item->total_price }}</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-end">
                            <a href="#" class="btn btn-warning waves-effect waves-light me-1"><i
                                    class="fa fa-comments"></i>
                            </a>
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                    class="fa fa-print"></i>
                            </a>
                            <a href="javascript: void(0);" class="btn btn-primary w-md waves-effect waves-light">Send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
