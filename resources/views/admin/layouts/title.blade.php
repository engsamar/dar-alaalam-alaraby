<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $subTitle ?? '' }}
                @if (!empty($count) && $count > 0) <span
                        class="badge badge-danger">{{ $count ?? '0' }}</span> @endif
                @if (!empty($btnUrl))

                    <a href="{{ $btnUrl }}" class="btn btn-success btn-rounded waves-effect waves-light"><i
                            class="mdi mdi-plus"></i>
                    </a>

                @endif

            </h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $title ?? '' }}</a></li>
                    <li class="breadcrumb-item active">{{ $subTitle ?? '' }}</li>
                </ol>
            </div>

        </div>
    </div>
</div>

@if (session()->has('message'))
    {{ session()->get('alret') }}
    <div class="alert {{ 'alert-success' . session()->get('alret') }} alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="btn-close" class="float: right;" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif
