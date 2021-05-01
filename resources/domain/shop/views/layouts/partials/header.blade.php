@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<header class="header">
  <div class="container">
    <div class="header__content">
      <div class="header__main">
        <div class="logotype">
          <a href="{{ route('shop::home') }}" class="logotype__link">URASHOP</a>
        </div>

        <div class="nav">
          <div class="hamburger">
            @include('shop::layouts.partials.svg.menu', ['class' => 'hamburger__icon hamburger__icon--closed'])
          </div>

          <div class="dropdown">
            <ul class="menu">
              @foreach($layout->getCategories() as $_category)
                <li class="menu__item">
                  <a href="{{ $_category->url() }}" class="menu__link" title="{{ $_category->title }}">
                    {{ $_category->name }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      <form method="GET" action="{{ route('shop::search') }}" class="search">
        <button type="submit" class="search__button">
          @include('shop::layouts.partials.svg.search', ['class' => 'search__icon'])
        </button>

        <input type="text" placeholder="Поиск в каталоге" name="term" class="search__input"
               value="{{ request()->query('term') }}">
      </form>

      <div class="actions">
        <a href="{{ auth('shop')->guest() ? route('shop::auth.login') : route('shop::account.redirect') }}"
           class="button">
          @include('shop::layouts.partials.svg.user', ['class' => 'button__icon'])
          <span class="button__label">Профиль</span>
        </a>

        <a href="{{ route('shop::basket') }}" class="button">
          @include('shop::layouts.partials.svg.basket', ['class' => 'button__icon'])
          <span class="button__label">Корзина</span>
        </a>
      </div>
    </div>

    <div class="header__mobile">
      <form method="GET" action="{{ route('shop::search') }}" class="search">
        <button type="submit" class="search__button">
          @include('shop::layouts.partials.svg.search', ['class' => 'search__icon'])
        </button>

        <input type="text" placeholder="Поиск в каталоге" name="term" class="search__input"
               value="{{ request()->query('term') }}">
      </form>
    </div>
  </div>
</header>
