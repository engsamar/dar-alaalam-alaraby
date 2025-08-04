@extends('auth.layouts.app')
@section('title',__('titles.myAddresses'))
@section('contentDashboard')
    @includeIf('auth.layouts.title', [
        'page' => [
            'title' => __('titles.myAddresses'),
            'count' => $result['counts'] ?? 0,
            'searchable' => true,
            'btnTitle' => __('titles.addNewAddress'),
            'createBtn' => route('website.auth.addresses.create',['locale'=>$locale]),
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
                                <th scope="col">@lang('attributes.addressTitle')</th>
                                <th scope="col">@lang('attributes.created_date')</th>
                                <th scope="col">@lang('attributes.city')</th>
                                <th scope="col">@lang('attributes.address')</th>
                                <th scope="col">@lang('attributes.Actions')</th>
                            </tr>
                        </thead>
                        <tbody class="t-body">
                            @if (!empty($result['items']) && count($result['items']) > 0)
                                @foreach ($result['items'] as $item)
                                    <tr>
                                        <th scope="row">
                                            {{ $item->title }}
                                        </th>
                                        <td class="vam">{{ date('Y-m-d', strtotime($item->created_at)) }}</td>

                                        <td class="vam">{{ $item->city->title ?? '' }} <br />
                                            {{ $item->region->title ?? '' }} </td>
                                        <td class="vam">
                                           @lang('attributes.building_number'): {{ $item->building_number ?? '' }} <br />

                                           @lang('attributes.floor_number'): {{ $item->floor_number ?? '' }} <br />
                                            {{ $item->street ?? '' }} <br />
                                            {{ $item->address ?? '' }} </td>
                                        <td class="vam">
                                            <div class="icons-h d-flex">

                                                <a href="{{ route('website.auth.addresses.edit', ['address'=>$item,'locale'=>$locale]) }}" class="icon"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                                    data-bs-original-title="Edit" aria-label="Edit"><span
                                                        class="fas fa-pen fa"></span>
                                                </a>
                                                {{-- <a href="" class="icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="" data-bs-original-title="Delete" aria-label="Delete">
                                                    <span class="flaticon-bin"></span>
                                                </a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else

                                <tr class="text-center">
                                    <td colspan="5">
                                        <img src="{{ asset('address.jpg') }}" width="100" />
                                        <p>@lang('titles.no_data')</p>
                                    </td>
                                </tr>
                            @endif


                        </tbody>
                    </table>
                    @if (!empty($result['items']) && count($result['items']) > 0)
                        <div class="mbp_pagination text-center mt30">
                            {{ $result['items']->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
