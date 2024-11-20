<option value="{{ $category->id }}" {{ $category->id == $editParentCategory  ? 'selected' : ''}}>{{ str_repeat('—', $level) }} {{ ucfirst($category->name) }}</option>
@if($category->children)
    @foreach($category->children as $child)
        @include('dashboard.category.category_option', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
