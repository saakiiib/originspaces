@props(['category', 'depth' => 0])

@php
    $children = $category->childrenRecursive ?? collect();
    $hasChildren = $children->isNotEmpty();
@endphp

<div class="cat-tree-item {{ $hasChildren ? 'has-children' : '' }}" data-depth="{{ $depth }}">
    <a @spa href="{{ route('shop', ['category' => $category->slug]) }}" class="cat-tree-link">
        <span>{{ $category->name }}</span>
        @if($hasChildren)
            <i class="bi bi-chevron-right cat-arrow"></i>
        @endif
    </a>
    @if($hasChildren)
        <div class="cat-tree-sub">
            @foreach($children as $child)
                @include('frontend.partials.category-mega-item', ['category' => $child, 'depth' => $depth + 1])
            @endforeach
        </div>
    @endif
</div>
