@php /** @var \Domain\Shop\Models\Product $product */ @endphp
@php /** @var array $stocks */ @endphp

@extends('shop::layouts.master')

@section('content')
    <div class="product-card">
        <div class="container">
            <div class="product" id="product">
                <div class="product__left">
                    <div class="product__heading">
                        <h1 class="product__name">
                            {{ $product->name }}
                        </h1>
                    </div>

                    <div class="media">
                        @if ($product->badge)
                            <div class="media__badge">
                                {{ $product->badge->name }}
                            </div>
                        @endif

                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="media__image">
                    </div>

                    @if ($product->brand)
                        <div class="brand">
                            @if ($product->brand->logotype)
                                <div class="brand__media">
                                    <img src="{{ $product->brand->logotype }}" alt="{{ $product->brand->name }}"
                                         class="brand__image">
                                </div>
                            @endif

                            <div class="brand__info">
                                <div class="brand__name">
                                    {{ $product->brand->name }}
                                </div>

                                <div class="brand__detail">
                                    Официальные поставки от бренда
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="product__right">
                    <div class="product__heading">
                        <a href="{{ $product->category->url() }}" class="product__category">
                            {{ $product->category->name }}
                        </a>

                        <h1 class="product__name">
                            {{ $product->name }}
                        </h1>
                    </div>

                    @if (count($stocks))
                        <product-config :product-id="{{ $product->id }}" :stocks='@json($stocks)'/>
                    @else
                        <div class="empty">
                            <div class="empty__title">
                                Остатки не найдены
                            </div>

                            <div class="empty__message">
                                В данный момент на нашем складе нет данной продукции, попробуйте вернуться позднее...
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($product->about)
                <div class="about">
                    {!! $product->about !!}
                </div>
            @endif
        </div>

        <div class="detail">
            <div class="container">
                <h2 class="detail__title">
                    Описание
                </h2>

                <div class="detail__content">
                    <div class="section">
                        <div class="section__label">
                            <span>Состав</span>
                        </div>
                        <div class="section__content">
                            {!! strip_tags($product->composition) !!}
                        </div>
                    </div>

                    <div class="section">
                        <div class="section__label">
                            <span>Рекомендации к применению</span>
                        </div>
                        <div class="section__content">
                            {!! $product->recommendation !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($product->related->isNotEmpty())
            <div class="related">
                <div class="container">
                    <h3 class="related__title">
                        Похожие товары
                    </h3>

                    <div class="related__content products">
                        <div class="products__list">
                            @each('shop::product.partials.item', $product->related, 'product')
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="{{ mix('/assets/shop/js/product.js') }}"></script>
@endsection
