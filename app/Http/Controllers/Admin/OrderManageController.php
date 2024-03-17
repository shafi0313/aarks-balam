<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Ledger;
use App\Models\Product;
use App\Models\FoodOrder;
use App\Models\OrderItem;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Models\FoodOrderItem;
use App\Models\FoodIngredient;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class OrderManageController extends Controller
{
    public function index(Request $request)
    {
        // if ($error = $this->authorize('branch-manage')) {
        //     return $error;
        // }

        if ($request->ajax()) {
            $orders = Order::with([
                'user'      => fn ($q) => $q->select('id', 'name'),
                'orderItems'      => fn ($q) => $q->select('id', 'order_id', 'quantity', 'price'),
                'orderItems.product' => fn ($q) => $q->select('id', 'name', 'price', 'vat'),
            ])
                ->latest();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('order_date', function ($row) {
                    return bdDate($row->order_date);
                })
                ->addColumn('payment', function ($row) {
                    if ($row->pay_amount) {
                        return nF2($row->pay_amount);
                    } else {
                        return '<span class="badge bg-danger">Due</span>';
                    }
                })
                ->addColumn('amount', function ($row) {
                    return nF2($row->shipping + $row->total_price);
                })
                ->addColumn('customer_type', function ($row) {
                    return customerType((int)$row->customer_type);
                })
                ->addColumn('status', function ($row) {
                    return orderStatus((int)$row->status);
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if ($row->status == 1) {
                        $btn .= '<span data-route="' . route('admin.order_manages.accept', $row->id) . '" data-value="' . $row->id . '" class="accept icon-btn me-2" title="Accept">
                                <i class="fa-regular fa-circle-check text-primary"></i>
                            </span>';
                    }
                    $btn .= '<span data-route="' . route('admin.order_manages.reject', $row->id) . '" data-value="' . $row->id . '" class="reject icon-btn me-2" title="Reject">
                                <i class="fa-regular fa-circle-xmark text-danger"></i>
                            </span>';

                    return $btn;
                })
                ->rawColumns(['payment', 'order_date', 'status', 'customer_type', 'created_at', 'action'])
                ->make(true);
        }
        return view('admin.order-manage.index');
    }

    public function edit($id)
    {
        $foodOrder = Order::with([
            'table'               => fn ($q) => $q->select('id', 'name'),
            'customer'            => fn ($q) => $q->select('id', 'name'),
            'createdBy'           => fn ($q) => $q->select('id', 'name'),
            'foodOrderItems'      => fn ($q) => $q->select('id', 'food_order_id', 'food_id', 'quantity', 'price'),
            'foodOrderItems.food' => fn ($q) => $q->select('id', 'branch_id', 'name', 'price', 'vat'),
        ])
            ->findOrFail($id);
        return view('admin.order-manage.edit', compact('foodOrder'));
    }

    public function accept($orderId)
    {
        Order::findOrFail($orderId)->update(['status' => 2]);
        try {
            return response()->json(['message' => 'Order accepted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again.'], 500);
        }
    }

    public function reject($orderId)
    {
        Order::findOrFail($orderId)->update(['status' => 9]);
        try {
            return response()->json(['message' => 'Order rejected successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Oops something went wrong, Please try again.'], 500);
        }
    }
}
