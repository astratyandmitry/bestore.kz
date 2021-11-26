@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp
  <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@if ($title = $layout->title){{ $title }} — @endif{{ env('APP_NAME') }}</title>
  <link rel="stylesheet" href="{{ mix('/assets/shop/css/app.css') }}">
  @include('shared.head-icons')
  @stack('styles')
</head>
<body class="preload">

<section id="shop" class="app">
  @include('shop::layouts.partials.header')

  <main>
    @include('shop::layouts.partials.heading')

    @yield('content')
  </main>

  @include('shop::layouts.partials.footer')

  <div class="loader"></div>
</section>

<a href="tel:+77075444449" class="call-button">
  <svg class="call-button__icon" width="32" height="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z"></path>
    <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
    <path d="M15 7a2 2 0 0 1 2 2"></path>
    <path d="M15 3a6 6 0 0 1 6 6"></path>
  </svg>
</a>

<script src="{{ mix('/assets/shop/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
