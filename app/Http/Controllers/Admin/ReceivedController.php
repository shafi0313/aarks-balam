<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\FoodOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ReceivedController extends Controller
{
    public function receive($orderId)
    {
        $orderId = Order::findOrFail($orderId);
        $orderId->update([
            'pay_amount' => $orderId?->shipping + $orderId->total_price,
        ]);

        Alert::success('Success', 'Payment received successfully');
        return back();
    }
}
