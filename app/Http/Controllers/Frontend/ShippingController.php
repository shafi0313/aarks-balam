<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Food;
use App\Models\User;
use App\Models\Product;
use App\Models\FoodOrder;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;
use App\Models\FoodOrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ShippingController extends Controller
{
    public function store(Request $request)
    {
        // Previous Session Delete
        // $request->session()->forget('food_ids');
        $request->session()->forget('food_id');
        $request->session()->forget('quantity');

        // Session Store
        $request->session()->put('food_id', $request->food_id);
        $request->session()->put('quantity', $request->quantity);
        return redirect()->route('frontend.shipping.index');
    }

    public function index(Request $request)
    {
        $food                 = Food::whereId($request->session()->get('food_id'))->first();
        $priceWithoutDiscount = $food->price * $request->session()->get('quantity');
        $discount             = $request->session()->get('quantity') * ($food->price * $food->discount / 100);
        $priceWithDiscount    = $food->price - $food->price * $food->discount / 100;

        $totalPrice           = $priceWithoutDiscount * $request->session()->get('quantity');
        return view('frontend.shipping', compact('product', 'priceWithoutDiscount', 'priceWithDiscount', 'discount', 'totalPrice'));
    }



    // Multiple shipping
    public function multipleStore(Request $request)
    {
        // Previous Session Delete
        // $request->session()->forget('food_ids');
        $request->session()->forget('food_id');
        $request->session()->forget('quantity');
        // Session Store
        $request->session()->put('food_id', $request->food_id);
        $request->session()->put('quantity', $request->quantity);

        return redirect()->route('frontend.shipping.shippingMulti');
    }

    public function shippingMulti(Request $request)
    {
        $food_ids = $request->session()->get('food_id');
        if (!$food_ids) {
            return redirect()->route('frontend.index');
        }
        $foods = Food::whereIn('id', $food_ids)->get(['id', 'price', 'discount']);

        $deliveryAreas = DeliveryArea::orderBy('name')->get();

        $priceWithoutDiscount = $discount = $priceWithDiscount = 0;
        foreach ($foods as $i => $food) {
            $priceWithoutDiscount += $food->price - ($food->price * $food->discount / 100);
            $discount             += $food->price * $food->discount / 100;
            $priceWithDiscount    += $food->price;
        }

        return view('frontend.cart-checkout', compact('foods', 'priceWithoutDiscount', 'discount', 'priceWithDiscount', 'deliveryAreas'));
    }

    public function confirm(Request $request)
    {
        $this->validate($request, [
            'name'             => ['required', 'string', 'min:5', 'max:80'],
            'email'            => ['required', 'string', 'min:5', 'max:80'],
            'phone'            => ['required', 'string', 'min:10', 'max:30'],
            'address'          => ['required', 'string', 'min:5', 'max:255'],
            'delivery_area_id' => ['required', 'exists:delivery_areas,id'],
        ]);

        User::updateOrCreate(
            ['id' => user()->id],
            [
                'name'             => $request->name,
                'email'            => $request->email,
                'phone'            => $request->phone,
                'address'          => $request->address,
                'delivery_area_id' => $request->delivery_area_id,
            ]
        );
        $food_ids             = $request->session()->get('food_id');
        $quantity             = $request->session()->get('quantity');
        $foods                = Food::whereIn('id', $food_ids)->get();
        $priceWithoutDiscount = $discount = $priceWithDiscount = 0;

        foreach ($foods as $key => $food) {
            $price = $food->price * $quantity[$key];
            $priceWithoutDiscount += $price - ($price * $food->discount / 100);
            $discount             += $price * $food->discount / 100;
            $priceWithDiscount    += $price;
        }

        $branchId   = DeliveryArea::findOrFail(user()->delivery_area_id)->value('branch_id');
        $tran_id    = transaction_id('OFO');
        $invoice_no = FoodOrder::max('invoice_no') + 1;
        $orderDate  = now();
        DB::beginTransaction();
        $foodOrderInfo = FoodOrder::create([
            'branch_id'     => 1,
            'customer_id'   => user()->id,
            'tran_id'       => $tran_id,
            'customer_type' => 2,             // Online Customer
            'invoice_no'    => $invoice_no,
            // 'discount_type' => $foodOrder->discount_type,
            'discount' => $discount,
            // 'tax'           => $foodOrder->tax_amount,
            'shipping'    => 60,
            'total_price' => $priceWithoutDiscount,
            'order_date'  => $orderDate,
            'status'      => 1,
            'note'        => $request->note,
        ]);

        foreach ($foods as $key => $food) {
            $data['food_order_id'] = $foodOrderInfo->id;
            $data['food_id']       = $food->id;
            $data['tran_id']       = $tran_id;
            $data['quantity']      = $quantity[$key];
            $data['price']         = $food->price;
            FoodOrderItem::create($data);
        }

        Cart::where('user_id', user()->id)->delete();

        try {
            DB::commit();
            return redirect()->route('frontend.index')->with('alertSuccess', 'Order Successfully Created');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', ('Something Went Wrong, Please Try Again'));
            // return back();
        }
    }
}
