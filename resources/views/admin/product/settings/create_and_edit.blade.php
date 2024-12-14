@extends('admin.layouts.app')
@section('tab_name', trans('titles.product-settings'))
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        {{ $item->id ? trans('titles.edit', ['model' => __('titles.product-settings'), 'id' => $item->id]) : trans('titles.create', ['model' => __('titles.product-settings')]) }}
                    </h4>
                    <hr>
                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.product-settings.update', $item->id) }}"
                            method="POST" enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                    @else
                        <form class="needs-validation" action="{{ route('admin.product-settings.store') }}" method="POST"
                            enctype='multipart/form-data' novalidate>

                    @endif
                    @csrf
                    <div class="items">
                        <div class="row mb-3">
                            <input value="{{ old('no_items', count($item->sizes)) ?? '1' }}" type="hidden"
                                    name="no_items" id="no_items" />

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-2">

                                        <div class="form-group">
                                            <label>@lang('attributes.size')</label>
                                            <select required class="form-control sizes select2" name="sizes[0][size_id]">
                                                @if (!empty($result['sizes']))
                                                    @foreach ($result['sizes'] as $sizeItem)
                                                        <option {{  old('sizes[0][size_id]', ! empty($item->sizes) && ! empty($item->sizes[0]) ? $item->sizes[0]->size_id : '' )  == $sizeItem->id ? 'selected' : '' }}
                                                            value="{{ $sizeItem->id }}">
                                                            {{ $sizeItem->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-lg-3">

                                        <div class="form-group">
                                            <label>@lang('attributes.color')</label>

                                            <select required class="form-control sizes select2" name="sizes[0][color_id][]" multiple>
                                                @if (!empty($result['colors']))
                                                    @foreach ($result['colors'] as $colorItem)
                                                        <option {{  in_array($colorItem->id, old('sizes[0][color_id]', ! empty($item->sizes) && ! empty($item->sizes[0]) ? $item->sizes[0]->color_ids : [] ) ?? [] ) ? 'selected' : '' }}
                                                            value="{{ $colorItem->id }}">
                                                            {{ $colorItem->title }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>@lang('attributes.quantity')</label>

                                            <input type="number" min="1" step="1" required placeholder="{{ __('attributes.quantity') }}"
                                                class="form-control @if ($errors->has('quantity')) is-invalid @endif"
                                                name="sizes[0][quantity]" value="{{ old('sizes[0][quantity]', $item->sizes[0]->quantity ?? '') }}" />
                                            @if ($errors->has('quantity'))
                                                <span class="invalid-feedback">{{ $errors->first('quantity') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>@lang('attributes.weight')</label>

                                            <input type="number" min="0" step="any" required placeholder="{{ __('attributes.weight') }}"
                                                class="form-control @if ($errors->has('weight')) is-invalid @endif"
                                                name="sizes[0][weight]" value="{{ old('sizes[0][weight]', $item->sizes[0]->weight ?? '') }}" />
                                            @if ($errors->has('weight'))
                                                <span class="invalid-feedback">{{ $errors->first('weight') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>@lang('attributes.price')</label>

                                            <input type="number" min="0" step="any" required placeholder="{{ __('attributes.price') }}"
                                                class="form-control @if ($errors->has('price')) is-invalid @endif"
                                                name="sizes[0][price]" value="{{ old('sizes[0][price]', $item->sizes[0]->price ?? '') }}" />
                                            @if ($errors->has('price'))
                                                <span class="invalid-feedback">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">


                                        <button type="button" id="addItem" class="btn btn-success" style="margin-top: 25px">+</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @for ($i = 1; $i < count($item->sizes); $i++)
                            @if ( ! empty($item->sizes[$i]) )

                                @includeIf('admin.product.settings.items',['index' => $i+1,'productSetting' => $item->sizes[$i]]  )
                            @endif
                        @endfor
                    </div>

                    <div class="col-md-12">
                        <hr>
                        <button type="submit" name="action" value="save" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger pull-right text-white" style="float: right;"
                            href="{{ route('admin.sizes.index') }}">@lang('common.cancel')
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
    <script src="{{ asset('/panel/js/validate.js') }}"></script>
    <script>
        $(function() {

            $('#addItem').on('click', function() {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('admin.product-settings.add-item') }}" + "?index=" + parseInt($(
                        "#no_items").val()),
                    success: function(data) {
                        $(".items").append(data);
                        $("#no_items").val(parseInt($("#no_items").val()) + 1);
                    }
                });
            });

            $('body').on('click', '.remove', function() {
                var id = $(this).attr('data-index');
                // Remove <div> with id
                $("#product_item_" + id).remove();
                $("#no_items").val(parseInt($("#no_items").val()) - 1);

            });
        })
    </script>
@endsection
