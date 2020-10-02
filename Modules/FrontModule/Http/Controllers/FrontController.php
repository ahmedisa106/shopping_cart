<?php

namespace Modules\FrontModule\Http\Controllers;

use Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\OrderModule\Entities\Order;
use Modules\ProductModule\Entities\Product;
use Modules\ProductModule\Repository\CategoryRepository;
use Modules\ProductModule\Repository\ProductRepository;
use Modules\UserModule\Entities\User;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public $categoryRepo;
    public $productRepo;


    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->categoryRepo = $categoryRepository;
        $this->productRepo = $productRepository;

    }

    public function index()
    {
        $categories = $this->categoryRepo->getAllParent();
        $products = $this->productRepo->getAllActive();
        $featured = $this->productRepo->pro_type(1);
        $best = $this->productRepo->pro_type(2);
        $deals = $this->productRepo->pro_type(3);
        return view('frontmodule::index', compact('categories', 'products', 'featured', 'best', 'deals'));
    }

    public function addToCart(Request $request, $id)
    {

//        if ($request->ajax()) {
//
//            $product = $this->productRepo->getById($id);
//            if (Cart::get($product->id)['id'] == $id) {
//                Cart::remove($id);
//                $cc = Cart::getContent()->count();
//                return response()->json($cc, '401');
//            } else {
//                Cart::add(array(
//                    'id' => $product->id,
//                    'name' => $product->title,
//                    'price' => $product->sell_price,
//                    'quantity' => 1,
//                    'attributes' => array()
//
//
//                ));
//                $cc = Cart::getContent()->count();
//
//                return response()->json($cc, '200');
//            }
//
//        }

        $product = Product::find($id);

        if (Cart::get($product->id)['id'] == $id) {

            Cart::remove($id);
            return redirect('/')->with('delete', 'data removed');
        } else {
            Cart::add(array(
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->sell_price,
                'quantity' => 1,
                'attributes' => array()

            ));

        }

        return redirect('/')->with('success', 'data added successfully');


    }

    public function showWishList($id)
    {
        $categories = $this->categoryRepo->getAllParent();

        $user = User::find($id);
        $favorites = $user->favorite(Product::class);

        return view('frontmodule::pages.wishlist', compact('favorites', 'categories'));
    }

    public function addToWishList($id)
    {

        $user = Auth::user();
        $product = Product::find($id);
        $user->toggleFavorite($product);

        return redirect()->back();


    }


    public function makeOrder(Request $request)
    {

        $data = $request->except(['_token', '_method']);

        $product = Product::whereIn('id', $data['products'] ?? [])->get();

        $orderProduct = [];
        $subtotal = 0;
        foreach ($request->products as $key => $id) {

            $price = $product->where('id', $id)->first()->sell_price * $data['quantity'][$key];
            $quantity = $product->where('id', $id)->first()->current_quantity - $data['quantity'][$key];
            if ($quantity == 0) {
                $product->where('id', $id)->first()->update(['active' => 0]);

            }
            $product->where('id', $id)->first()->update(['current_quantity' => $quantity]);
            $subtotal += $price;
            $orderProduct[] = [
                'product_id' => $id,
                'quantity' => $data['quantity'][$key] ?? 0,
                'total_price' => $price,
            ];


        }
        $order = Order::create([
            "user_id" => \auth()->user()->id ?? null,
            "total" => $subtotal,
        ]);

        $order->orderProducts()->createmany($orderProduct);
        Cart::clear();

        return redirect('/');


    }


}
