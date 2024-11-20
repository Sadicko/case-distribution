<option value="{{ $subCategoryChild->id }}" {{ $subCategoryChild->id == old('subcategory')  ? 'selected' : ''}}>{{ str_repeat('—', $level) }} {{ ucfirst($subCategoryChild->name) }}</option>
@if($subCategoryChild->children)
    @foreach($subCategoryChild->children as $child)
        @include('dashboard.assets.partials.category_children', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
