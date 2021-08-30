@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      <div class="section">
        <div class="section__title">
          О нас
        </div>

        <div class="section__body">
          <ul class="menu">
            <li class="menu__item">
              <a href="{{ route('shop::page', 'about') }}" class="menu__link">
                О компании
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'franchise') }}" class="menu__link">
                Франшиза
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'contacts') }}" class="menu__link">
                Контакты
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'stores') }}" class="menu__link">
                Адреса магазинов
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="section">
        <div class="section__title">
          Клиентам
        </div>

        <div class="section__body">
          <ul class="menu">
            <li class="menu__item">
              <a href="{{ route('shop::page', 'payment') }}" class="menu__link">
                Оплата товаров
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'delivery') }}" class="menu__link">
                Способы доставки
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="section">
        <div class="section__title">
          Пользователям
        </div>

        <div class="section__body">
          <ul class="menu">
            <li class="menu__item">
              <a href="{{ route('shop::page', 'agreement') }}" class="menu__link">
                Пользовательское соглашение
              </a>
            </li>
            <li class="menu__item">
              <a href="{{ route('shop::page', 'rules') }}" class="menu__link">
                Правила пользования сайтом
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="section">
        <div class="section__title">
          Контакты
        </div>

        <div class="section__body">
          <div class="contact">
            <div class="contact__label">
              Адрес
            </div>
            <div class="contact__value">
              {{ $layout->getCity()->address }}
            </div>
          </div>

          <div class="contact">
            <div class="contact__label">
              Телефон
            </div>
            <div class="contact__value">
              <a href="tel:{{ clean_phone($layout->getCity()->phone) }}">
                {{ $layout->getCity()->phone }}
              </a>
            </div>
          </div>

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
        </div>
      </div>
    </div>

    <div class="copyright">
      © {{ env('APP_NAME') }} {{ date('Y') }} интернет-магазин всего
    </div>
  </div>
</footer>
