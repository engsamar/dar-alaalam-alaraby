@extends('admin.layouts.app')
@section('tab_name', trans('titles.coupons'))
@section('css')
    <link rel="stylesheet" href="{{ asset('/panel/vendors/dropify/dropify.min.css') }}">
@endsection
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.coupons'),
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
                        <form class="needs-validation" action="{{ route('admin.coupons.update', $item->id) }}"
                            method="POST" enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.coupons.store') }}" method="POST"
                                enctype='multipart/form-data' novalidate>
                    @endif
                    @csrf

                    @if (!empty($locales))
                        @foreach ($locales as $Key => $locale)
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2" for="title_{{ $Key }}-field">
                                    @lang('attributes.title')
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
                                                    'attribute' => strtolower($locale) .'' .trans('attributes.title'),
                                                ])
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="code-field">
                            {{ ucfirst(__('attributes.code')) . ' / ' . ucfirst(__('attributes.no_usage')) }}</label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" minlength="4" required
                                            class="form-control @if ($errors->has('code')) is-invalid @endif"
                                            name="code" value="{{ old('code', $item->code) }}" />
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('code') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" step="1" min="0" required
                                            class="form-control @if ($errors->has('maximum_usage')) is-invalid @endif"
                                            placeholder="@lang('attributes.no_usage')" name="maximum_usage"
                                            value="{{ old('maximum_usage', $item->maximum_usage) }}" />

                                        @if ($errors->has('maximum_usage'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('maximum_usage') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="discount-field">
                            {{ ucfirst(__('attributes.discount')) }}
                        </label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="number" min="0" required
                                            class="form-control @if ($errors->has('discount')) is-invalid @endif"
                                            name="discount" value="{{ old('discount', $item->discount) ?? '0' }}" />
                                        @if ($errors->has('discount'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('discount') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select class="form-control select2" name="coupon_type">
                                            <option value="{{ \App\Helpers\Constants::PERCENT_TYPE }}"
                                                {{ old('coupon_type', $item->coupon_type) == \App\Helpers\Constants::PERCENT_TYPE ? 'selected' : '' }}>
                                                @lang('attributes.percent')
                                            </option>
                                            <option value="{{ \App\Helpers\Constants::AMOUNT_TYPE }}"
                                                {{ old('coupon_type', $item->coupon_type) == \App\Helpers\Constants::AMOUNT_TYPE ? 'selected' : '' }}>
                                                @lang('attributes.value')
                                            </option>

                                        </select>
                                        @if ($errors->has('coupon_type'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('coupon_type') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="started_at-field">
                            {{ ucfirst(__('attributes.started_at')) . ' / ' . ucfirst(__('attributes.expired_at')) }}
                        </label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="date" min="{{ date('Y-m-d') }}" required
                                            class="form-control @if ($errors->has('started_at')) is-invalid @endif"
                                            name="started_at"
                                            value="{{ old('started_at', date('Y-m-d', strtotime($item->started_at ?? now()))) }}" />
                                        @if ($errors->has('started_at'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('started_at') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="date" min="{{ date('Y-m-d') }}" required
                                            class="form-control @if ($errors->has('expired_at')) is-invalid @endif"
                                            placeholder="@lang('attributes.expired_at')" name="expired_at"
                                            value="{{ old('expired_at', date('Y-m-d', strtotime($item->expired_at ?? now()))) }}" />

                                        @if ($errors->has('expired_at'))
                                            <span class="invalid-feedback">
                                                {{ $errors->first('expired_at') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="position-field">@lang('attributes.position')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="number" min="0" required
                                    class="form-control @if ($errors->has('position')) is-invalid @endif" name="position"
                                    value="{{ old('position', $item->position) ?? '0' }}" />
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

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="image-field">@lang('attributes.UploadImage')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <div class="mb-3"><img src="{{ imagePath($item->image) ?? '' }}" width="100px"></div>
                                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg"
                                    data-default-file="{{ old('image', $item->image) }}" class="dropify" id="image-field">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">{{ $errors->first('image') }}</span>
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
                            href="{{ route('admin.coupons.index') }}">@lang('common.cancel')
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
