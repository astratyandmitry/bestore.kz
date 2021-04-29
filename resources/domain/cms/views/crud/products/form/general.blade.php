@php /** @var \Domain\Shop\Models\Product $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.dropdown', [
            'label' => __('cms.field.category_id'),
            'attribute' => 'category_id',
            'required' => true,
            'options' => $data['categories'],
        ])

        @include('cms::layouts.includes.form.field.dropdown', [
            'label' => __('cms.field.brand_id'),
            'attribute' => 'brand_id',
            'required' => true,
            'options' => $data['brands'],
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.name'),
            'attribute' => 'name',
            'required' => true,
            'autofocus' => true,
        ])

        @include('cms::layouts.includes.form.field.hru')
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.file-image', [
            'path' => 'products',
            'required' => true,
        ])
    </div>
</section>

<product-config
    :dictionary-packing="{{ json_encode(($data['config']['packing'])) }}"
    :dictionary-taste="{{ json_encode(($data['config']['tastes'])) }}"
    :dictionary-city="{{ json_encode(($data['config']['cities'])) }}"

    @if(isset($model) && isset($config))
    :packing="{{ json_encode($config['packing']) }}"
    :tastes="{{ json_encode($config['tastes']) }}"
    :remains="{{ json_encode($config['remains']) }}"
    @endif
></product-config>

<section class="block block--offset">
    <div class="section">
        @include('cms::layouts.includes.form.field.ckeditor5', [
            'label' => __('cms.field.about'),
            'attribute' => 'about',
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.ckeditor5', [
            'label' => __('cms.field.composition'),
            'attribute' => 'composition',
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.ckeditor5', [
            'label' => __('cms.field.recommendation'),
            'attribute' => 'recommendation',
        ])
    </div>
</section>

@include('cms::layouts.includes.form.meta')
