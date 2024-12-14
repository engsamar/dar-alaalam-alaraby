<form action="{{ route('admin.notifications.index') }}" method="GET">
    <div class="row mb-3 mt-2">
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <input type="text" value="{{ request()->search }}" name="search" class="form-control"
                placeholder="@lang('attributes.searchNow')" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <select class="form-control" name="status">
                <option value="">@lang('attributes.active')</option>
                <option {{ request()->input('status') == '1' ? 'selected' : '' }} value="1">
                    @lang('attributes.yes')
                </option>
                <option {{ request()->input('status') == '0' ? 'selected' : '' }} value="0">
                    @lang('attributes.no')
                </option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" value="{{ request()->input('from_date') }}" name="from_date" class="form-control"
                format="YYYY-MM-DD" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" value="{{ request()->input('to_date') }}" name="to_date" class="form-control"
                format="YYYY-MM-DD" />
        </div>

        <div class="col-md-1 col-sm-6 col-xs-12 form-group ">
            <button type="submit" class="btn btn-primary">@lang('attributes.search')</button>
        </div>
    </div>
</form>
