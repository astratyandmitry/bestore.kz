@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<nav class="nav">
    <div class="container">
        <div class="content">
            <div class="section">
            </div>

            <div class="section section--menu">
                <ul class="list">
                    <li class="list__item">
                        <a href="{{ route('shop::page', 'delivery-and-payment') }}" class="list__link">
                            Доставка и оплата
                        </a>
                    </li>
                    <li class="list__item">
                        <a href="{{ route('shop::page', 'franchise') }}" class="list__link">
                            Франшиза
                        </a>
                    </li>
                    <li class="list__item">
                        <a href="{{ auth('shop')->guest() ? route('shop::auth.login') : route('shop::account.redirect') }}"
                           class="list__link list__link--primary list__link--icon">
                            @include('shop::layouts.partials.svg.user', ['class' => 'list__icon'])
                            <span>{{ auth('shop')->guest() ? 'Войти' : 'Личный кабинет' }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
