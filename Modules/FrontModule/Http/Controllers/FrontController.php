<?php

namespace Modules\FrontModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

    public
    function index()
    {
        $categories = $this->categoryRepo->getAllParent();
        $products = $this->productRepo->getAll();
        $featured = $this->productRepo->pro_type(1);
        $best = $this->productRepo->pro_type(2);
        $deals = $this->productRepo->pro_type(3);
        return view('frontmodule::index', compact('categories', 'products', 'featured', 'best', 'deals'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public
    function create()
    {
        return view('frontmodule::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public
    function show($id)
    {
        return view('frontmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public
    function edit($id)
    {
        return view('frontmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public
    function destroy($id)
    {
        //
    }
}
