@extends('auth.layouts.app')
@section('title',__('titles.profile'))

@section('contentDashboard')
    @includeIf('auth.layouts.title', [
        'page' => [
            'title' => __('titles.profile'),
            'subTitle' => __('titles.profileWelcome'),
        ],
    ])

    <div class="row">
        <div class="col-sm-6 col-xxl-6">
            <div class="d-flex justify-content-between statistics_funfact">
                <div class="details">
                    <div class="text fz25">@lang('titles.OrderNo')</div>
                    <div class="title">{{ $result['countProducts'] ?? 0 }}</div>
                </div>
                <div class="icon text-center"><i class="bx bx-list-ul"></i></div>
            </div>
        </div>

        <div class="col-sm-6 col-xxl-6">
            <div class="d-flex justify-content-between statistics_funfact">
                <div class="details">
                    <div class="text fz25">@lang('titles.myOldOrders')</div>
                    <div class="title">{{ $result['countClosedOrders'] ?? 0 }}</div>
                </div>
                <div class="icon text-center"><i class="bx bx-like"></i></div>
            </div>
        </div>

    </div>
@endsection
