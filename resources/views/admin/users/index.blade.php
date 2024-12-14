@extends('admin.layouts.app')
@section('tab_name', __('titles.users'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => __('attributes.list', ['item' => __('titles.users')]),
        'title' => __('titles.users'),
        'createBtn' => true,
        'btnTitle' => __('attributes.add'),
        'btnUrl' => route('admin.users.create'),
        'count' => $result['counts'] ?? '0',
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.users.search')
                    @if ($result['items']->count())
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-xs-center">#</th>

                                        <th>@lang('attributes.Name')</th>
                                        <th>@lang('attributes.E-mail')</th>

                                        <th>@lang('attributes.Mobile')</th>
                                        <th>@lang('attributes.Gender')</th>
                                        <th>@lang('attributes.BirthDate')</th>
                                        <th>@lang('attributes.Active')</th>

                                        <th>@lang('attributes.CreationDate')</th>
                                        <th class="text-xs-right">@lang('attributes.Actions')</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($result['items'] as $item)
                                        <tr>
                                            <td class="text-xs-center"><strong>{{ $item->id }}</strong></td>
                                            <td>{{ $item->name ?? '' }}</td>
                                            <td>{!! $item->email !!}</td>
                                            <td>{!! $item->mobile !!}</td>
                                            <td>{!! $item->gender !!}</td>
                                            <td>{!! $item->birth_date !!}</td>
                                            <td>
                                                <div class="form-check form-switch form-switch-lg">
                                                    <input data-id="{{ $item->id }}" data-size="mini"
                                                        class="form-check-input change_block"
                                                        {{ $item->active == 1 ? 'checked' : '' }} name="active"
                                                        value="{{ $item->id }}" type="checkbox">

                                                </div>
                                            </td>
                                            <td>{{ dateFormatted($item->updated_at, 'd M Y @ h:i a') }}</td>
                                            <td class="text-left">

                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('admin.users.show', $item->id) }}">
                                                    <i class="mdi mdi-eye font-size-18"></i>
                                                </a>

                                                <a class="btn btn-sm btn-outline-warning"
                                                    href="{{ route('admin.users.edit', $item->id) }}">
                                                    <i class="mdi mdi-pencil font-size-18"></i>
                                                </a>

                                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                                    style="display: inline;"
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

@section('scripts')
    <script>
        $('.change_block').on('change', function() {
            let id = $(this).attr('data-id');
            let url = "{{ route('admin.users.block', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection
