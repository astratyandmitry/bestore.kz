@php /** @var \Domain\Shop\Models\City $model */ @endphp

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

    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.phone'),
            'attribute' => 'phone',
            'required' => true,
        ])

        <div class="form-grid form-grid--2">
            @include('cms::layouts.includes.form.field.input', [
                'label' => __('cms.field.delivery_price'),
                'attribute' => 'delivery_price',
                'required' => true,
                'type' => 'number',
            ])

            @include('cms::layouts.includes.form.field.input', [
                'label' => __('cms.field.free_delivery_min_price'),
                'attribute' => 'free_delivery_min_price',
                'required' => true,
                'type' => 'number',
            ])
        </div>
    </div>
</section>

@push('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        var element = document.getElementById('phone');
        IMask(element, {
            mask: '+{7}(000)0000000'
        });
    </script>
@endpush
