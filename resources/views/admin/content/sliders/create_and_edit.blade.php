@extends('admin.layouts.app')
@section('tab_name', trans('titles.sliders'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.sliders'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.sliders.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.sliders.store') }}" method="POST"
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
                                                    'attribute' =>
                                                        strtolower($locale) .
                                                        '' .
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

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="type-field">@lang('attributes.type')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <select class="form-control select2" name="type">
                                    <option value="{{ \App\Helpers\Constants::FULL_BANNER }}" {{ old('type', $item->type) == \App\Helpers\Constants::FULL_BANNER ? 'selected' : '' }}>
                                        @lang('attributes.full_banner')</option>
                                    <option value="{{ \App\Helpers\Constants::TWO_BANNER }}" {{ old('type', $item->type) == \App\Helpers\Constants::TWO_BANNER ? 'selected' : '' }}>
                                        @lang('attributes.two_banner')</option>

                                    <option value="{{ \App\Helpers\Constants::THREE_BANNER }}" {{ old('type', $item->type) == \App\Helpers\Constants::THREE_BANNER ? 'selected' : '' }}>
                                        @lang('attributes.three_banner')</option>
                                    <option value="{{ \App\Helpers\Constants::SLIDER_BANNER }}" {{ old('type', $item->type) == \App\Helpers\Constants::SLIDER_BANNER ? 'selected' : '' }}>
                                        @lang('attributes.slider_banner')</option>

                                </select>
                                @if ($errors->has('type'))
                                    <span class="invalid-feedback">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    @if (!empty($locales))
                        @foreach ($locales as $Key => $locale)
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2" for="image_{{ $Key }}-field">
                                    @lang('admin.Image')
                                    {{ strtoupper($Key) }}
                                </label>

                                <div class="col-lg-10">
                                    <div class="form-group ">
                                        <img width="100px" height="100px" alt="image"
                                        src="{{ imagePath($item->getTranslation('image', $Key)) ?? '' }}" />
                                        <input id="image_{{ $Key }}-field"
                                            type="file"
                                            class="form-control dropify @if ($errors->has('image' . '[' . $Key . ']')) is-invalid @endif"
                                            name='{{ 'image' . '[' . $Key . ']' }}' />
                                        @if ($errors->has('image' . '[' . $Key . ']'))
                                            <span
                                                class="invalid-feedback">{{ $errors->first('image' . '[' . $Key . ']') }}</span>
                                        @else
                                            <div class="invalid-feedback">please add
                                                {{ strtolower($locale) }}  image
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="col-md-12">
                        <hr>
                        <button type="submit" name="action" value="save" style="width:150px" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger  {{ $locale == 'en' ? 'float-end' : 'pull-left' }} text-white" style="float:{{ $locale == 'en' ? 'right' : 'left' }} "
                            href="{{ route('admin.sliders.index') }}">@lang('common.cancel')
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
    <script src="{{ asset('panel/js/pages/form-validation.init.js') }}"></script>
    <script>
        $("#title_en-field").on('keyup', function() {
            $("#title_ar-field").val($(this).val())
        });
    </script>
@endsection
