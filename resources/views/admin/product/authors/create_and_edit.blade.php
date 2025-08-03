@extends('admin.layouts.app')
@section('tab_name', trans('titles.authors'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.authors'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.authors.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.authors.store') }}" method="POST"
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
{{--
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="city_id-field">@lang('attributes.city')</label>
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

                    </div> --}}

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="email-field">@lang('attributes.E-mail')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="email"
                                    class="form-control @if ($errors->has('email')) is-invalid @endif" name="email"
                                    value="{{ old('email', $item->email) ?? '' }}" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="mobile-field">@lang('attributes.Mobile')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="tel" min="10"
                                    class="form-control @if ($errors->has('mobile')) is-invalid @endif" name="mobile"
                                    value="{{ old('mobile', $item->mobile) ?? '' }}" />
                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="gender-field">@lang('attributes.Gender')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <select class="form-control select2" name="gender">
                                    <option value="male" {{ old('gender', $item->gender) ? '' : 'selected' }}>
                                        @lang('attributes.Male')</option>
                                    <option value="female" {{ old('gender', $item->gender) ? '' : 'selected' }}>
                                        @lang('attributes.Female')</option>

                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback">{{ $errors->first('gender') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="country_id-field">@lang('attributes.country')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <select class="form-control select2" name="country_id">
                                    @if (!empty($result['countries']))
                                        @foreach ($result['countries'] as $country)
                                            <option {{ old('country_id', $item->country_id) == $country->id ? 'selected' : '' }}
                                                value="{{ $country->id }}">
                                                {{ $country->title }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                                @if ($errors->has('country_id'))
                                    <span class="invalid-feedback">{{ $errors->first('country_id') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>


                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="city_id-field">@lang('attributes.city')</label>
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
                        <button type="submit" name="action" value="save" style="width:150px" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger  {{ $locale == 'en' ? 'float-end' : 'pull-left' }} text-white" style="float:{{ $locale == 'en' ? 'right' : 'left' }} "
                            href="{{ route('admin.authors.index') }}">@lang('common.cancel')
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
