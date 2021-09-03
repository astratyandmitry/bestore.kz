<?php

namespace Domain\Shop\Requests;

/**
 * @property integer $product_id
 * @property integer $packing_id
 * @property integer $taste_id
 */
class BasketRequest extends Request
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'packing_id' => 'required|exists:packing,id',
            'taste_id' => 'required|exists:tastes,id',
        ];
    }
}
