@php /** @var \Domain\Shop\Models\Store $model */ @endphp

<section class="block">
    <div class="section">
        @include('cms::layouts.includes.form.field.dropdown', [
            'label' => __('cms.field.city_id'),
            'attribute' => 'city_id',
            'required' => true,
            'options' => $data['cities'],
            'forceValue' => isset($model) ? $model->city_id : request()->query('city_id'),
        ])
    </div>

    <div class="section">
        <div class="form-grid form-grid--2">
            @include('cms::layouts.includes.form.field.input', [
                'label' => __('cms.field.address'),
                'attribute' => 'address',
                'required' => true,
                'autofocus' => true,
            ])

            @include('cms::layouts.includes.form.field.input', [
                'label' => __('cms.field.phone'),
                'attribute' => 'phone',
                'required' => true,
            ])
        </div>
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.working_hours'),
            'attribute' => 'working_hours',
            'required' => true,
        ])

        @include('cms::layouts.includes.form.field.input', [
            'label' => __('cms.field.address_details'),
            'attribute' => 'address_details',
        ])
    </div>

    <div class="section">
        @include('cms::layouts.includes.form.field.input', [
            'label' => 'Map Embed',
            'attribute' => 'map_embed',
            'required' => true,
        ])
    </div>
</section>
