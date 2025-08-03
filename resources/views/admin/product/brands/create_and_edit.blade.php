@extends('admin.layouts.app')
@section('tab_name', trans('titles.brands'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.brands'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.brands.update', $item->id) }}"
                            method="POST" enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.brands.store') }}" method="POST"
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
                        <button type="submit" name="action" value="save" style="width:150px" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger  {{ $locale == 'en' ? 'float-end' : 'pull-left' }} text-white" style="float:{{ $locale == 'en' ? 'right' : 'left' }} "
                            href="{{ route('admin.brands.index') }}">@lang('common.cancel')
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
@endsection
