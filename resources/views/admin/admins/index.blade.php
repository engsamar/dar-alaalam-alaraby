@extends('admin.layouts.app')
@section('tab_name', trans('attributes.all'))

@section('content')
    @include('admin.layouts.title',
    [
    'subTitle' => trans('attributes.list') ,
    'title' => trans('attributes.all'),
    'createBtn' => true,
    'btnTitle' => trans('attributes.add') ,
    'btnUrl' => route('admin.admins.create') ,
    'count' => $result['counts'] ?? '0'
    ]
    )

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.admins.search')
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-xs-center">#</th>

                                        <th>@lang('admin.Name')</th>
                                        <th>@lang('admin.Mobile')</th>
                                        <th>@lang('admin.E-mail')</th>
                                        <th>@lang('admin.CreationDate')</th>
                                        <th class="text-xs-right">@lang('admin.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>

                                            <td>{{ $item->name ?? '' }}</td>
                                            <td>{!! $item->mobile !!}</td>

                                            <td>{!! $item->email !!}</td>
                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>
                                            <td class="text-left">

                                                <a class="btn btn-sm btn-outline-warning"
                                                    href="{{ route('admin.admins.edit', $item->id) }}">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>

                                                <form action="{{ route('admin.admins.destroy', $item->id) }}"
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
