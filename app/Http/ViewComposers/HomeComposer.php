<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Order\OrderRepositoryInterface as OrderRepo;

/**
 * Class StripeComposer
 * @package App\Http\ViewComposers
 */
class HomeComposer
{
    protected $order_repo;

    public function __construct(OrderRepo $order_repo)
    {
        $this->order_repo = $order_repo;
    }

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $orders = $this->order_repo->getCurrentUserOrders();

        $view->with(compact([
            'orders',
        ]));
    }
}
