@foreach ($result['categories'] as $category)
<option {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}
    value="{{ $category->id }}">
    {{ $category->title }}
</option>
@endforeach
