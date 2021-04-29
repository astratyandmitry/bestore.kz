@include('shop::layouts.partials.nav')

<section class="fixable">
    <header class="header">
        <div class="container">
            <div class="content">
                <div class="header__left">
                    <a href="javascript:void(0)" class="hamburger js-menu">
                        @include('shop::layouts.partials.svg.menu', ['class' => 'hamburger__icon'])
                    </a>

                    <div class="logotype">
                        <a href="{{ route('shop::home') }}" class="logotype__link">
                            <img src="/images/logotype.png?2" srcset="/images/logotype@2x.png?2 2x"
                                 alt="{{ env('APP_NAME') }}"
                                 class="logotype__image">
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('shop::search') }}" class="search">
                    <input type="text" placeholder="Поиск в каталоге" name="term" class="search__input">

                    <button type="submit" class="search__button">
                        @include('shop::layouts.partials.svg.search', ['class' => 'search__icon'])
                    </button>
                </form>

                <a href="{{ route('shop::basket') }}" class="basket">
                    <span class="basket__circle">
                        <span class="basket__count">
                            @php $total = app('basket')->countPositions() @endphp
                            {{ $total > 99 ? '99+' : $total }}
                        </span>
                    </span>

                    <span class="basket__content">
                        <span class="basket__label">
                            Корзина
                        </span>

                        @if ($amount = app('basket')->total())
                            <span class="basket__amount">
                                {{ price($amount) }} ₸
                            </span>
                        @endif
                    </span>
                </a>

                <div class="icons">
                    <a href="javascript:void(0)" class="icon js-search">
                        @include('shop::layouts.partials.svg.search', ['class' => 'icon__icon'])
                    </a>

                    <a href="{{ route('shop::basket') }}" class="icon">
                        @include('shop::layouts.partials.svg.basket', ['class' => 'icon__icon'])
                    </a>

                    <a href="{{ auth('shop')->guest() ? route('shop::auth.login') : route('shop::account.redirect') }}"
                       class="icon">
                        @include('shop::layouts.partials.svg.user', ['class' => 'icon__icon'])
                    </a>
                </div>
            </div>
        </div>
    </header>

    @include('shop::layouts.partials.menu')
</section>
