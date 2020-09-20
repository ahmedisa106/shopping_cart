<?php

namespace Modules\CartModule\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CartModule\Entities\Cart;
use Modules\ProductModule\Entities\Category;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $carts = Cart::where('user_id', auth()->user()->id)->get();
        $categories = Category::with('translations')->get();
        return view('frontmodule::pages.cart', compact('carts', 'categories'));

    }
}
