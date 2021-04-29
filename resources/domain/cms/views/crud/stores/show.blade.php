@php /** @var \Domain\Shop\Models\Store $model */ @endphp

@extends('cms::layouts.master', $globals)

@section('content')
    <div class="page-grid">
        <div class="page-grid__left">
            <section class="block">
                <div class="table table--card">
                    <table>
                        @include('cms::layouts.includes.show.detail_id')
                        <tr>
                            <td class="cell--key">
                                @lang('cms.field.city_id')
                            </td>
                            <td>
                                <a href="{{ route('cms::cities.show', $model->id) }}">
                                    {{ $model->city->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="cell--key">
                                @lang('cms.field.address')
                            </td>
                            <td>
                                {{ $model->address }}
                            </td>
                        </tr>
                        <tr>
                            <td class="cell--key">
                                @lang('cms.field.phone')
                            </td>
                            <td>
                                {{ $model->phone }}
                            </td>
                        </tr>
                        @include('cms::layouts.includes.show.detail_active')
                        @include('cms::layouts.includes.show.detail_dates')
                    </table>
                </div>
            </section>
        </div>

        <div class="page-grid__right">
            <div class="block aside">
                @include('cms::layouts.includes.show.actions')
            </div>
        </div>
    </div>
@endsection
