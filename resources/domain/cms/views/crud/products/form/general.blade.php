@php /** @var \Domain\Shop\Models\Product $model */ @endphp

<section class="block">
  <div class="section">
    <div class="form-grid form-grid--2">
      @include('cms::layouts.includes.form.field.dropdown-grouped', [
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
    <div class="form-grid form-grid--3">
      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.price'),
          'attribute' => 'price',
          'required' => true,
          'type' => 'number',
      ])

      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.price_sale'),
          'attribute' => 'price_sale',
          'type' => 'number',
      ])

      @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.quantity'),
          'attribute' => 'quantity',
          'required' => true,
          'type' => 'number',
      ])
    </div>
  </div>

  <div class="section">
    @include('cms::layouts.includes.form.field.file-image', [
        'path' => 'products',
        'required' => true,
    ])
  </div>

  <div class="section section--last">
    @include('cms::layouts.includes.form.field.ckeditor5', [
        'label' => __('cms.field.about'),
        'attribute' => 'about',
    ])
  </div>
</section>

@include('cms::layouts.includes.form.meta')
