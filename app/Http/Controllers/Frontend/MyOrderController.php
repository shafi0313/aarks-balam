<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class MyOrderController extends Controller
{
    public function index()
    {
        $orders = Order::select('id', 'user_id', 'invoice_no', 'total_price', 'order_date', 'status', 'updated_at')->with([
            'orderItems'      => fn ($q) => $q->select('id', 'order_id', 'product_id', 'quantity', 'price'),
            'orderItems.product'      => fn ($q) => $q->select('id', 'name'),
        ])->where('user_id', user()->id)
            ->latest()
            ->get();

        return view('frontend.my-order', compact('orders'));
    }

    public function cancel($foodOrderId)
    {
        $foodOrder = Order::findOrFail(Crypt::decrypt($foodOrderId));
        if ($foodOrder->status != 1) {
            Alert::info('This order already processed, so you can not cancel this order');
            return back();
        }
        $foodOrder->status = 8;

        try {
            $foodOrder->save();
            Alert::success('Order Cancelled Successfully');
        } catch (\Exception $e) {
            Alert::error('Something went wrong');
        }
        return back();
    }
}
