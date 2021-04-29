@php /** @var \Domain\Shop\Models\Catalog $product */ @endphp

<a href="{{ $product->url() }}" class="product">
    <div class="product__media">
        @if ($product->badge)
            <div class="product__badge">
                {{ $product->badge->name }}
            </div>
        @endif

        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product__image">
    </div>

    <div class="product__content">
        <div class="product__main">
            <div class="product__name">
                {{ $product->name }}
            </div>

            <div class="product__detail">
                {{ $product->category->name }}
            </div>
        </div>

        <div class="product__info">
            <div class="product__price">
                {{ price($product->price_sale ? (int)$product->price_sale : (int)$product->price) }} ₸
            </div>

            <div class="product__sale">
                @if ($product->price_sale)
                    Экономия {{ price($product->price - $product->price_sale) }} ₸
                @else
                    &nbsp;
                @endif
            </div>
        </div>
    </div>
</a>
