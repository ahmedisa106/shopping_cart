<?php

namespace Modules\CartModule\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductModule\Entities\Category;
use Modules\ProductModule\Entities\Product;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $categories = Category::with('translations')->get();
        $cartContent = Cart::getContent();

        return view('frontmodule::pages.cart', compact('categories', 'cartContent'));

    }

    public function removeItem($id)
    {

        $product = Product::find($id);
        if (Cart::get($product->id)['id'] == $id) {
            Cart::remove($id);
        }
        return redirect()->back();

//        if ($request->ajax()) {
//            $product = Product::find($request->id);
//
//
//            if (Cart::get($product->id)['id'] == $request->id) {
//                Cart::remove($request->id);
//
//
//            }
//
//        }


    }

    public function updateItem(Request $request)
    {

        if ($request->ajax()) {


            $product = Product::find($request->id);

            Cart::update($request->id, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity,
                ),
            ));
            $total = Cart::getTotal();


            return response()->json([
                'data' => $total,
                'status' => '200',

            ]);

        }
    }
}
