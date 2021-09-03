@php /** @var \Domain\Shop\Models\Product $product */ @endphp
@php /** @var array $stocks */ @endphp

@extends('shop::layouts.master')

@section('subtitle')
  @include('shop::product.partials.show-detail')
@endsection

@section('content')
  <div class="product-card">
    <div class="container">
      <div class="product" id="product">
        <div class="product__left">
          <div class="media">
            @if ($product->badges !== null && $badges = explode(',', $product->badges))
              <div class="media__badge">
                @foreach($badges as $badge)
                  <div class="media__badge__item">
                    {{ $badge }}
                  </div>
                @endforeach
              </div>
            @endif

            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="media__image">
          </div>
        </div>

        <div class="product__right">
          @if (count($stocks))
            <product-config :product-id="{{ $product->id }}" :stocks='@json($stocks)'/>
          @else
            <div class="empty empty--sm">
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
    </div>

    @include('shop::product.partials.show-reviews')

    @include('shop::product.partials.show-related')

    <script src="{{ mix('/assets/shop/js/product.js') }}"></script>
  </div>
@endsection
