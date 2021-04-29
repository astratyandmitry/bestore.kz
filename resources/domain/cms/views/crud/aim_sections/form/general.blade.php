@php /** @var \Domain\Shop\Models\AimSection $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.name'),
            'attribute' => 'name',
            'required' => true,
            'autofocus' => true,
        ])

        @include('cms::layouts.includes.form.field.hru')

        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.title'),
            'attribute' => 'title',
            'required' => true,
        ])
    </div>
</section>

@include('cms::layouts.includes.form.meta')
