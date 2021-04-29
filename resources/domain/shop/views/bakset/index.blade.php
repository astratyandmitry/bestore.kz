@php /** @var \Domain\Shop\Models\Category[] $categories */ @endphp
@php /** @var \Domain\Shop\Models\Product[] $products */ @endphp

@extends('shop::layouts.master')

@section('content')
    <div class="product">
        <div class="container">

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ mix('/assets/shop/js/basket.js') }}"></script>
@endpush
