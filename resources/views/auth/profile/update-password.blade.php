@extends('auth.layouts.app')
@section('title',__('titles.editPassword'))

@section('contentDashboard')
    @includeIf('auth.layouts.title',['page' => [
    'title' => __('titles.editPassword'),
    'subTitle' => __('titles.profileWelcome')
    ]])
    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">

        <div class="col-lg-12">
            <form class="form-style1">
                <div class="row">
                    <div class="col-sm-6 col-xl-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.password')</label>
                            <input type="password" name="password" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-6">
                        <div class="mb20">
                            <label
                                class="heading-color ff-heading fw600 mb10">@lang('attributes.PasswordConfirmation')</label>
                            <input type="text" name="password_confirmation" class="form-control" value="">
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="text-end">
                            <button type="submit" class="ud-btn btn-dark">@lang('titles.editPassword')<i
                                    class="flaticon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
