<?php

namespace Modules\ProductModule\Http\Controllers;

use File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\ProductModule\Entities\ProductPhoto;
use Modules\ProductModule\Repository\CategoryRepository;
use Modules\ProductModule\Repository\ProductRepository;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    use UploaderHelper;

    public $catRepo;
    public $productRepo;

    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        $this->catRepo = $categoryRepository;
        $this->productRepo = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepo->getAll();
        $status = -1;
        return view('productmodule::products.index', compact('products', 'status'));
    }

    public function actived(Request $request)
    {
        $products = $this->productRepo->findAllActive($request->status);

        return view('productmodule::products.index', ['products' => $products, 'status' => $request->status]);


    }

    public function dataTable(Request $request)
    {
        $status = $request->status;
        if ($status != -1)
            $products = $this->productRepo->findAllActive($status);
        else
            $products = $this->productRepo->getAll();

        return DataTables::of($products)
            ->addColumn('title', function ($row) {
                return $row->title;

            })
            ->addColumn('photo', function ($row) {

                return '<img class="img img-thumbnail" style="max-width:100px; max-height:100px;" src="' . asset('/images/products/' . $row->photo) . '">';

            })
            ->addColumn('categories', function ($row) {
                $cats = '';
                foreach ($row->categories as $cat) {

                    $cats .= $cat->title . '-';

                }

                return trim($cats, '-');

            })
            ->addColumn('active', function ($row) {
                $product_id = '<input type="hidden" id="product_id" value="' . $row->id . '">';
                if ($row->active == 1) {
                    $active_num = 0;
                    $btn_font = "fa fa-check";
                    $btn = "btn btn-success";
                    $text = trans('commonmodule::site.active');
                } else {
                    $active_num = 1;
                    $btn_font = "fa fa-close";
                    $btn = "btn btn-danger";
                    $text = trans('commonmodule::site.unactive');

                }
                $active_hidden = '<input type="hidden" name="active" id="active" value=' . $active_num . ' />';

                $active_tag = '<button type="button" id="updateActive" class="' . $btn . '"><i id="icon" class="' . $btn_font . '" aria-hidden="true">' . ' ' . $text . '</i> </button>';

                return $product_id . $active_hidden . '  ' . $active_tag;
            })
            ->addColumn('operations', function ($row) {

                $edit = '<a class="button btn btn-primary" href="' . url('admin-panel/products/' . $row->id . '/edit') . '"><i class="fa fa-edit"></i></a>';
                $delete = '<a class="button  btn btn-danger"  href="' . url('admin-panel/products/delete/' . $row->id) . '" onclick="return confirm(\'are you sure ! \')" ><i class=" fa fa-trash"></i></a>';
                $album = '<a class="button btn btn-warning" href="' . url('admin-panel/products/showAlbum/' . $row->id) . '"><i class="fa fa-file-picture-o"></i></a>';

                return $edit . ' ' . $album . ' ' . $delete;
            })
            ->rawColumns(['edit' => 'edit', 'delete' => 'delete', 'photo' => 'photo', 'operations' => 'operations', 'active' => 'active'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = $this->catRepo->getAllParent();
        return view('productmodule::products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request_data = $request->except(['_token', 'photo', 'photos', 'product_cats']);

        $request->validate([
            'product_cats' => 'required',
        ]);

        $product_cats = $request->product_cats;
        if ($request->hasFile('photo')) {

            $photo_path = $this->upload($request->photo, 'products', true);
            $request_data['photo'] = $photo_path;
        }

        $product_photos = [];
        if ($request->hasFile('photos')) {

            $photos = $request->photos;
            $product_photos = $this->uploadAlbum($photos, 'product_photos');
            $request_data['photos'] = $product_photos;
        }

        $this->productRepo->save($request_data, $product_photos, $product_cats);
        return redirect()->route('products.index')->with('success', 'data added successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function showAlbum($id)
    {
        $product = $this->productRepo->getById($id);
        return view('productmodule::products.showAlbum', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $product = $this->productRepo->getById($id);
        $categories = $this->catRepo->getAllParent();
        return view('productmodule::products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {

        $product = $this->productRepo->getById($id);
        $request_data = $request->except(['_method', '_token', 'photo', 'product_cats', 'ar', 'en']);

        $locale = $request->only('ar', 'en');
        $cats = $request->product_cats;


        if ($request->hasFile('photo')) {
            /*delete old photo*/
            $oldPath = public_path('/images/products/' . $product->photo);
            $oldThumbPPath = public_path('/images/products/thumb/' . $product->photo);
            File::delete($oldPath, $oldThumbPPath);

            $image = $this->upload($request->photo, 'products', true);
            $request_data['photo'] = $image;

        }

        $this->productRepo->updateData($id, $request_data, $locale, $cats);

        return redirect()->route('products.index')->with('update', 'data updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $product = $this->productRepo->getById($id);
        /*delete old photo*/

        $this->productRepo->deleteOldPhoto($id, 'products');

        /*delete the Album of Photos*/
        $this->productRepo->deleteOldAlbum($id, $product);

        $product->delete();
        return redirect()->route('products.index')->with('delete', 'data updated successfully');

    }

    public function addToAlbum(Request $request)
    {

        $product = $this->productRepo->getById($request->product_id);

        if ($request->hasFile('album')) {
            $album = [];
            $photos = $request->album;
            $album = $this->uploadAlbum($photos, 'product_photos');

            $this->productRepo->productPhotoRepo->save($product, $album);

        }
        return redirect()->back();
    }

    public function deletePhoto($id)
    {
        $photo = ProductPhoto::find($id);
        $path = public_path('/images/product_photos/' . $photo->photos);
        $ThumpPath = public_path('/images/product_photos/thumb/' . $photo->photos);

        File::delete($path, $ThumpPath);

        $photo->delete();

        return redirect()->back()->with('delete', 'data deleted successfully');
    }

    public function unActive($id)
    {

        $product = $this->productRepo->getById($id);
        $product->update(['active' => 0]);
        return redirect()->route('products.index')->with('update', 'data updated successfully');

    }

    public function active(Request $request)
    {
        try {


            $this->productRepo->updateActive($request->id, $request->active);
            return response()->json('updated', 200);
        } catch (\Exception $exception) {
            return response()->json('error', 422);

        }

    }
}
