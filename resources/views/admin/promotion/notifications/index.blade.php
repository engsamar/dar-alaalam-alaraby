@extends('admin.layouts.app')
@section('tab_name', __('titles.notifications'))
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => trans('titles.manage', ['model' => __('titles.notifications')]),
        'title' => trans('titles.notifications'),
        'createBtn' => true,
        'btnUrl' => route('admin.notifications.create'),
        'count' => $result['counts'] ?? '0',
        'can' => can('notifications.create')
    ])
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.promotions.notifications.search')
                    <hr />
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-xs-center">#</th>
                                        <th>@lang('attributes.title')</th>
                                        <th>@lang('attributes.CreationDate')</th>
                                        <th class="text-xs-right">@lang('attributes.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>
                                            <td>{{ $item->title ?? '' }}</td>

                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>
                                            <td class="text-left">

                                                {{-- <a class="btn btn-sm btn-outline-warning text-warning"
                                                    href="{{ route('admin.notifications.edit', $item->id) }}">
                                                    <i class="si si-pencil font-size-18"></i>
                                                </a> --}}
                                                @if(can('notifications.delete'))

                                                    <form action="{{ route('admin.notifications.destroy', $item->id) }}"
                                                        method="POST" style="display: inline;"
                                                        onsubmit="return confirm('Delete? Are you sure?');">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">

                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i
                                                                class="si si-trash font-size-18"></i> </button>
                                                    </form>
                                                @endif



                                            </td>
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
