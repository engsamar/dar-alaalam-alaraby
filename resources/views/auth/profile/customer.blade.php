@extends('auth.layouts.app')
@section('title',__('titles.profile'))

@section('contentDashboard')
    @includeIf('auth.layouts.title',['page' => [
    'title' => __('titles.editProfile'),
    'subTitle' => __('titles.profileWelcome')
    ]])
    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">

        <div class="col-lg-12">
            <form class="form-style1 needs-validation" enctype='multipart/form-data' novalidate
                action="{{ route('website.auth.profile.update',['locale' => $locale]) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-sm-12 col-xl-12">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.name')</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('mobile', auth()->user()->name) }}">
                        </div>
                    </div>


                    <div class="col-sm-6 col-xl-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.email')</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', auth()->user()->email) }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.mobile')</label>
                            <input type="tel" placeholder="971xxxxxxxxx" pattern="971[0-9]{2}[0-9]{3}[0-9]{4}"
                                class="form-control phone" name="mobile" value="{{ old('mobile', auth()->user()->mobile) }}">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="mb10">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.image')</label>
                            <img class="w-100"
                                src="{{ auth()->user() ? imagePath(auth()->user()->image) : asset('images/user.png') }}"
                                alt="">
                            <input type="file" type="file" accept="image/png, image/jpeg, image/webp"class="form-control" name="image" />
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="text-end">
                            <button type="submit" class="ud-btn btn-dark">@lang('titles.editProfile')<i
                                    class="flaticon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
