<?php

namespace App\Repositories\Order;

use App\Models\Order;
use Auth;
use Carbon\Carbon;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    /**
    * @param object $order
    */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get all orders
     *
     * @return Object
     */
    public function getAll(): Object
    {
        return $this->order->all();
    }

    /**
     * Get orders of this month
     *
     * @return Object
     */
    public function getThisMonth(): Object
    {
        $date = Carbon::now()->format('Y/m');

        return $this->order->where('order_date', 'LIKE', $date . '%')
                           ->get();
    }

    /**
     * Get latest current user orders only 10
     *
     * @return Object
     */
    public function getCurrentUserOrders(): Object
    {
        return $this->order->with('order_details')->where('user_id', Auth::id())->orderBy('id', 'DESC')->limit(10)->get();
    }

    /**
     * Find an order with coupon by order id
     *
     * @return Object
     */
    public function findOrderWithCoupon($id): Object
    {
        return $this->order->with('coupon')->find($id);
    }

    /**
     * Get orders that status is 0
     *
     * @return Object
     */
    public function getPendingOrders(): Object
    {
        return $this->order->where('status', '=', '0')->get();
    }

    /**
     * Get orders that status is 1
     *
     * @return Object
     */
    public function getAcceptedOrders(): Object
    {
        return $this->order->where('status', '=', '1')->get();
    }

    /**
     * Get orders that status is 2
     *
     * @return Object
     */
    public function getProcessOrders(): Object
    {
        return $this->order->where('status', '=', '2')->get();
    }

    /**
     * Get orders that status is 3
     *
     * @return Object
     */
    public function getDeliveredOrders(): Object
    {
        return $this->order->where('status', '=', '3')->get();
    }

    /**
     * Get orders of current user that status is 3
     *
     * @return Object
     */
    public function getDeliveredOrdersOfAuth(): Object
    {
        return $this->order->where('user_id', Auth::id())->where('status', '=', '3')->orderBy('id', 'DESC')->limit(5)->get();
    }

    /**
     * Get orders that status is 4
     *
     * @return Object
     */
    public function getCancelOrders(): Object
    {
        return $this->order->where('status', '=', '4')->get();
    }

    /**
     * Get an order with user info by order id
     *
     * @param String $id
     * @return Order
     */
    public function getOrderByOrderId($id): Order
    {
        return $this->order->with('user:id,name,phone')
                           ->with('shipping')
                           ->where('id', '=', $id)
                           ->first();
    }

    /**
     * Get today's pendding orders
     *
     * @return Object
     */
    public function getTodaysOrders(): Object
    {
        return $this->order->where('status', '=', 0)
                           ->where('order_date', '=', Date('Y/m/d'))
                           ->get();
    }

    /**
     * Get today's delivered orders
     *
     * @return Object
     */
    public function getTodaysDeliveredOrders(): Object
    {
        return $this->order->where('status', '=', 3)
                           ->where('order_date', '=', Date('Y/m/d'))
                           ->get();
    }

    /**
     * Get delivered orders of this month
     *
     * @return Object
     */
    public function getDeliveredOrdersOfThisMonth(): Object
    {
        $date = Carbon::now()->format('Y/m');

        return $this->order->where('status', '=', 3)
                           ->where('order_date', 'LIKE', $date . '%')
                           ->get();
    }

    /**
     * Get orders that return status is 1
     *
     * @return Object
     */
    public function getReturnStatusRequest(): Object
    {
        return $this->order->where('return_status', '=', '1')
                           ->get();
    }

    /**
     * Get orders that return status is 2
     *
     * @return Object
     */
    public function getApprovedReturnRequest(): Object
    {
        return $this->order->where('return_status', '=', '2')
                           ->get();
    }

    /**
     * Search orders
     *
     * @param Array $keywords
     * @return Object
     */
    public function searchOrders($keywords): Object
    {
        $query = $this->order;
        $order_date_from = str_replace('-', '/', $keywords['order_date_from']);
        $order_date_to = str_replace('-', '/', $keywords['order_date_to']);
        $subtotal = $keywords['subtotal'];
        $total = $keywords['total'];

        if (!empty($order_date_from) && !empty($order_date_to)) {
            $query = $query->whereBetween('order_date', [$order_date_from, $order_date_to]);
        } else if (!empty($order_date_from)) {
            $query = $query->where('order_date', '>=', $order_date_from);
        } else if (!empty($order_date_to)) {
            $query = $query->where('order_date', '<=', $order_date_to);
        }

        if (!empty($keywords['transaction'])) {
            $query = $query->where('balance_transaction', '=', $keywords['transaction']);
        }

        if (!empty($keywords['payment'])) {
            $query = $query->whereIn('payment_type', $keywords['payment']);
        }

        if (!empty($keywords['status'])) {
            $query = $query->whereIn('status', $keywords['status']);
        }

        if (!empty($subtotal)) {
            $query = $this->searchPrice($query, $subtotal, 'subtotal');
        }

        if (!empty($total)) {
            $query = $this->searchPrice($query, $total, 'total');
        }

        return $query->get();
    }

    /**
     * Search price by foreach
     *
     * @param Object $query
     * @param Array $data
     * @param String $db_name
     * @return Object
     */
    public function searchPrice($query, $data, $db_name): Object
    {
        return $query->where(function($query) use ($data, $db_name) {
            foreach ($data as $price) {
                switch ($price) {
                    case 'max2000':
                        $query = $query->where($db_name, '<=', 2000);
                        break;
                    case 'max5000':
                        $query = $query->orWhereBetween($db_name, [2000, 5000]);
                        break;
                    case 'max10000':
                        $query = $query->orWhereBetween($db_name, [5000, 10000]);
                        break;
                    case 'over10000':
                        $query = $query->orWhere($db_name, '>=', 10000);
                        break;
                }
            }
        });
    }

    /**
     * Change status to 1
     *
     * @param String $id
     * @return Bool
     */
    public function changeCompletedPaymentStatus($id): Bool
    {
        return $this->order->find($id)->update(['status' => '1']);
    }

    /**
     * Change status to 2
     *
     * @param String $id
     * @return Bool
     */
    public function changeProcessStatus($id): Bool
    {
        return $this->order->find($id)->update(['status' => '2']);
    }

    /**
     * Change status to 3
     *
     * @param String $id
     * @return Bool
     */
    public function changeDeliveryStatus($id): Bool
    {
        return $this->order->find($id)->update(['status' => '3']);
    }

    /**
     * Change status to 4
     *
     * @param String $id
     * @return Bool
     */
    public function changeCancelStatus($id): Bool
    {
        return $this->order->where('id', '=', $id)->update(['status' => '4']);
    }

    /**
     * Change return status to 1
     *
     * @param String $id
     * @return Bool
     */
    public function changeWorkingReturnStatus($id): Bool
    {
        return $this->order->where('id', '=', $id)->update(['return_status' => '1']);
    }

    /**
     * Change return status to 2
     *
     * @param String $id
     * @return Bool
     */
    public function updateReturnRequest($id): Bool
    {
        return $this->order->where('id', '=', $id)->update(['return_status' => '2']);
    }
}
