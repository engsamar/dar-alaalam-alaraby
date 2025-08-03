@extends('admin.layouts.app')
@section('tab_name', trans('titles.users'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('attributes.edit') . '#' . $item->id : trans('attributes.add'),
        'title' => trans('atitles.users'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        {{ $item->id ? trans('attributes.edit') . '#' . $item->id : trans('attributes.add') }}</h4>
                    <hr>
                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.users.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.users.store') }}" method="POST"
                                enctype='multipart/form-data' novalidate>
                    @endif
                    @csrf

                    <div class="row mb-3">

                        <label class="col-form-label col-lg-2" for="name-field">@lang('attributes.name')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="name" {{ $item->id ? '' : 'required' }}
                                    class="form-control @if ($errors->has('name')) is-invalid @endif" name="name"
                                    value="{{ old('name', $item->name) }}" />

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="email-field">@lang('attributes.E-mail')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="email" required
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
                                <input type="tel" min="10" required
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
                        <label class="col-form-label col-lg-2" for="birth_date-field">@lang('attributes.BirthDate')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="date" {{ $item->id ? '' : 'required' }}
                                    class="form-control @if ($errors->has('birth_date')) is-invalid @endif"
                                    name="birth_date" value="" />
                                @if ($errors->has('birth_date'))
                                    <span class="invalid-feedback">{{ $errors->first('birth_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="password-field">@lang('attributes.password')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="password" {{ $item->id ? '' : 'required' }}
                                    class="form-control @if ($errors->has('password')) is-invalid @endif"
                                    name="password" value="" />
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">

                        <label class="col-form-label col-lg-2" for="password_confirmation-field">@lang('attributes.PasswordConfirmation')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="password" {{ $item->id ? '' : 'required' }}
                                    class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation', $item->password_confirmation) ?? '' }}" />
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="image-field">@lang('attributes.UploadImage')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
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
                            @lang('attributes.Save')
                        </button>

                        <a class="btn btn-danger  {{ $locale == 'en' ? 'float-end' : 'pull-left' }} text-white" style="float:{{ $locale == 'en' ? 'right' : 'left' }} "
                            href="{{ route('admin.users.index') }}">@lang('attributes.Cancel')
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
    <script src="{{ asset('panel/js/validate.js') }}"></script>
    <script src="{{ asset('panel/vendors/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('panel/js/dropify.js') }}"></script>
@endsection
