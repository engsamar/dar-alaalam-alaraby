@extends('auth.layouts.app')
@section('title',__('titles.myOldOrders'))

@section('contentDashboard')
    @includeIf('auth.layouts.title', [
        'page' => [
            'title' =>
                isset(app('request')->type) && app('request')->type == 'closed'
                    ? __('titles.myOldOrders')
                    : __('titles.myOrders'),
            'count' => $result['counts'] ?? 0,
            'subTitle' => __('titles.profileWelcome'),
        ],
    ])
    <div class="row">
        <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                    <table class="table-style3 table at-savesearch">
                        <thead class="t-head">
                            <tr>
                                <th scope="col">@lang('attributes.reference_number')</th>

                                <th scope="col">@lang('attributes.date')</th>
                                <th scope="col">@lang('attributes.no_products')</th>
                                <th scope="col">@lang('attributes.total')</th>
                                <th scope="col">@lang('attributes.status')</th>
                                <th scope="col">@lang('attributes.payment_status')</th>

                                <th scope="col">@lang('attributes.invoice')</th>
                            </tr>
                        </thead>
                        <tbody class="t-body">
                            @if (!empty($result['items']) && count($result['items']) > 0)
                                @foreach ($result['items'] as $item)
                                    @if (!empty($item->products) && count($item->products) > 0)
                                        <tr>
                                            <td class="vam">{{ $item->reference_number }}</td>

                                            <td class="vam">{{ $item->date }}</td>
                                            <td class="vam">{{ $item->no_products }}</td>
                                            <td class="vam">
                                                {!! $item->total_price !!}

                                            </td>
                                            <td class="vam">{!! $item->status_span !!}</td>
                                            <td class="vam">{!! $item->payment_status_span !!}</td>

                                            <td class="vam">
                                                <div class="d-flex">
                                                    <a href="{{ route('website.auth.orders.show',['reference_number' => $item->reference_number, 'locale' => $locale]) }}"
                                                        class="icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="" data-bs-original-title="@lang('titles.Show')"
                                                        aria-label="@lang('titles.Show')"><span class="fas fa-eye fa"></span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    @if (!empty($result['items']) && count($result['items']) > 0)
                        {!! $result['items']->render() !!}
                    @else
                        <div class="text-center">
                            <img src="{{ asset('orders.jpg') }}" width="100" />
                            <p>@lang('titles.no_data')</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
