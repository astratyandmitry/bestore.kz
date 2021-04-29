@php /** @var \Domain\Shop\Models\Ambassador $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.full_name'),
            'attribute' => 'name',
            'required' => true,
            'autofocus' => true,
        ])

        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.instagram_username'),
            'attribute' => 'instagram_username',
            'required' => true,
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.file-image', [
            'attribute' => 'photo',
            'path' => 'ambassadors',
            'required' => true,
        ])
    </div>
</section>
