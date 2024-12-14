<div class="row mb-3" id="{{ 'product_item_' . $index }}">

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-2">
                <div class="form-group">
                    <select required class="form-control select2 sizes" name="{{ 'sizes[' . $index . '][size_id]' }}">
                        @if (!empty($result['sizes']))
                            @foreach ($result['sizes'] as $sizeItem)
                                <option {{ old('sizes[' . $index . '][size_id]',$productSetting->size_id ) == $sizeItem->id ? 'selected' : '' }}
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
                    <select required class="form-control select2 sizes" multiple name="{{ 'sizes[' . $index . '][color_id][]' }}">
                        @if (!empty($result['colors']))
                            @foreach ($result['colors'] as $colorItem)
                                <option {{ in_array($colorItem->id, old('sizes[' . $index . '][color_id]', $productSetting->color_ids ?? [] )) ? 'selected' : '' }}
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
                    <input type="number" min="1" step="1" required placeholder="{{ __('attributes.quantity') }}"
                        class="form-control @if ($errors->has('quantity')) is-invalid @endif"
                        name="{{ 'sizes[' . $index . '][quantity]' }}" value="{{ old('sizes[' . $index . '][quantity]',$productSetting->quantity ) }}" />
                    @if ($errors->has('quantity'))
                        <span class="invalid-feedback">{{ $errors->first('quantity') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <input type="number" min="0" step="any" placeholder="{{ __('attributes.weight') }}"
                        class="form-control @if ($errors->has('weight')) is-invalid @endif"
                        name="{{ 'sizes[' . $index . '][weight]' }}" value="{{ old('sizes[' . $index . '][weight]',$productSetting->weight ) }}" />
                    @if ($errors->has('weight'))
                        <span class="invalid-feedback">{{ $errors->first('weight') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <input type="number" min="0" step="any" required placeholder="{{ __('attributes.price') }}"
                        class="form-control @if ($errors->has('price')) is-invalid @endif"
                        name="{{ 'sizes[' . $index . '][price]' }}" value="{{ old('sizes[' . $index . '][price]',$productSetting->price ) }}" />
                    @if ($errors->has('price'))
                        <span class="invalid-feedback">{{ $errors->first('price') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-1">
                <button type="button" data-index="{{ $index }}" class="btn btn-primary remove">-</button>
            </div>
        </div>

    </div>
</div>
<script>
    $('.select2').select2();
</script>
