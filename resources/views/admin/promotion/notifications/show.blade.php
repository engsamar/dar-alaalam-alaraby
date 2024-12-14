@extends('admin.layouts.app')
@section('tab_name', __('admin.notifications'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <h4>
                        @lang('admin.notifications') #{{ $item->id }} {!! $item->active_span !!}
                    </h4>
                    <hr>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th width="25%"> <i class="mdi mdi-minus-box"></i>@lang('titles.image') </th>
                                <td> <i class="mdi mdi-pin"></i>
                                    <img src="{{ $item->image ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i> @lang('titles.Title') En </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('ar')->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('titles.Title') Ar </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('en')->name ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('titles.SubTitle') En </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('ar')->sub_title ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('titles.SubTitle') Ar </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->translate('en')->sub_title ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('titles.Position')</th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->position }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('titles.CreationDate') </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->created_at }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('titles.LastUpdate')</th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->updated_at }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
