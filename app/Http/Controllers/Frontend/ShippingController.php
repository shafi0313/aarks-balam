<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\FoodOrder;
use App\Models\OrderItem;
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
        // $request->session()->forget('product_ids');
        $request->session()->forget('product_id');
        $request->session()->forget('quantity');

        // Session Store
        $request->session()->put('product_id', $request->product_id);
        $request->session()->put('quantity', $request->quantity);
        return redirect()->route('frontend.shipping.index');
    }

    public function index(Request $request)
    {
        $food                 = Product::whereId($request->session()->get('product_id'))->first();
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
        // $request->session()->forget('product_ids');
        $request->session()->forget('product_id');
        $request->session()->forget('quantity');
        // Session Store
        $request->session()->put('product_id', $request->product_id);
        $request->session()->put('quantity', $request->quantity);

        return redirect()->route('frontend.shipping.shippingMulti');
    }

    public function shippingMulti(Request $request)
    {
        $product_ids = $request->session()->get('product_id');
        if (!$product_ids) {
            return redirect()->route('index');
        }
        $products = Product::whereIn('id', $product_ids)->get(['id', 'price']);

        $priceWithoutDiscount = $discount = $priceWithDiscount = 0;
        foreach ($products as $i => $product) {
            $priceWithoutDiscount += $product->price - ($product->price * $product->discount / 100);
            $discount             += $product->price * $product->discount / 100;
            $priceWithDiscount    += $product->price;
        }

        return view('frontend.cart-checkout', compact('products', 'priceWithoutDiscount', 'discount', 'priceWithDiscount'));
    }

    public function confirm(Request $request)
    {
        $this->validate($request, [
            'name'    => ['required', 'string', 'max:80'],
            'email'   => ['required', 'string', 'max:80'],
            'phone'   => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255']
        ]);
        DB::beginTransaction();

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
        $product_ids = $request->session()->get('product_id');
        $quantity    = $request->session()->get('quantity');
        $products    = Product::whereIn('id', $product_ids)->get();
        $invoice_no  = Order::max('invoice_no') + 1;
        $orderDate   = now();

        $orderInfo = Order::create([
            'user_id'     => user()->id,
            'invoice_no'  => $invoice_no,
            'total_price' => $request->total_price,
            'discount'    => $request->discount,
            'shipping'    => 60,
            'order_date'  => $orderDate,
            'status'      => 1,
            'note'        => $request->note,
        ]);

        foreach ($products as $key => $product) {
            $data['order_id']   = $orderInfo->id;
            $data['product_id'] = $product->id;
            $data['quantity']   = $quantity[$key];
            $data['price']      = $product->price;
            OrderItem::create($data);
        }

        Cart::where('user_id', user()->id)->delete();

        try {
            DB::commit();
            Alert::success('Success', 'Order Successfully Created');
            return redirect()->route('index');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Something went wrong');
            return back();
        }
    }
}
