<?php

namespace Modules\ProductModule\Http\Controllers;

use File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\ProductModule\Repository\CategoryRepository;


class CategoriesController extends Controller
{
    use UploaderHelper;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public $categoryRepo;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    public function index()
    {
        $categs = $this->categoryRepo->getAll();
        return view('productmodule::categories.index', compact('categs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $categories = $this->categoryRepo->getAll();
        return view('productmodule::categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        if ($request->parent_id == 0) {
            $request_data = $request->except('_token', '_wysihtml5_mode', 'photo', 'parent_id');
        } else {
            $request_data = $request->except('_token', '_wysihtml5_mode', 'photo');
        }

        if ($request->hasFile('photo')) {

            $image = $this->upload($request->photo, 'categories', true);
            $request_data['photo'] = $image;

        }
        $this->categoryRepo->save($request_data);

        return redirect()->route('categories.index')->with('success', 'data added successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('productmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cat = $this->categoryRepo->findByID($id);
        $categories = $this->categoryRepo->getAll();

        return view('productmodule::categories.edit', compact('cat', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $cat = $this->categoryRepo->findByID($id);

        if ($request->parent_id == 0) {
            $data = $request->except('_token', '_method', 'parent_id', '_wysihtml5_mode', 'ar', 'en');
            $data['parent_id'] = null;
        } else {
            $data = $request->except('_token', '_method', '_wysihtml5_mode', 'ar', 'en');

        }
        $cat_trans = $request->only('ar', 'en');


        if ($request->hasFile('photo')) {

//            delete old photo

            $oldPath = public_path('/images/categories/' . $cat->photo);
            $oldThumbPath = public_path('/images/categories/thumb/' . $cat->photo);

            $this->categoryRepo->deleteOldPhoto($id, $oldPath, $oldThumbPath);

//            upload new photo
            $image = $this->upload($request->photo, 'categories', true);
            $data['photo'] = $image;
        }
        $category = $this->categoryRepo->update($id, $data, $cat_trans);

        return redirect()->route('categories.index')->with('update', 'data updated sucessfully');


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $cat = $this->categoryRepo->findByID($id);
        if ($cat->photo) {
            $path = public_path('/images/categories/' . $cat->photo);
            $thumbPath = public_path('/images/categories/thumb/' . $cat->photo);

            $this->categoryRepo->deleteOldPhoto($id, $path, $thumbPath);
        }

        $this->categoryRepo->delete($id);

        return redirect()->route('categories.index')->with('delete', 'data deleted successfully');


    }

    public function active($id)
    {


        $cat = $this->categoryRepo->findByID($id);

        $cat->update(['status' => 1]);

        return redirect()->back()->with('update', 'data updated');

    }

    public function unactive($id)
    {

        $cat = $this->categoryRepo->findByID($id);

        $cat->update(['status' => 0]);

        return redirect()->back()->with('update', 'data updated');

    }

    public function filter(Request $request)
    {


        $type = $request->type;
        if ($type == 'all') {
            $categs = $this->categoryRepo->getAll();
        } elseif ($type == 'parent') {
            $categs = $this->categoryRepo->getAllParent();

        } else {
            $categs = $this->categoryRepo->getAllChildren();
        }

        $view = View::make('productmodule::categories.category_table', array('categs' => $categs))->render();
        return response()->json($view, 200);


    }


}
