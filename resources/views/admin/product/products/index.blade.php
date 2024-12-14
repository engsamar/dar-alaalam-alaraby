@extends('admin.layouts.app')
@section('tab_name', __('titles.products'))
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => trans('common.list') . ' ' . trans('titles.products'),
        'title' => trans('titles.products'),
        'createBtn' => true,
        'btnTitle' => trans('common.add'),
        'btnUrl' => route('admin.products.create'),
        'count' => $result['counts'] ?? '0',
    ])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.product.products.search')
                    <hr />
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-xs-center">#</th>
                                        <th>@lang('attributes.Image')</th>
                                        <th>@lang('attributes.Title')</th>
                                        <th>@lang('attributes.Category')</th>

                                        <th>@lang('attributes.price')</th>
                                        <th>@lang('attributes.Position')</th>

                                        <th>@lang('attributes.Publish')</th>
                                        <th>@lang('attributes.CreationDate')</th>
                                        <th class="text-xs-right">@lang('attributes.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>
                                            <td><img src="{{ imagePath($item->image) ?? '' }}"></td>
                                            <td style="max-width: 300px;white-space:pre-wrap; word-wrap:break-word;">{{ $item->title ?? '' }}</td>
                                            <td>
                                                {{ $item->category->title ?? '' }}

                                            </td>
                                            <td>
                                                {{ $item->price ?? '' }}</br>
                                                @lang('attributes.discount'): {{ $item->discount ?? '' }}</br>
                                                @lang('attributes.price_after'): {{ $item->price_after ?? '' }}</br>
                                            </td>
                                            <td>{!! $item->position !!}</td>
                                            <td>{!! $item->active_span !!}</td>
                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>
                                            <td class="text-left">
                                                <a class="btn btn-sm btn-outline-info"
                                                    href="{{ route('admin.product-settings.edit', $item->id) }}">
                                                    <i class="bx bx-brightness-half font-size-18"></i>
                                                </a>
                                                <a class="btn btn-sm btn-outline-warning"
                                                    href="{{ route('admin.products.edit', $item->id) }}">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>

                                                <form action="{{ route('admin.products.destroy', $item->id) }}"
                                                    method="POST" style="display: inline;"
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
