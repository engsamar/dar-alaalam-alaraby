<div class="top-header-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <p>{{ $setting->footer ?? '' }}</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <ul>
                    <li><a href="{{ $setting->facebook ?? '#' }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                    <li><a href="{{ $setting->twitter ?? '#' }}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="{{ $setting->whatsapp ?? '#' }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                    <li><a href="{{ $setting->snapchat ?? '#' }}" target="_blank"><i class="fa-brands fa-snapchat"></i></a></li>
                    <li><a href="{{ $setting->instagram ?? '#' }}" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                    <li><a href="{{ $setting->tiktok ?? '#' }}" target="_blank"><i class='bx bxl-tiktok'></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
