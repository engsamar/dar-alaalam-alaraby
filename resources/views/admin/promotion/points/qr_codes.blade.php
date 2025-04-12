@extends('admin.layouts.app')
@section('tab_name', __('titles.qr_code_points'))
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => trans('titles.manage', ['model' => __('titles.qr_code_points')]),
        'title' => trans('titles.qr_code_points'),
        'createBtn' => false,
        'count' => $result['counts'] ?? '0',
    ])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                @include('admin.promotions.points.search')
                    <hr />
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-xs-center">#</th>
                                        <th>@lang('attributes.user')</th>
                                        <th>@lang('attributes.user_type')</th>
                                        <th>@lang('attributes.points')</th>
                                        <th>@lang('attributes.product')</th>
                                        <th>@lang('attributes.reference_number')</th>
                                        <th>@lang('attributes.CreationDate')</th>


                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>

                                            <td>{!! $item->user->name ?? '' !!}</td>
                                            <td>{!! $item->user->type ?? '' !!}</td>
                                            <td class="text-xs-center"><strong>{{ $item->points }}</strong></td>
                                            <td>{{ $item->qrCode->productQrCode->product->title ?? '' }}</td>
                                            <td>{!! $item->qrCode->reference_number ?? '' !!}</td>

                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $result['items']->withQueryString()->links() !!}
                    @else
                        <div class="text-center">
                            <img src="{{ asset('panel/empty-box.png') }}" class="empty-box" />

                            <hr>
                            <h3 class="text-xs-center text-primary">No data addes !</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


@endsection
