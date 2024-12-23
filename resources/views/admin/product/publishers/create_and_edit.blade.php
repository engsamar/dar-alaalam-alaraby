@extends('admin.layouts.app')
@section('tab_name', trans('titles.areas'))
@section('css')
    <link rel="stylesheet" href="{{ asset('/panel/vendors/dropify/dropify.min.css') }}">
@endsection
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.areas'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        {{ $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add') }}
                    </h4>
                    <hr>
                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.areas.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.areas.store') }}" method="POST"
                                enctype='multipart/form-data' novalidate>
                    @endif
                    @csrf

                    @if (!empty($locales))
                        @foreach ($locales as $Key => $locale)
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2" for="title_{{ $Key }}-field">
                                    @lang('attributes.name')
                                    {{ strtoupper($Key) }} </label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input required id="title_{{ $Key }}-field" type="text"
                                            class="form-control @if ($errors->has($Key . '[title]')) is-invalid @endif"
                                            name='{{ 'title' . '[' . $Key . ']' }}'
                                            value="{{ $item->getTranslation('title', $Key) ?? old($Key . '.title') }}" />
                                        @if ($errors->has('title' . '[' . $Key . ']'))
                                            <span
                                                class="invalid-feedback">{{ $errors->first('title' . '[' . $Key . ']') }}</span>
                                        @else
                                            <div class="invalid-feedback">
                                                @lang('validation.required', [
                                                    'attribute' =>
                                                        strtolower($locale) .'' .
                                                        trans('attributes.title'),
                                                ])
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="city_id-field">@lang('admin.city')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <select class="form-control select2" name="city_id">
                                    @if (!empty($result['cities']))
                                        @foreach ($result['cities'] as $city)
                                            <option {{ old('city_id', $item->city_id) == $city->id ? 'selected' : '' }}
                                                value="{{ $city->id }}">
                                                {{ $city->title }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                                @if ($errors->has('city_id'))
                                    <span class="invalid-feedback">{{ $errors->first('city_id') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="position-field">@lang('attributes.position')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="number" min="0" required
                                    class="form-control @if ($errors->has('position')) is-invalid @endif" name="position"
                                    value="{{ old('position', $item->position) ?? '' }}" />
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">{{ $errors->first('position') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="active-field">@lang('attributes.active')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <select class="form-control select2" name="active">
                                    <option value="0" {{ old('active', $item->active) != 1 ? 'selected' : '' }}>
                                        @lang('attributes.draft')
                                    </option>
                                    <option value="1" {{ old('active', $item->active) == 1 ? 'selected' : '' }}>
                                        @lang('attributes.publish')
                                    </option>

                                </select>
                                @if ($errors->has('active'))
                                    <span class="invalid-feedback">{{ $errors->first('active') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>



                    <div class="col-md-12">
                        <hr>
                        <button type="submit" name="action" value="save" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger pull-right text-white" style="float: right;"
                            href="{{ route('admin.areas.index') }}">@lang('common.cancel')
                            <i class="icon-arrow-left-bold"></i>
                        </a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('/panel/js/pages/form-validation.init.js') }}"></script>
@endsection
