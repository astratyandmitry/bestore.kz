@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<footer class="footer">
  <div class="footer__main">
    <div class="container">
      <div class="content">
        <div class="section">
          <div class="section__title">
            Питание
          </div>

          <ul class="section__list">
            @foreach($layout->getCategories() as $_category)
              <li class="section__item">
                <a href="{{ $_category->url() }}" class="section__link">
                  {{ $_category->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        <div class="section">
          <div class="section__title">
            Покупателям
          </div>

          <ul class="section__list">
            <li class="section__item">
              <a href="{{ route('shop::page', 'delivery-and-payment') }}" class="section__link">
                Доставка и оплата
              </a>
            </li>
          </ul>
        </div>

        <div class="section">
          <div class="section__title">
            Компания
          </div>

          <ul class="section__list">
            <li class="section__item">
              <a href="{{ route('shop::page', 'about') }}" class="section__link">
                О компании
              </a>
            </li>
            <li class="section__item">
              <a href="{{ route('shop::page', 'franchise') }}" class="section__link">
                Франшиза
              </a>
            </li>
          </ul>
        </div>

        <div class="section">
          <div class="section__title">
            Контакты
          </div>

          <ul class="section__list">
            <li class="section__item section__item--contact">
              <div class="contact">
                <div class="contact__label">
                  Телефон
                </div>
                <div class="contact__value">
                  <a href="tel:8{{ str_replace(['+7', '(', ')'], '', config('shop.contact.email')) }}">
                    {{ config('shop.contact.email') }}
                  </a>
                </div>
              </div>
            </li>
            <li class="section__item section__item--contact">
              <div class="contact">
                <div class="contact__label">
                  E-mail
                </div>
                <div class="contact__value">
                  <a href="mailto:{{ config('shop.contact.email') }}">
                    {{ config('shop.contact.email') }}
                  </a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="footer__info">
    <div class="container">
      <div class="content">
        <div class="copyright">
          © {{ env('APP_NAME') }} {{ date('Y') }}
        </div>

        <ul class="list">
          <li class="list__item">
            <a href="{{ route('shop::page', 'policy') }}" class="list__link">
              Политика конфиденциальности
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
