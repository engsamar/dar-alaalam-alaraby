@extends('auth.layouts.app')
@section('title',__('titles.myAddresses'))

@section('contentDashboard')
    @includeIf('auth.layouts.title',['page' => [
    'title' => $result['item']->id > 0 ? __('titles.updateAddress') : __('titles.addNewAddress'),
    'subTitle' => __('titles.profileWelcome')
    ]])

    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
        <div class="col-lg-12">
            <form class="form-style1 needs-validation"
                action="{{ $result['item']->id > 0 ? route('website.auth.addresses.update', ['address'=> $result['item'],'locale'=>$locale]) : route('website.auth.addresses.store',['locale'=>$locale]) }}"
                method="post" novalidate enctype='multipart/form-data'>
                @csrf
                @if ($result['item']->id > 0)
                    @method('put')
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.addressTitle')</label>
                            <input required type="text" name="title" value="{{ old('title', $result['item']->title) ?? 'المنزل' }}"
                                class="form-control" placeholder="@lang('attributes.addressTitle')">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.title') ])
                                </div>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-6 col-xl-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.city')</label>
                            <div class="location-area">
                                <div class=" bootstrap-select show-tick">
                                    <select class="selectpicker form-control" name="city_id">
                                        @if (!empty($result['cities']))
                                            @foreach ($result['cities'] as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ old('city_id', $result['item']->city_id) == $city->id ? 'selected' : '' }}>
                                                    {{ $city->title }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.street')</label>
                            <input required type="text" name="street" value="{{ old('street', $result['item']->street) }}"
                                class="form-control" placeholder="@lang('attributes.street')">
                            @if ($errors->has('street'))
                                <span class="invalid-feedback">{{ $errors->first('street') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.street') ])
                                </div>
                            @endif
                        </div>
                    </div>

                     <div class="col-sm-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.building_number')</label>
                            <input required type="number" min="1" step="1" name="building_number" value="{{ old('building_number', $result['item']->building_number) }}"
                                class="form-control" placeholder="@lang('attributes.building_number')">
                            @if ($errors->has('building_number'))
                                <span class="invalid-feedback">{{ $errors->first('building_number') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.building_number') ])
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.floor_number')</label>
                            <input required type="number" min="1" step="1" name="floor_number" value="{{ old('floor_number', $result['item']->floor_number) }}"
                                class="form-control" placeholder="@lang('attributes.floor_number')">
                            @if ($errors->has('floor_number'))
                                <span class="invalid-feedback">{{ $errors->first('floor_number') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.floor_number') ])
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.address')</label>
                            <input required type="text" name="title" value="{{ old('title', $result['item']->title) ?? 'المنزل' }}"
                                class="form-control" placeholder="@lang('attributes.address')">
                            @if ($errors->has('title'))
                                <span class="invalid-feedback">{{ $errors->first('title') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.title') ])
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-12">
                        <div class="mb20">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.address')</label>
                            <textarea rows="10" required name="address" id="address"
                                class="form-control"
                                placeholder="@lang('attributes.address')">{{ old('address', $result['item']->address) }}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">{{ $errors->first('address') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.address') ])
                                </div>
                            @endif
                        </div>
                    </div>

{{--
                    <div class="col-sm-6 col-xl-6">
                        <div class="mb30">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.latitude')</label>
                            <input required type="text" name="latitude" id="latitude"
                                value="{{ old('latitude', $result['item']->latitude) ?? '23.8859' }}" class="form-control locatinId"
                                placeholder="@lang('attributes.latitude')">
                            @if ($errors->has('latitude'))
                                <span class="invalid-feedback">{{ $errors->first('latitude') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.latitude') ])
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="mb30">
                            <label class="heading-color ff-heading fw600 mb10">@lang('attributes.longitude')</label>
                            <input required type="text"  name="longitude" id="longitude"
                                value="{{ old('longitude', $result['item']->longitude) ?? '45.0792'}}" class="form-control locatinId"
                                placeholder="@lang('attributes.longitude')">
                            @if ($errors->has('longitude'))
                                <span class="invalid-feedback">{{ $errors->first('longitude') }}</span>
                            @else
                                <div class="invalid-feedback">@lang('validation.required',['attribute' =>
                                    __('attributes.longitude') ])
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div id="mapCanv" style="width:100%;height:400px"></div>
                    </div> --}}
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="text-end">
                            <button type="submit" class="ud-btn btn-dark">
                                @if ($result['item']->id > 0)
                                    @lang('titles.updateAddress')
                                @else
                                    @lang('titles.addNewAddress')
                                @endif
                                <i class="flaticon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANawENQz-ldZ29ArqqN-VcXBM2pXyp5oI&language=ar">
    </script>
    <script type="text/javascript">
        $(".locatinId").bind('change paste keyup', function() {
            initialise();
        })

        function initialise() {
            var mapCanvas = document.getElementById("mapCanv");
            var latitude = document.getElementById("latitude").value;
            var longitude = document.getElementById("longitude").value;
            var myCenter = new google.maps.LatLng(latitude, longitude);
            var mapOptions = {
                center: myCenter,
                zoom: 14
            };
            var map = new google.maps.Map(mapCanvas, mapOptions);
            var marker = new google.maps.Marker({
                position: myCenter,
                draggable: true,
            });
            marker.setMap(map);
            geocodePosition(marker.getPosition());
            geocodePositionEN(marker.getPosition());
            new google.maps.event.addListener(marker, 'dragend', function() {

                geocodePosition(marker.getPosition());
                $("#latitude").val(this.getPosition().lat());
                $("#longitude").val(this.getPosition().lng());

            });
            //var geoloccontrol = new klokantech.GeolocationControl(map, 20);
        }
        google.maps.event.addDomListener(window, 'load', initialise);

        function geocodePosition(pos) {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                latLng: pos

            }, function(responses) {
                if (responses && responses.length > 0) {
                    //   updateMarkerAddress(responses[0].formatted_address);
                    $("#address").val(responses[0].formatted_address);
                } else {
                    // updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }

        function geocodePositionEN(pos) {
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                latLng: pos
            }, function(responses) {
                if (responses && responses.length > 0) {
                    //   updateMarkerAddress(responses[0].formatted_address);
                    $("#address").val(responses[0].formatted_address);
                } else {
                    // updateMarkerAddress('Cannot determine address at this location.');
                }
            });
        }

    </script>

    <script src="{{ asset('assets/js/validate.js') }}"></script>
@endsection
