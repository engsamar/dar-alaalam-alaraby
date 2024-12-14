<div class="row align-items-center pb40">
    <div class="row align-items-center pb10">
        <div class="{{ isset($page['searchable']) && $page['searchable'] == true ? 'col-lg-5' : 'col-lg-12' }}">
            <div class="dashboard_title_area">
                <h2>{{ $page['title'] ?? '' }}
                    @if ( isset($page['count']))
                        <span class="pending-style style3">
                            {{ $page['count'] ?? '0' }}
                        </span>
                    @endif
                </h2>


                {{-- <p class="text">{{ $page['subTitle'] ?? '' }}</p> --}}
            </div>
        </div>
        @if (isset($page['searchable']) && $page['searchable'] == true)
            <div class="col-xxl-7">
                <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
                    <div class="item1 mb15-sm">
                        {{-- <div class="search_area">
                            <input type="text" class="form-control bdrs12" placeholder="Search">
                            <label><span class="flaticon-search"></span></label>
                        </div> --}}
                    </div>

                    <a href="{{ $page['createBtn'] ?? '#' }}" class="ud-btn btn-thm">
                        {{ $page['btnTitle'] ?? '' }} <i class="fa fa-arrow-right-long"></i>
                    </a>
                </div>
            </div>

        @endif
        {{-- <hr /> --}}
    </div>
</div>
