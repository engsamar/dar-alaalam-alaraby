<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())

                </script> © {{ ! empty($setting ) ? $setting->title : '' }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by {{ ! empty($setting ) ? $setting->title : '' }}
                </div>
            </div>
        </div>
    </div>
</footer>
