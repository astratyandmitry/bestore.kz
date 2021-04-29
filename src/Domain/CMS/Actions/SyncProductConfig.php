<?php

namespace Domain\CMS\Actions;

use Domain\CMS\Requests\ProductRequest;
use Domain\Shop\Models\ProductPacking;
use Domain\Shop\Models\ProductRemain;
use Domain\Shop\Models\ProductTaste;
use Illuminate\Support\Facades\DB;
use Domain\Shop\Models\Product;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class SyncProductConfig implements ActionInterface
{
    /**
     * @var \Domain\Shop\Models\Product
     */
    private $product;

    /**
     * @var \Domain\CMS\Requests\ProductRequest
     */
    private $request;

    /**
     * @var array
     */
    private $config = [
        'packing' => ProductPacking::class,
        'tastes' => ProductTaste::class,
        'remains' => ProductRemain::class,
    ];

    public function __construct(Product $product, ProductRequest $request)
    {
        $this->product = $product;
        $this->request = $request;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->reset();

        foreach ($this->config as $dataKey => $modelClass) {
            if ($data = $this->request->get($dataKey)) {
                $data = json_decode($data, true);

                if (is_array($data) && count($data)) {
                    foreach ($data as $item) {
                        if ($dataKey === 'tastes' && isset($item['taste'])) {
                            unset($item['taste']);
                        }

                        $item['product_id'] = $this->product->id;

                        /** @var \App\Model $model */
                        $model = new $modelClass;
                        $model->setRawAttributes($item);
                        $model->save();
                    }
                }
            }
        }
    }

    /**
     * @return void
     */
    private function reset(): void
    {
        DB::transaction(function (): void {
            $this->product->packing()->delete();
            $this->product->tastes()->delete();
            $this->product->remains()->delete();
        });
    }
}
