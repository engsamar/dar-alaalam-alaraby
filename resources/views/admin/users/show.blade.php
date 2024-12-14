@extends('admin.layouts.app')
@section('tab_name', __('titles.users'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">
                    <h4>
                        @lang('titles.users') #{{ $item->id }} {!! $item->active_span !!}
                    </h4>
                    <hr>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th width="25%"> <i class="mdi mdi-minus-box"></i>@lang('attributes.Image') </th>
                                <td> <i class="mdi mdi-pin"></i>
                                    <img src="{{ $item->image ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i> @lang('attributes.Name') </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->name ?? '' }}
                                </td>
                            </tr>


                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('attributes.E-mail') </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->email ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('attributes.Mobile') </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->mobile ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('attributes.Gender')</th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->gender }}
                                </td>
                            </tr>

                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('attributes.BirthDate')</th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->birth_date }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('attributes.CreationDate') </th>
                                <td> <i class="icon-pin"></i>
                                    {{ $item->created_at }}
                                </td>
                            </tr>
                            <tr>
                                <th width="25%"> <i class="icon-minus-box"></i>@lang('attributes.LastUpdate')</th>
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
