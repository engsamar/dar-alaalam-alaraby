@extends('auth.layouts.app')
@section('title', __('titles.myfavourites'))

@section('contentDashboard')
    @includeIf('auth.layouts.title', [
        'page' => [
            'title' => __('titles.myfavourites'),
            'count' => $result['counts'] ?? 0,
            'searchable' => false,
            'subTitle' => __('titles.profileWelcome'),
        ],
    ])
    <div class="row">
        <div class="col-xl-12">
            <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative data">

                @if (!empty($result['items']) && count($result['items']) > 0)
                    @foreach ($result['items'] as $item)
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            @includeIf('website.pages.store.item', ['item' => $item->product])
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <img src="{{ asset('fav.jpg') }}" width="100" />
                        <p>@lang('titles.no_data')</p>
                    </div>
                @endif

                <div class="col-lg-12 col-md-12 col-sm-12">
                    {!! $result['items']->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
