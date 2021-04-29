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
<!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || []
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            })
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''
            j.async = true
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl
            f.parentNode.insertBefore(j, f)
        })(window, document, 'script', 'dataLayer', 'GTM-MC2F7LH')</script>
    <!-- End Google Tag Manager -->
</head>
<body class="preload">

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MC2F7LH"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="shop" class="app">
    @include('shop::layouts.partials.header')

    <main>
        @include('shop::layouts.partials.heading')

        @yield('content')
    </main>

    @include('shop::layouts.partials.footer')

    <div class="loader"></div>
</div>

<script src="{{ mix('/assets/shop/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
