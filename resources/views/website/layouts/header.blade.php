<div class="top-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <p>{{ $setting->footer ?? '' }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <ul>
                    <li><a href="{{ $setting->facebook ?? '#' }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                    <li><a href="{{ $setting->messenger ?? '#' }}" target="_blank"><i class="fab fa-facebook-messenger"></i></a></li>

                    <li><a href="{{ $setting->map ?? '#' }}" target="_blank"><i class='bx bxs-map'></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
