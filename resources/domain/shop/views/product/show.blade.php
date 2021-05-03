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
          <div class="price">
            <div class="price__value">
              <div class="price__current">
                <span>{{ number_format($product->price_sale ? $product->price_sale : $product->price)  }}</span> ₸
              </div>

              @if ($product->price_sale)
                <div class="price__prev">
                  <span>{{ number_format($product->price_sale) }}</span> ₸
                </div>
              @endif
            </div>

            <div class="price__notice">
              * Цена актуальна только в <span class="nowrap">интернет-магазине</span> <br>
              ** Стоимость доставки состовляет {{ config('shop.delivery_price') }} ₸
            </div>
          </div>

          <div class="about">
            {!! $product->about !!}
          </div>

          @if ($product->quantity)
            <div class="basket">
              <button class="basket__button" data-id="{{ $product->id }}">
                <span class="basket__button__content">
                   @include('shop::layouts.partials.svg.basket', ['class' => 'basket__button__icon'])
                  <span class="basket__button__label">Добавить в корзину</span>
                </span>
              </button>

              <button class="basket__button basket__button--now" data-id="{{ $product->id }}">
                <span class="basket__button__content">
                  <span class="basket__button__label">Купить сейчас</span>
                </span>
              </button>
            </div>
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
  </div>
@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
          integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
          crossorigin="anonymous"></script>
  <script>
    $(function () {
      $('.basket__button').on('click', function () {
        var buyNow = $(this).hasClass('basket__button--now');

        $.ajax({
          url: '/basket',
          method: 'POST',
          data: {
            product_id: $(this).data('id'),
            _token: '{{ csrf_token() }}',
          },
          success: function() {
            if (buyNow) {
              window.location.href = '/basket'
            } else {
              $(this).find('.basket__button__label').text('Добавлено в корзину')
            }
          }
        })
      })
    })
  </script>
@endpush
