<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\OrdersRepository;
use Domain\Shop\Models\Page;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class OrderDetailController extends Controller
{
    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @param \Domain\Shop\Repositories\OrdersRepository $repository
     * @return \Illuminate\View\View
     */
    public function __invoke(string $id, Request $request, OrdersRepository $repository): View
    {
        $order = $repository->findByUuidAndId($id, $request->get('uuid'));

        abort_if($order === null, redirect()->route('shop::home'));

        $this->setup(PAGE_ACCOUNT_ORDER)->hideBreadcrumbs();

        return $this->view('order.detail', [
            'order' => $order,
        ]);
    }
}
