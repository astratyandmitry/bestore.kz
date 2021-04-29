@php /** @var \Domain\Shop\Models\Banner $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.dropdown', [
        'label' => __('cms.field.position_key'),
        'attribute' => 'position_key',
        'required' => true,
        'options'=> $data['positions'],
    ])

    @include('cms::layouts.includes.form.field.input', [
        'label' => __('cms.field.title'),
        'attribute' => 'title',
        'required' => true,
        'autofocus' => true,
    ])
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
        'label' => __('cms.field.image'),
        'attribute' => 'image',
        'path' => 'banners',
        'required' => true,
    ])
  </div>
</section>
