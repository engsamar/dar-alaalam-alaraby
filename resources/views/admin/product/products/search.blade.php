<form action="{{ route('admin.products.index') }}" method="GET">
    <div class="row mb-3 mt-2">
        <div class="col-md-3 col-sm-6 col-xs-12 form-group">
            <input type="text" name="search" class="form-control" placeholder="@lang('common.searchNow')" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <select class="form-control" name="status">
                <option value="">@lang('common.active')</option>
                <option {{ request()->status == '1' ? 'selected' : '' }} value="1">@lang('common.yes')
                </option>
                <option {{ request()->status == '0' ? 'selected' : '' }} value="0">@lang('common.no')
                </option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" name="from_date" class="form-control" format="YYYY-MM-DD" />
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12 form-group">
            <input type="date" name="to_date" class="form-control" format="YYYY-MM-DD" />
        </div>

        <div class="col-md-1 col-sm-6 col-xs-12 form-group ">
            <button type="submit" class="btn btn-primary">@lang('common.search')</button>
        </div>
    </div>
</form>
