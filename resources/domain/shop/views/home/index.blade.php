@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp
@php /** @var \Domain\Shop\Models\Product[] $latestProducts */ @endphp
@php /** @var \Domain\Shop\Models\Product[] $popularProducts */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="home">

    @include('shop::home.partials.banners')

    @include('shop::home.partials.categories')

    @include('shop::home.partials.products', [
        'title' => 'Популярные товары',
        'products' => $popularProducts,
    ])

    @include('shop::home.partials.banners-split')

    @include('shop::home.partials.products', [
        'title' => 'Новые товары',
        'products' => $latestProducts,
    ])
  </div>
@endsection
