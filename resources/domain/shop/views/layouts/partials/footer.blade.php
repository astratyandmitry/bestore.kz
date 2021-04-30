@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<footer class="footer">
  <div class="container">
    <div class="footer__grid">
      @foreach(['О компании', 'Клиентам', 'Прочее'] as $_section)
        <div class="section">
          <div class="section__title">
            {{ $_section }}
          </div>

          <div class="section__body">
            <ul class="menu">
              @for($i = 1; $i <= rand(3,5); $i++)
                <li class="menu__item">
                  <a href="#" class="menu__link">
                    Элемент навигации {{ $i }}
                  </a>
                </li>
              @endfor
            </ul>
          </div>
        </div>
      @endforeach

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
              {{ config('shop.contact.address') }}
            </div>
          </div>

          <div class="contact">
            <div class="contact__label">
              Телефон
            </div>
            <div class="contact__value">
              <a href="tel:8{{ str_replace(['+7', '(', ')'], '', config('shop.contact.phone')) }}">
                {{ config('shop.contact.phone') }}
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
