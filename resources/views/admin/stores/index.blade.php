@extends('admin.layouts.app')
@section('tab_name', __('admin.stores'))
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => trans('common.list') . ' ' . trans('titles.stores'),
        'title' => trans('titles.stores'),
        'createBtn' => true,
        'btnTitle' => trans('common.add'),
        'btnUrl' => route('admin.stores.create'),
        'count' => $result['counts'] ?? '0',
    ])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.stores.search')
                    <hr />
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-xs-center">#</th>
                                        <th>@lang('attributes.Title')</th>
                                        <th>@lang('attributes.Image')</th>
                                        <th>@lang('attributes.email')</th>
                                        <th>@lang('attributes.Mobile')</th>

                                        <th>@lang('attributes.Publish')</th>
                                        <th>@lang('attributes.CreationDate')</th>
                                        <th class="text-xs-right">@lang('attributes.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>
                                            <td><img src="{{ imagePath($item->logo) ?? '' }}"></td>
                                            <td>{{ $item->title ?? '' }}</td>
                                            <td>{!! $item->email !!}</td>
                                            <td>{!! $item->phone !!}</td>
                                            <td>{!! $item->active_span !!}</td>
                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>
                                            <td class="text-left">

                                                <a class="btn btn-sm btn-outline-warning"
                                                    href="{{ route('admin.stores.edit', $item->id) }}">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>

                                                <form action="{{ route('admin.stores.destroy', $item->id) }}"
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
                            <img src="{{ asset('panel/images/empty-box.png') }}" class="empty-box" />

                            <hr>
                            <h3 class="text-xs-center text-info">No data addes !</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


@endsection
