@extends('admin.layouts.app')
@section('tab_name', trans('titles.notifications'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        {{ $item->id ? trans('titles.edit', ['model' => __('titles.notifications'), 'id' => $item->id]) : trans('titles.create', ['model' => __('titles.notifications')]) }}
                    </h4>
                    <hr>
                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.notifications.update', $item->id) }}"
                            method="POST" enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.notifications.store') }}" method="POST"
                                enctype='multipart/form-data' novalidate>
                    @endif
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2" for="title-field">
                                    {{ ucfirst(__('attributes.title')) }} </label>
                                <div class="col-lg-10">
                                    @if (!empty($locales))
                                        <div class="row">
                                            @foreach ($locales as $Key => $locale)
                                                <div class="form-group col-lg-12">

                                                    <input required id="title_{{ $Key }}-field" type="text"
                                                        class="form-control @if ($errors->has($Key . '[title]')) is-invalid @endif"
                                                        name='{{ 'title' . '[' . $Key . ']' }}' placeholder="{{ strtoupper($Key) }}"
                                                        value="{{ old($Key . '.title', $item->getTranslation('title', $Key)) }}" />
                                                    @if ($errors->has('title' . '[' . $Key . ']'))
                                                        <span
                                                            class="invalid-feedback">{{ $errors->first('title' . '[' . $Key . ']') }}</span>
                                                    @else
                                                        <div class="invalid-feedback">
                                                            @lang('validation.required', [
                                                                'attribute' => strtolower($locale) . '' . trans('attributes.title'),
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
                                <label class="col-form-label col-lg-2" for="message-field">
                                    {{ ucfirst(__('attributes.message')) }} </label>
                                <div class="col-lg-10">

                                    <textarea required id="message-field" class="form-control @if ($errors->has('name')) is-invalid @endif"
                                        name='message' rows="10" placeholder="{{ __('attributes.message') }}">{{ old('message', $item->message) ?? '' }}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback">{{ $errors->first('message') }}</span>
                                    @else
                                        <div class="invalid-feedback">
                                            @lang('validation.required', ['attribute' => trans('attributes.message')])
                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <label class="col-form-label col-lg-2" for="topics-field">@lang('attributes.topics')</label>
                                    <div class="col-lg-10">
                                        <div class="form-group">

                                            <select id="topics-field" class="form-control select2 tagging" multiple="multiple"
                                                name="topics[]">
                                                @if (!empty($result['topics']))

                                                    @foreach ($result['topics'] as $topic)
                                                        <option
                                                            {{ in_array($topic, old('topics', $item->topicIds) ?? []) ? 'selected' : '' }}
                                                            value="{{ $topic }}">
                                                            {{ $topic }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('topics'))
                                                <span class="invalid-feedback">{{ $errors->first('topics') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div  style="margin-bottom: 30px; height: 20px; border-bottom: 1px solid #aaaaaa; text-align: center">
                                        <span style="font-size: 20px; background-color: #F3F5F6; padding: 0 10px;">
                                            OR <!--Padding is optional-->
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-form-label col-lg-2" for="companies-field">@lang('attributes.companies')</label>
                                    <div class="col-lg-10">
                                        <div class="form-group">

                                            <select id="companies-field" class="form-control select2 tagging" multiple="multiple"
                                                name="companies[]">
                                                @if (!empty($result['companies']))

                                                    @foreach ($result['companies'] as $company)
                                                        <option
                                                            {{ in_array($company->id, old('companies', $item->companyIds) ?? []) ? 'selected' : '' }}
                                                            value="{{ $company->id }}">
                                                            {{ $company->name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('companies'))
                                                <span class="invalid-feedback">{{ $errors->first('companies') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label col-lg-2" for="punchers-field">@lang('attributes.punchers')</label>
                                    <div class="col-lg-10">
                                        <div class="form-group">

                                            <select id="punchers-field" class="form-control select2 tagging" multiple="multiple"
                                                name="punchers[]">
                                                @if (!empty($result['punchers']))
                                                    @foreach ($result['punchers'] as $puncher)
                                                        <option
                                                            {{ in_array($puncher->id, old('punchers', $item->puncherIds) ?? []) ? 'selected' : '' }}
                                                            value="{{ $puncher->id }}">
                                                            {{ $puncher->name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('punchers'))
                                                <span class="invalid-feedback">{{ $errors->first('punchers') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label col-lg-2" for="employees-field">@lang('attributes.employees')</label>
                                    <div class="col-lg-10">
                                        <div class="form-group">

                                            <select id="employees-field" class="form-control select2 tagging" multiple="multiple"
                                                name="employees[]">
                                                @if (!empty($result['employees']))
                                                    @foreach ($result['employees'] as $employee)
                                                        <option
                                                            {{ in_array($employee->id, old('employees', $item->employeeIds) ?? []) ? 'selected' : '' }}
                                                            value="{{ $employee->id }}">
                                                            {{ $employee->name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('employees'))
                                                <span class="invalid-feedback">{{ $errors->first('employees') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <label class="col-form-label col-lg-2" for="customers-field">@lang('attributes.customers')</label>
                                    <div class="col-lg-10">
                                        <div class="form-group">

                                            <select id="customers-field" class="form-control select2 tagging" multiple="multiple"
                                                name="customers[]">
                                                @if (!empty($result['customers']))
                                                    @foreach ($result['customers'] as $customer)
                                                        <option
                                                            {{ in_array($customer->id, old('customers', $item->customerIds) ?? []) ? 'selected' : '' }}
                                                            value="{{ $customer->id }}">
                                                            {{ $customer->name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            @if ($errors->has('customers'))
                                                <span class="invalid-feedback">{{ $errors->first('customers') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <button type="submit" class="btn btn-submit me-2">
                            @lang('attributes.save')
                        </button>

                        <a class="btn btn-cancel" href="{{ route('admin.notifications.index') }}">@lang('attributes.cancel')
                            <i class="icon-arrow-left-bold"></i>
                        </a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('panel/js/validate.js') }}"></script>
    <script>
        $(function(){
            $('#topics-field').on('change',function(){
                // 'company','client','puncher','employee'
                let selected = $('#topics-field option:selected').toArray().map(item => item.value);
                if( selected.includes('company')){
                    $('#companies-field').attr('disabled',true);
                }else{
                    $('#companies-field').attr('disabled',false);
                }
                if( selected.includes('puncher')){
                    $('#punchers-field').attr('disabled',true);

                }else{
                    $('#punchers-field').attr('disabled',false);
                }

                if( selected.includes('client')){
                    $('#customers-field').attr('disabled',true);
                }else{
                    $('#customers-field').attr('disabled',false);
                }
                if( selected.includes('employee')){
                    $('#employees-field').attr('disabled',true);

                }else{
                    $('#employees-field').attr('disabled',false);
                }
            })
        })
    </script>
@endsection
