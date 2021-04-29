@php /** @var \Domain\Shop\Common\Layout $layout */ @endphp
@php /** @var \Domain\Shop\Models\City[] $cities*/ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('content')
    <div id="stores" class="stores">
        <div class="container">
            <shop-locations :cities='@json($cities)' :current-city="{{ $layout->getCity() }}"/>
        </div>
    </div>

    <script src="{{ mix('/assets/shop/js/stores.js') }}"></script>
@endsection
