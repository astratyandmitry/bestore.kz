<?php

namespace Domain\Shop\Controllers;

use Domain\Shop\Repositories\BasketRepository;
use Domain\Shop\Repositories\OrdersRepository;
use Domain\Shop\Requests\OrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Domain\Shop\Mails\OrderMail;

/**
 * @version 1.0.1
 * @author Astratyan Dmitry <astratyandmitry@gmail.com>
 * @copyright 2020, ArmenianBros. <i@armenianbros.com>
 */
class OrderCheckoutController extends Controller
{
    /**
     * @param \Domain\Shop\Requests\OrderRequest $request
     * @param \Domain\Shop\Repositories\OrdersRepository $ordersRepository
     * @param \Domain\Shop\Repositories\BasketRepository $basketRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(
        OrderRequest $request,
        OrdersRepository $ordersRepository,
        BasketRepository $basketRepository
    ): RedirectResponse {
        $order = $ordersRepository->create($request, app('basket'));

        $basketRepository->clear();

        Mail::to($request->email)->send(new OrderMail($order));
        Mail::to(config('shop.contact.email'))->send(new OrderMail($order));

        return redirect()->to(
            auth(SHOP_GUARD)->guest() ? $order->detailUrl() : $order->url()
        );
    }
}
