@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp

<section class="menu">
    <div class="container">
        <div class="content">
            <ul class="list">
                <li class="list__item list__item--dropdown">
                    <a href="javascript:void(0)" class="list__link">
                        Спортивное питание
                    </a>

                    <div class="dropdown">
                        <ul class="dropdown__list">
                            @foreach($layout->getCategories() as $_category)
                                <li class="dropdown__item dropdown__item--additional">
                                    <a href="{{ $_category->children->isNotEmpty() ? 'javascript:void(0)' : $_category->url() }}"
                                       class="dropdown__link">
                                        <span>{{ $_category->name }}</span>

                                        @if ($_category->children->isNotEmpty())
                                            @include('shop::layouts.partials.svg.angle', ['class' => 'dropdown__icon'])
                                        @endif
                                    </a>

                                    @if ($_category->children->isNotEmpty())
                                        <div class="additional">
                                            <img src="{{ $_category->image }}" class="additional__image">

                                            <ul class="additional__list">
                                                @foreach($_category->children as $_child)
                                                    <li class="additional__item">
                                                        <a href="{{ $_child->url() }}"
                                                           class="additional__link">
                                                            {{ $_child->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="list__item">
                    <a href="{{ route('shop::page', 'about') }}" class="list__link">
                        О компании
                    </a>
                </li>
            </ul>
        </div>
    </div>
</section>
