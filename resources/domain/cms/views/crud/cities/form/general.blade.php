@php /** @var \Domain\Shop\Models\City $model */ @endphp

<section class="block">
  <div class="section">
    @include('cms::layouts.includes.form.field.input', [
          'label' => __('cms.field.name'),
          'attribute' => 'name',
          'required' => true,
          'autofocus' => true,
    ])
  </div>

  <div class="section">
    <div class="form-grid">
      @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.phone'),
            'attribute' => 'phone',
            'required' => true,
      ])

      @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.address'),
            'attribute' => 'address',
            'required' => true,
      ])
    </div>
  </div>
</section>


@push('scripts')
  <script src="https://unpkg.com/imask"></script>
  <script>
    IMask(document.getElementById('phone'), {
      mask: '+{7}(000)0000000'
    })
  </script>
@endpush
