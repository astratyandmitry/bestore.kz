@php /** @var \Domain\Shop\Models\Slide $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.title'),
            'attribute' => 'title',
            'required' => true,
            'autofocus' => true,
        ])

        @include('cms::layouts.includes.form.field.textarea', [
            'label' => __('cms.field.about'),
            'attribute' => 'about',
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.file-image', [
            'label' => __('cms.field.image'),
            'attribute' => 'image',
            'path' => 'slides',
            'required' => true,
        ])
    </div>
</section>
