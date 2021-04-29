@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<nav class="nav">
    <div class="container">
        <div class="content">
            <div class="section">
                <ul class="list">
                    <li class="list__item list__item--dropdown">
                        <a href="javascript:void(0)" class="list__link list__link--primary list__link--icon">
                            @include('shop::layouts.partials.svg.location', ['class' => 'list__icon'])
                            <span>{{ $layout->getCity()->name }}</span>
                            @include('shop::layouts.partials.svg.angle', ['class' => 'list__icon list__icon--dropdown'])
                        </a>

                        <div class="dropdown">
                            <ul class="dropdown__list">
                                @foreach($layout->getCities() as $_city)
                                    @continue($_city->is($layout->getCity()))
                                    <li class="dropdown__item">
                                        <a href="/change-city/{{ $_city->hru }}" class="dropdown__link">
                                            {{ $_city->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="list__item">
                        <a href="tel:8{{ str_replace(['+7', '(', ')'], '', $layout->getCity()->phone) }}"
                           class="list__link list__link--primary list__link--icon">
                            {{ phone($layout->getCity()->phone) }}
                        </a>
                    </li>
                </ul>
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
                        <a href="{{ route('shop::stores') }}" class="list__link">
                            Магазины
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
