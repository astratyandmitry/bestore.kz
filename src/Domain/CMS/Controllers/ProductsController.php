<?php

namespace Domain\CMS\Controllers;

use Domain\CMS\Actions\SyncProductConfig;
use Domain\Shop\Models\City;
use Domain\Shop\Models\Packing;
use Domain\Shop\Models\Taste;
use Illuminate\View\View;
use Domain\Shop\Models\Badge;
use Domain\Shop\Models\Brand;
use Domain\Shop\Models\Product;
use Domain\Shop\Models\Category;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\ProductRequest as Request;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class ProductsController extends Controller
{
    /**
     * @var string
     */
    protected $section = self::SECTION_MAIN;

    /**
     * @var string
     */
    protected $model = 'products';

    /**
     * @return void
     */
    public function __construct()
    {
        $this->with('categories', Category::options());
        $this->with('brands', Brand::query()->pluck('name', 'id')->toArray());
        $this->with('badges', Badge::query()->pluck('name', 'id')->toArray());
        $this->with('config', [
            'packing' => Packing::query()->oldest('name')->get(['name', 'id'])->toArray(),
            'tastes' => Taste::query()->oldest('name')->get(['name', 'id'])->toArray(),
            'cities' => City::query()->oldest('name')->get(['name', 'id'])->toArray(),
        ]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        $model = Product::query()->findOrFail($id);

        return $this->view([
            'model' => $model,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return $this->view([
            'models' => Product::filter()->paginate($this->paginationSize()),
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return $this->view([
            'action' => $this->route('store'),
        ]);
    }

    /**
     * @param \Domain\CMS\Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->create($request->validated());

        (new SyncProductConfig($model, $request))->execute();

        return $this->redirectSuccess('show', ['product' => $model->id]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);

        $model->load([
            'packing',
            'tastes',
            'remains',
            'remains.city',
            'remains.taste',
            'remains.packing',
        ]);

        $remains = $model->remains->toArray();
        $nestedRemains = [];

        foreach ($remains as $remain) {
            $nestedRemains[$remain['city_id']][$remain['packing_id']][$remain['taste_id']] = true;
        }

        /** @var \Domain\Shop\Models\City $city */
        foreach (City::query()->get() as $city) {
            foreach ($model->packing as $packing) {
                foreach ($model->tastes as $taste) {
                    if (! isset($nestedRemains[$city->id][$packing->packing_id][$taste->taste_id])) {
                        $remains[] = [
                            'city_id' => $city->id,
                            'packing_id' => $packing->packing_id,
                            'taste_id' => $taste->taste_id,
                            'quantity' => 0,
                            'city' => $city->toArray(),
                            'packing' => $packing->packing->toArray(),
                            'taste' => $taste->taste->toArray(),
                        ];
                    }
                }
            }
        }

        return $this->view([
            'action' => $this->route('update', $model->id),
            'model' => $model,
            'config' => [
                'packing' => $model->packing->toArray(),
                'tastes' => $model->tastes->toArray(),
                'remains' => $remains,
            ],
        ]);
    }

    /**
     * @param int $id
     * @param \Domain\CMS\Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);
        $model->update($request->validated());

        (new SyncProductConfig($model, $request))->execute();

        return $this->redirectSuccess('show', ['product' => $model->id]);
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id, \Illuminate\Http\Request $request)
    {
        /** @var \Domain\Shop\Models\Product $model */
        $model = Product::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
