@php /** @var \Domain\Shop\Models\Category $category */ @endphp

<a href="{{ route('shop::catalog', $category) }}" class="category">
  <div class="category__info">
    <div class="category__name">
      {{ $category->name }}
    </div>
  </div>

  <img src="{{ $category->image }}" alt="{{ $category->name }}" class="category__image">
</a>
