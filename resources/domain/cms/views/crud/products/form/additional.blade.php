@php /** @var \Domain\Shop\Models\Product $model */ @endphp

<div class="section">
    @include('cms::layouts.includes.form.field.dropdown', [
        'label' => __('cms.field.badge_id'),
        'attribute' => 'badge_id',
        'options' => $data['badges'],
    ])
</div>

<div class="section">
    @include('cms::layouts.includes.form.field.checkbox', [
        'label' => __('cms.field.active'),
        'attribute' => 'active',
    ])
</div>
