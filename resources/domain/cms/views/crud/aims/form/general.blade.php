@php /** @var \Domain\Shop\Models\Aim $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.dropdown', [
            'label' => __('cms.field.section_id'),
            'attribute' => 'section_id',
            'required' => true,
            'options' => $data['sections'],
        ])

        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.name'),
            'attribute' => 'name',
            'required' => true,
            'autofocus' => true,
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.ckeditor5', [
            'label' => __('cms.field.about'),
            'attribute' => 'about',
            'required' => true,
        ])
    </div>
</section>

<div class="block block--offset">
    <div class="section">
        @for($i = 1; $i <= 4; $i++)
            @include('cms::layouts.includes.form.field.dropdown', [
                'label' => __('cms.field.product_id') . " №{$i}",
                'attribute' => "product_id_{$i}",
                'options' => $data['products'],
            ])
        @endfor
    </div>
</div>
