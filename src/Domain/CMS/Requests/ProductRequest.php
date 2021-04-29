<?php

namespace Domain\CMS\Requests;

use Domain\Shop\Models\Product;

class ProductRequest extends Request
{
    /**
     * @return void
     */
    protected function buildRules(): void
    {
        $this->rulesBuilder
            ->addUniqueRule('hru', Product::getTableName())
            ->addMetaRules()
            ->addRules([
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'hru' => 'required|max:80|alpha_dash',
                'name' => 'required|max:120',
                'image' => 'required',
                'price' => 'required|integer|min:1',
                'price_sale' => 'nullable|integer',
                'quantity' => 'required|integer|min:0',
                'about' => 'required',
                'active' => 'boolean',
            ]);
    }
}
