@extends('admin.layouts.app')
@section('tab_name', __('titles.orders'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => __('attributes.list', ['item' => __('titles.orders')]),
        'title' => __('titles.orders'),
        'createBtn' => false,
        'btnTitle' => false,
        'btnUrl' => null,
        'count' => $result['counts'] ?? '0',
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.orders.search')
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-xs-center">#</th>

                                        <th>@lang('attributes.customer')</th>
                                        <th>@lang('attributes.Shipping')</th>
                                        <th>@lang('attributes.price')</th>
                                        <th>@lang('attributes.no_products')</th>
                                        <th>@lang('attributes.status')</th>
                                        <th>@lang('attributes.payment')</th>

                                        <th>@lang('attributes.CreationDate')</th>
                                        <th class="text-xs-right">@lang('attributes.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>
                                            <td>
                                                <p>{{ $item->name ?? '' }}</p>
                                                <p>{!! $item->email !!}</p>
                                                <p>{!! $item->mobile !!}</p>
                                            </td>

                                            <td>{{ $item->shipping_cost }}</td>
                                            <td>{{ $item->total_price }}</td>
                                            <td>
                                                <p>{!! $item->no_products !!}</p>
                                            </td>

                                            <td>
                                                {!! $item->status_span !!}
                                            </td>
                                            <td>
                                                {!! $item->payment_method_span !!}
                                                <br/>
                                                {!! $item->payment_status_span !!}
                                            </td>


                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>
                                            <td class="text-left">

                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('admin.orders.show', $item->id) }}">
                                                    <i class="mdi mdi-eye font-size-18"></i>
                                                </a>

                                                <a class="btn btn-sm btn-outline-warning"
                                                    href="{{ route('admin.orders.edit', $item->id) }}">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>

                                                <form action="{{ route('admin.orders.destroy', $item->id) }}" method="POST"
                                                    style="display: inline;"
                                                    onsubmit="return confirm('Delete? Are you sure?');">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">

                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                            class="mdi mdi-delete font-size-18"></i> </button>
                                                </form>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $result['items']->render() !!}
                    @else
                        <div class="text-center">
                            <img src="{{ asset('/panel/images/empty-box.png') }}" class="empty-box" />

                            <hr>
                            <h3 class="text-xs-center text-info">No data addes !</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

@endsection
