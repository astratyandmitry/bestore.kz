<?php

namespace Domain\CMS\Controllers;

use Illuminate\View\View;
use Domain\Shop\Models\Taste;
use Illuminate\Http\RedirectResponse;
use Domain\CMS\Requests\TasteRequest as Request;

/**
 * @version   1.0.1
 * @author    Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2018, ArmenianBros. <i@armenianbros.com>
 */
class TastesController extends Controller
{
    /**
     * @var string
     */
    protected $section = SECTION_DICTIONARY;

    /**
     * @var string
     */
    protected $model = 'tastes';

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(int $id): View
    {
        $model = Taste::query()->findOrFail($id);

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
            'models' => Taste::filter()->paginate($this->paginationSize()),
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
     * @param \Domain\CMS\Requests\TasteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Taste $model */
        $model = Taste::query()->create($request->validated());

        return $this->redirectSuccess('show', ['taste' => $model->id]);
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        /** @var \Domain\Shop\Models\Taste $model */
        $model = Taste::query()->findOrFail($id);

        return $this->view([
            'action' => $this->route('update', $model->id),
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @param \Domain\CMS\Requests\TasteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        /** @var \Domain\Shop\Models\Taste $model */
        $model = Taste::query()->findOrFail($id);
        $model->update($request->validated());

        return $this->redirectSuccess('show', ['taste' => $model->id]);
    }

    /**
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(int $id, \Illuminate\Http\Request $request)
    {
        /** @var \Domain\Shop\Models\Taste $model */
        $model = Taste::query()->findOrFail($id);
        $model->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return $this->redirectDanger();
    }
}
