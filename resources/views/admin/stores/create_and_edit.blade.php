@extends('admin.layouts.app')
@section('tab_name', trans('titles.stores'))

@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.stores'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.stores.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.stores.store') }}" method="POST"
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
                        <label class="col-form-label col-lg-2" for="phone-field">@lang('attributes.Mobile')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="tel" min="10" required
                                    class="form-control @if ($errors->has('phone')) is-invalid @endif" name="phone"
                                    value="{{ old('phone', $item->phone) ?? '' }}" />
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="category_id-field">@lang('admin.category')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <select class="form-control select2" name="category_id">
                                    @if (!empty($result['categories']))
                                        @foreach ($result['categories'] as $category)
                                            <option {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}">
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    @endif

                                </select>
                                @if ($errors->has('category_id'))
                                    <span class="invalid-feedback">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="city_id-field">@lang('attributes.city')</label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-6">
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
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <select class="form-control select2" name="area_id">
                                            @if (!empty($result['areas']))
                                                @foreach ($result['areas'] as $area)
                                                    <option {{ old('area_id', $item->area_id) == $area->id ? 'selected' : '' }}
                                                        value="{{ $area->id }}">
                                                        {{ $area->title }}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                        @if ($errors->has('area_id'))
                                            <span class="invalid-feedback">{{ $errors->first('area_id') }}</span>
                                        @endif
                                    </div>
                                </div>
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
                        <label class="col-form-label col-lg-2" for="address-field">
                            {{ ucfirst(__('attributes.address')) }} </label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <div id="mapCanv" style="width:100%;height:400px"></div>
                                <input type="hidden" class="locationId" name="latitude" id="latitude" />
                                <input type="hidden" class="locationId" name="longitude" id="longitude" />

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="address-field">
                            {{ ucfirst(__('attributes.address')) }} </label>
                        <div class="col-lg-10">
                            @if (!empty($locales))
                                <div class="row">
                                    @foreach ($locales as $Key => $locale)
                                        <div class="form-group col-lg-6">

                                            <textarea rows="10" id="address_{{ $Key }}-field"
                                                class="form-control @if ($errors->has($Key . '[address]')) is-invalid @endif" name='{{ 'address' . '[' . $Key . ']' }}'
                                                placeholder="{{ strtoupper($Key) }}">{{ old($Key . '.address', $item->getTranslation('address', $Key)) }}</textarea>

                                            @if ($errors->has('address' . '[' . $Key . ']'))
                                                <span
                                                    class="invalid-feedback">{{ $errors->first('address' . '[' . $Key . ']') }}</span>
                                            @else
                                                <div class="invalid-feedback">
                                                    @lang('validation.required', [
                                                        'attribute' => strtolower($locale) . '' . trans('attributes.address'),
                                                    ])
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

                            @endif
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

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="logo-field">@lang('attributes.UploadLogo')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <input type="file" name="logo" accept="image/png, image/jpeg, image/jpg"
                                    data-default-file="{{ old('logo', $item->logo) }}" class="dropify" id="logo-field">
                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback">{{ $errors->first('logo') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <button type="submit" name="action" value="save" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger  {{ $locale == 'en' ? 'pull-right' : 'pull-left' }} text-white" style="float:{{ $locale == 'en' ? 'right' : 'left' }} "
                            href="{{ route('admin.stores.index') }}">@lang('common.cancel')
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
    {{-- <script src="{{ asset('panel/js/pages/form-validation.init.js') }}"></script> --}}
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANawENQz-ldZ29ArqqN-VcXBM2pXyp5oI&language=ar">
    </script>
    <script type="text/javascript">
        let map, marker;

        function initialise() {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById("latitude").value = position.coords.latitude;
                document.getElementById("longitude").value = position.coords.longitude;
                var latitude = position.coords.latitude;

                var longitude = position.coords.longitude;
                console.log(position.coords)
                var mapCanvas = document.getElementById("mapCanv");

                var myCenter = new google.maps.LatLng(latitude, longitude);
                var mapOptions = {
                    center: myCenter,
                    zoom: 14
                };
                map = new google.maps.Map(mapCanvas, mapOptions);
                marker = new google.maps.Marker({
                    position: myCenter,
                    draggable: true,
                });
                marker.setMap(map);
                geocodePosition(marker.getPosition());
                new google.maps.event.addListener(marker, 'dragend', function() {

                    geocodePosition(marker.getPosition());
                    $("#latitude").val(this.getPosition().lat());
                    $("#longitude").val(this.getPosition().lng());

                });

            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
            //var geoloccontrol = new klokantech.GeolocationControl(map, 20);

        }
        $(".locationId").bind('change paste keyup', function() {
            var latitude = document.getElementById("latitude").value;

            var longitude = document.getElementById("longitude").value;
            var latLng = new google.maps.LatLng(latitude, longitude);
            map.setCenter(latLng);
            marker.setPosition(latLng);

        })
        google.maps.event.addDomListener(window, 'load', initialise);


        function geocodePosition(pos) {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                latLng: pos

            }, function(responses) {
                if (responses && responses.length > 0) {
                    $("#address_ar-field").val(responses[0].formatted_address);
                }
            });
        }
    </script>
@endsection
