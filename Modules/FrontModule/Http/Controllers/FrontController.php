<?php

namespace Modules\FrontModule\Http\Controllers;

use Cart;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ProductModule\Entities\Product;
use Modules\ProductModule\Repository\CategoryRepository;
use Modules\ProductModule\Repository\ProductRepository;

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
        $products = $this->productRepo->getAll();
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

}
