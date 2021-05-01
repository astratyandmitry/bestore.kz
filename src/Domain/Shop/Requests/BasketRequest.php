<?php

namespace Domain\Shop\Requests;

/**
 * @property integer $product_id
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
        ];
    }
}
