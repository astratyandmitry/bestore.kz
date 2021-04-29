@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp
@php /** @var \Domain\Shop\Models\Catalog[] $latestProducts */ @endphp
@php /** @var \Domain\Shop\Models\Catalog[] $popularProducts */ @endphp

@extends('shop::layouts.master')

@section('content')
    <div class="home">
        @include('shop::home.partials.slider')

        @include('shop::home.partials.categories')

        @include('shop::home.partials.products', [
            'title' => 'Популярные товары',
            'products' => $popularProducts,
        ])

        @include('shop::home.partials.products', [
            'title' => 'Новые товары',
            'products' => $latestProducts,
        ])

        @include('shop::home.partials.ambassadors')
    </div>
@endsection
