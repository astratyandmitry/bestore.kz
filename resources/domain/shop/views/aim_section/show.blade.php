@php /** @var \Domain\Shop\Models\AimSection $aim_section */ @endphp

@extends('shop::layouts.master', ['layout' => $layout])

@section('content')
    <div class="aim-section">
        <div class="container">
            @if (count($aim_section->aims))
                <div class="aims">
                    @foreach($aim_section->aims as $aim)
                        <div class="aim">
                            <div class="aim__info">
                                <div class="aim__title">
                                    {{ $aim->name }}
                                </div>

                                <div class="aim__about">
                                    {!! $aim->about !!}
                                </div>
                            </div>

                            @php $products =  $aim->products() @endphp
                            @if ($products->isNotEmpty())
                                <div class="aim__products products">
                                    <div class="products__list">
                                        @each('shop::product.partials.item', $products, 'product')
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
