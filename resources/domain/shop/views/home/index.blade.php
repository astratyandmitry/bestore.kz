@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp
@php /** @var \Domain\Shop\Models\Product[] $latestProducts */ @endphp
@php /** @var \Domain\Shop\Models\Product[] $popularProducts */ @endphp

@extends('shop::layouts.master')

@section('content')
  <div class="home">
    <div class="container">
      <div class="heading">
        <div class="title">
          Home page
        </div>
      </div>

      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, recusandae.
      </p>
    </div>
    {{--    @include('shop::home.partials.banners')--}}

    {{--    @include('shop::home.partials.categories')--}}

    {{--    @include('shop::home.partials.products', [--}}
    {{--        'title' => 'Популярные товары',--}}
    {{--        'products' => $popularProducts,--}}
    {{--    ])--}}

    {{--    @include('shop::home.partials.products', [--}}
    {{--        'title' => 'Новые товары',--}}
    {{--        'products' => $latestProducts,--}}
    {{--    ])--}}
  </div>
@endsection
