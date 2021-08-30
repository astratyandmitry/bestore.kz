@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<nav class="top-bar">
  <div class="container">
    <div class="top-bar__content">
      <div class="location">
        <div class="city">
          <div class="city__name">
            <span>{{ $layout->getCity()->name }}</span>
            @include('shop::layouts.partials.svg.angle', ['class' => 'city__icon'])
          </div>
          <ul class="city-dropdown">
            @foreach($layout->getCities() as $city)
              @continue($city->is($layout->getCity()))
              <li class="city-dropdown__item">
                <a href="{{ route('shop::app.change-city', $city->id) }}" class="city-dropdown__link">
                  {{ $city->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="phone">
          <a href="tel:{{ clean_phone($layout->getCity()->phone) }}">
            {{ $layout->getCity()->phone }}
          </a>
        </div>
      </div>

      <div class="menu">
        @foreach($layout->getPages() as $_page)
          <li class="menu__item">
            <a href="{{ $_page->url() }}" class="menu__link" title="{{ $_page->title }}">
              {{ $_page->name }}
            </a>
          </li>
        @endforeach
      </div>
    </div>
  </div>
</nav>

<header class="header">
  <div class="container">
    <div class="header__content">
      <div class="header__main">
        <div class="logotype">
          <a href="{{ route('shop::home') }}" class="logotype__link">BESTORE</a>
        </div>

        <div class="nav">
          <div class="hamburger">
            @include('shop::layouts.partials.svg.menu', ['class' => 'hamburger__icon hamburger__icon--closed'])
          </div>

          <div class="dropdown">
            <ul class="menu menu--main">
              @foreach($layout->getCategories() as $_category)
                <li class="menu__item" data-for="{{ $_category->id }}">
                  <a href="{{ $_category->url() }}" class="menu__link" title="{{ $_category->title }}">
                    {{ $_category->name }}
                  </a>
                </li>
              @endforeach
            </ul>
            @foreach($layout->getCategories() as $_category)
              <ul class="menu menu--child" id="child-menu-{{ $_category->id }}" data-id="{{ $_category->id }}">
                @foreach($_category->children as $_subcategory)
                  <li class="menu__item">
                    <a href="{{ $_subcategory->url() }}" class="menu__link" title="{{ $_subcategory->title }}">
                      {{ $_subcategory->name }}
                    </a>
                  </li>
                @endforeach
              </ul>
            @endforeach
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
