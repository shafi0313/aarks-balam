<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            $carts = Cart::with(['product'])->whereUser_id(user()->id)->get();
            return view('frontend.cart', compact('carts'));
        }else{
            return redirect()->route('index');
        }
    }

    public function store(Request $request)
    {
        try {
            Cart::updateOrCreate(
                [
                    'product_id' => $request->product_id,
                    'user_id' => user()->id],
                [
                    'product_id' => $request->product_id,
                    'user_id' => user()->id,
                    'quantity' => 1,
                ]);
            return response()->json(['message'=> 'Added to add to cart'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
    public function incrementStore(Request $request)
    {
        $increment = Cart::find($request->cart_id)->quantity + 1;
        try {
            Cart::find($request->cart_id)->update(['quantity' =>$increment]);
            return response()->json(['message'=> 'Incremented'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
    public function decrementStore(Request $request)
    {
        $increment = Cart::find($request->cart_id)->quantity;
        if($increment == 1){
            return response()->json(['message'=> 'Minimum Quantity 1'], 200);
        }
        try {
            Cart::find($request->cart_id)->update(['quantity' => $increment - 1]);
            return response()->json(['message'=> 'Decremented'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function show()
    {
        $datum = Cart::with(['product'])->whereUser_id(user()->id)->get();
        $carts = view('frontend.layouts.includes.cart', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $carts, 'carts']);
    }

    public function cartMenu()
    {
        $datum = Cart::with(['product'])->whereUser_id(user()->id)->get();
        $cartMenus = view('frontend.layouts.includes.cart_menu', ['datum' => $datum])->render();
        return response()->json(['status' => 'success', 'html' => $cartMenus, 'cartMenus']);
    }

    public function destroy(Request $request)
    {
        try {
            Cart::find($request->id)->delete();
            return response()->json(['message'=> 'Remove from add to cart'], 200);
        } catch (\Exception $e) {
            // return response()->json(['message'=>__('app.oops')], 500);
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            Cart::find($id)->delete();
            Alert::success('Success','Cart deleted successfully');
            return back();
        } catch (\Exception $e) {
            return back();
            Alert::success('Success','Cart delete failed');
            return back();
            // return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}
