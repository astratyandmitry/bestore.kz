@php /** @var \Domain\Shop\Models\Aim $model */ @endphp

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
                                @lang('cms.field.section_id')
                            </td>
                            <td>
                                {{ $model->section->name }}
                            </td>
                        </tr>
                        <tr>
                            <td class="cell--key">
                                @lang('cms.field.name')
                            </td>
                            <td>
                                {{ $model->name }}
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
