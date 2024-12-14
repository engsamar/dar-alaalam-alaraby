@extends('admin.layouts.app')
@section('tab_name', trans('titles.products'))
@section('css')
    <link rel="stylesheet" href="{{ asset('/panel/vendors/dropify/dropify.min.css') }}">
@endsection
@section('content')
    @include('admin.layouts.title', [
        'subTitle' => $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add'),
        'title' => trans('titles.products'),
    ])

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">
                        {{ $item->id ? trans('common.edit') . '#' . $item->id : trans('common.add') }}
                    </h4>
                    <hr>
                    @if ($item->id)
                        <form class="needs-validation" action="{{ route('admin.products.update', $item->id) }}" method="POST"
                            enctype='multipart/form-data' novalidate>
                            <input type="hidden" name="_method" value="PUT">
                        @else
                            <form class="needs-validation" action="{{ route('admin.products.store') }}" method="POST"
                                enctype='multipart/form-data' novalidate>
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                    @if (!empty($locales))
                        @foreach ($locales as $Key => $locale)
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2" for="title_{{ $Key }}-field">
                                    @lang('attributes.title')
                                    {{ strtoupper($Key) }} </label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <input required id="title_{{ $Key }}-field" type="text"
                                            class="form-control @if ($errors->has($Key . '[title]')) is-invalid @endif"
                                            name='{{ 'title' . '[' . $Key . ']' }}'
                                            value="{{ $item->getTranslation('title', $Key) ?? old($Key . '.title') }}" />
                                        @if ($errors->has('title' . '[' . $Key . ']'))
                                            <span
                                                class="invalid-feedback">{{ $errors->first('title' . '[' . $Key . ']') }}</span>
                                        @else
                                            <div class="invalid-feedback">
                                                @lang('validation.required', [
                                                    'attribute' =>
                                                        strtolower($locale) .
                                                        '' .
                                                        trans('attributes.title'),
                                                ])
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                    @if (!empty($locales))
                        @foreach ($locales as $Key => $locale)
                            <div class="row mb-3">
                                <label class="col-form-label col-lg-2" for="description_{{ $Key }}-field">
                                    @lang('attributes.description')
                                    {{ strtoupper($Key) }} </label>
                                <div class="col-lg-10">
                                    <div class="form-group">
                                        <textarea rows="15" required id="description_{{ $Key }}-field" type="text"
                                            class="form-control tinyMceExample @if ($errors->has('description' . '[' . $Key . ']')) is-invalid @endif"
                                            name='{{ 'description' . '[' . $Key . ']' }}'>{{ $item->getTranslation('description', $Key) ?? old($Key . '.description') }}</textarea>
                                        @if ($errors->has('description' . '[' . $Key . ']'))
                                            <span
                                                class="invalid-feedback">{{ $errors->first('description' . '[' . $Key . ']') }}
                                            </span>
                                        @else
                                            <div class="invalid-feedback">
                                                @lang('validation.required', [
                                                    'attribute' =>
                                                        strtolower($locale) .'' .
                                                        trans('attributes.description'),
                                                ])
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="image-field">@lang('attributes.UploadImage')</label>
                        <div class="col-lg-10">
                            <div class="form-group">
                                <img style="max-width:100px;max-height:100px" src="{{ old('image', $item->image ? imagePath($item->image) : '') }}" />
                                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/webp"
                                    data-default-file="{{ old('image', $item->image ? imagePath($item->image) : '') }}" class="dropify" id="image-field">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-form-label col-lg-2" for="document-dropzone">@lang('attributes.images')</label>
                        <div class="col-lg-10">
                            <div class="col-sm-12 ">
                                <div class="needsclick dropzone" id="document-dropzone">
                                    <div class="fallback">
                                        <input name="document[]" type="file" multiple="multiple">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                        </div>

                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-5">
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="store_id-field">@lang('admin.store')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select class="form-control select2" name="store_id">
                                        @if (!empty($result['stores']))
                                            @foreach ($result['stores'] as $store)
                                                <option {{ old('store_id', $item->store_id) == $store->id ? 'selected' : '' }}
                                                    value="{{ $store->id }}">
                                                    {{ $store->title }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @if ($errors->has('store_id'))
                                        <span class="invalid-feedback">{{ $errors->first('store_id') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="category_id-field">@lang('admin.category')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select id="category" class="form-control select2" name="category_id">
                                        @if (!empty($result['categories']))
                                            @foreach ($result['categories'] as $category)
                                                <option {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}
                                                    value="{{ $category->id }}">
                                                    {{ $category->title }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="sub_category_id-field">@lang('attributes.sub_category')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select id="sub_category" class="form-control select2" name="sub_category_id">
                                        @if (!empty($result['sub_categories']))
                                            @foreach ($result['sub_categories'] as $sub_category)
                                                <option {{ old('sub_category_id', $item->sub_category_id) == $sub_category->id ? 'selected' : '' }}
                                                    value="{{ $sub_category->id }}">
                                                    {{ $sub_category->title }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @if ($errors->has('sub_category_id'))
                                        <span class="invalid-feedback">{{ $errors->first('sub_category_id') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="tag_id-field">@lang('admin.tag')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select class="form-control select2" name="tag_id" multiple>
                                        @if (!empty($result['tags']))
                                            @foreach ($result['tags'] as $tag)
                                                <option {{ old('tag_id', $item->tag_id) == $tag->id ? 'selected' : '' }}
                                                    value="{{ $tag->id }}">
                                                    {{ $tag->title }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @if ($errors->has('tag_id'))
                                        <span class="invalid-feedback">{{ $errors->first('tag_id') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="price-field">@lang('attributes.price')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input type="number" min="0" required
                                        class="form-control @if ($errors->has('price')) is-invalid @endif" name="price"
                                        value="{{ old('price', $item->price) ?? '' }}" />
                                    @if ($errors->has('price'))
                                        <span class="invalid-feedback">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="discount-field">@lang('attributes.discount')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input type="number" min="0"
                                        class="form-control @if ($errors->has('discount')) is-invalid @endif" name="discount"
                                        value="{{ old('discount', $item->discount) ?? '' }}" />
                                    @if ($errors->has('discount'))
                                        <span class="invalid-feedback">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="position-field">@lang('attributes.position')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input type="number" min="0" required
                                        class="form-control @if ($errors->has('position')) is-invalid @endif" name="position"
                                        value="{{ old('position', $item->position) ?? '' }}" />
                                    @if ($errors->has('position'))
                                        <span class="invalid-feedback">{{ $errors->first('position') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="active-field">@lang('attributes.active')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select class="form-control select2" name="active">
                                        <option value="0" {{ old('active', $item->active) != 1 ? 'selected' : '' }}>
                                            @lang('attributes.draft')
                                        </option>
                                        <option value="1" {{ old('active', $item->active) == 1 ? 'selected' : '' }}>
                                            @lang('attributes.publish')
                                        </option>

                                    </select>
                                    @if ($errors->has('active'))
                                        <span class="invalid-feedback">{{ $errors->first('active') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="in_top_selling-field">@lang('attributes.in_top_selling')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select class="form-control select2" name="in_top_selling">
                                        <option value="0" {{ old('in_top_selling', $item->in_top_selling) != 1 ? 'selected' : '' }}>
                                            @lang('attributes.draft')
                                        </option>
                                        <option value="1" {{ old('in_top_selling', $item->in_top_selling) == 1 ? 'selected' : '' }}>
                                            @lang('attributes.publish')
                                        </option>

                                    </select>
                                    @if ($errors->has('in_top_selling'))
                                        <span class="invalid-feedback">{{ $errors->first('in_top_selling') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="in_new-field">@lang('attributes.in_new')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select class="form-control select2" name="in_new">
                                        <option value="0" {{ old('in_new', $item->in_new) != 1 ? 'selected' : '' }}>
                                            @lang('attributes.draft')
                                        </option>
                                        <option value="1" {{ old('in_new', $item->in_new) == 1 ? 'selected' : '' }}>
                                            @lang('attributes.publish')
                                        </option>

                                    </select>
                                    @if ($errors->has('in_new'))
                                        <span class="invalid-feedback">{{ $errors->first('in_new') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="in_special_offer-field">@lang('attributes.in_special_offer')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <select class="form-control select2" name="in_special_offer">
                                        <option value="0" {{ old('in_special_offer', $item->in_special_offer) != 1 ? 'selected' : '' }}>
                                            @lang('attributes.draft')
                                        </option>
                                        <option value="1" {{ old('in_special_offer', $item->in_special_offer) == 1 ? 'selected' : '' }}>
                                            @lang('attributes.publish')
                                        </option>

                                    </select>
                                    @if ($errors->has('in_special_offer'))
                                        <span class="invalid-feedback">{{ $errors->first('in_special_offer') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <label class="col-form-label col-lg-2" for="offer_expired_at-field">@lang('attributes.offer_expired_at')</label>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <input type="date"
                                        class="form-control @if ($errors->has('offer_expired_at')) is-invalid @endif" name="offer_expired_at"
                                        value="{{ old('offer_expired_at', $item->offer_expired_at) ?? '' }}" />
                                    @if ($errors->has('offer_expired_at'))
                                        <span class="invalid-feedback">{{ $errors->first('offer_expired_at') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                    <div class="col-md-12">
                        <hr>
                        <button type="submit" name="action" value="save" class="btn btn-primary">
                            @lang('common.save')
                        </button>

                        <a class="btn btn-danger pull-right text-white" style="float: right;"
                            href="{{ route('admin.products.index') }}">@lang('common.cancel')
                            <i class="icon-arrow-left-bold"></i>
                        </a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@include('admin.layouts.pages.dropzone')

<script src="https://cdn.tiny.cloud/1/z4r871g6sjhoi8cm8vidvde8cedb47jwuhfdwxfdw1av9wpi/tinymce/5/tinymce.min.js"
referrerpolicy="origin"></script>

<script src="{{ asset('/panel/js/pages/form-validation.init.js') }}"></script>
<script>
    $(function(){
        $('#category').on('change',function(){
            //list sub categories
            $.ajax({
                type: 'GET',
                url: "{{ route('admin.sub_categories.search') }}" + "?category=" + $(this).val(),
                success: function(data) {
                    $("#sub_category").html(data);
                }
            });
        })
    })
$(document).ready(function() {
    0 < $(".tinyMceExample").length && tinymce.init({
        selector: "textarea.tinyMceExample",
        height: 300,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [{
            title: "Bold text",
            inline: "b"
        }, {
            title: "Red text",
            inline: "span",
            styles: {
                color: "#ff0000"
            }
        }, {
            title: "Red header",
            block: "h1",
            styles: {
                color: "#ff0000"
            }
        }, {
            title: "Example 1",
            inline: "span",
            classes: "example1"
        }, {
            title: "Example 2",
            inline: "span",
            classes: "example2"
        }, {
            title: "Table styles"
        }, {
            title: "Table row 1",
            selector: "tr",
            classes: "tablerow1"
        }]
    })
});

</script>
@endsection
