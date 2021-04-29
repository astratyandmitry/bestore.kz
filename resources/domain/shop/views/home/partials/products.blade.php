<div class="products">
    <div class="heading heading--spaced">
        <div class="container">
            @include('shop::layouts.partials.heading.title', ['title' => $title])
        </div>
    </div>

    <div class="container">
        <div class="products__list">
            @each('shop::product.partials.item', $products, 'product')
        </div>
    </div>
</div>
