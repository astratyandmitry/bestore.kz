@php /** @var string $section */ @endphp
@php /** @var string $model */ @endphp

<nav>
    <div class="container">
        @switch($section)
            @case('main')
            <ul class="menu">
                <li {{ isActive($model == 'orders') }}>
                    <a href="{{ route('cms::orders.index') }}">
                        @lang('cms.model.orders')
                    </a>
                </li>
                <li {{ isActive($model == 'products') }}>
                    <a href="{{ route('cms::products.index') }}">
                        @lang('cms.model.products')
                    </a>
                </li>
                <li class="is-divider">
                    <span>&middot;</span>
                </li>
                <li {{ isActive($model == 'slides') }}>
                    <a href="{{ route('cms::slides.index') }}">
                        @lang('cms.model.slides')
                    </a>
                </li>
                <li {{ isActive($model == 'stores') }}>
                    <a href="{{ route('cms::stores.index') }}">
                        @lang('cms.model.stores')
                    </a>
                </li>
                <li {{ isActive($model == 'pages') }}>
                    <a href="{{ route('cms::pages.index') }}">
                        @lang('cms.model.pages')
                    </a>
                </li>
                <li class="is-divider">
                    <span>&middot;</span>
                </li>
                <li {{ isActive($model == 'ambassadors') }}>
                    <a href="{{ route('cms::ambassadors.index') }}">
                        @lang('cms.model.ambassadors')
                    </a>
                </li>
            </ul>
            @break
            @case('dictionary')
            <ul class="menu">
                <li {{ isActive($model == 'categories') }}>
                    <a href="{{ route('cms::categories.index') }}">
                        @lang('cms.model.categories')
                    </a>
                </li>
                <li {{ isActive($model == 'aims') }}>
                    <a href="{{ route('cms::aims.index') }}">
                        @lang('cms.model.aims')
                    </a>
                </li>
                <li {{ isActive($model == 'aim_sections') }}>
                    <a href="{{ route('cms::aim_sections.index') }}">
                        @lang('cms.model.aim_sections')
                    </a>
                </li>
                <li class="is-divider">
                    <span>&middot;</span>
                </li>
                <li {{ isActive($model == 'brands') }}>
                    <a href="{{ route('cms::brands.index') }}">
                        @lang('cms.model.brands')
                    </a>
                </li>
                <li {{ isActive($model == 'badges') }}>
                    <a href="{{ route('cms::badges.index') }}">
                        @lang('cms.model.badges')
                    </a>
                </li>
                <li {{ isActive($model == 'packing') }}>
                    <a href="{{ route('cms::packing.index') }}">
                        @lang('cms.model.packing')
                    </a>
                </li>
                <li {{ isActive($model == 'tastes') }}>
                    <a href="{{ route('cms::tastes.index') }}">
                        @lang('cms.model.tastes')
                    </a>
                </li>
                <li class="is-divider">
                    <span>&middot;</span>
                </li>
                <li {{ isActive($model == 'cities') }}>
                    <a href="{{ route('cms::cities.index') }}">
                        @lang('cms.model.cities')
                    </a>
                </li>
            </ul>
            @break
            @case('system')
            <ul class="menu">
                <li {{ isActive($model == 'managers') }}>
                    <a href="{{ route('cms::managers.index') }}">
                        @lang('cms.model.managers')
                    </a>
                </li>
            </ul>
            @break
        @endswitch
    </div>
</nav>
