@php /** @var \Domain\Shop\Models\Taste $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.name'),
            'attribute' => 'name',
            'required' => true,
            'autofocus' => true,
        ])

        @include('cms::layouts.includes.form.field.hru')
    </div>
</section>
