<?php

namespace Modules\ServiceModule\Http\Controllers;

use File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\ServiceModule\Entities\CategoryService;
use Modules\ServiceModule\Repository\CategoryRepository;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    use UploaderHelper;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public $Category;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->Category = $categoryRepository;
    }

    public function index()
    {
        $categs = $this->Category->getAll();
        return view('servicemodule::categories.index', compact('categs'));
    }

    public function dataTable()
    {
        $cats = $this->Category->getAll();
        return DataTables::of($cats)
            ->addColumn('title', function ($row) {

                return $row->title;
            })
            ->addColumn('description', function ($row) {

                return strip_tags($row->description);

            })
            ->addColumn('photo', function ($row) {

                return '<img class="img" style="max-height:100px; max-width:50px;"  src="' . asset('/images/serviceCategories/' . $row->photo) . '">';
            })
            ->addColumn('status', function ($row) {

                $id = '<input id="cat_id" type="hidden" value="' . $row->id . '">';
                if ($row->status == 1) {
                    $active_num = 0;
                    $btn_font = 'fa fa-check';
                    $btn = 'btn btn-success';
                    $text = trans('commonmodule::site.active');
                } else {
                    $active_num = 1;
                    $btn_font = "fa fa-close";
                    $btn = "btn btn-danger";
                    $text = trans('commonmodule::site.unactive');
                }

                $active_hidden = '<input id="active" type="hidden" value="' . $active_num . '">';

                $active_tag = '<button id="active_tag" class="' . $btn . '"><i id="icon" class="' . $btn_font . '"></i>' . $text . '</button>';

                return $id . ' ' . $active_hidden . ' ' . $active_tag;
                return $row->status;
            })
            ->addColumn('operations', function ($row) {

                $edit = '<a  href="' . url('admin-panel/servicesCategories/' . $row->id . '/edit') . '" class="button btn btn-primary">edit</a>';
                $delete = '<a onClick="return confirm(\'are you sure\')" href="' . url('admin-panel/servicesCategories/delete/' . $row->id) . '" class="button btn btn-danger">delete</a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['photo' => 'photo', 'operations', 'edit' => 'edit', 'delete' => 'delete', 'status' => 'status'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('servicemodule::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {


        $data = $request->except('_token');

        if ($request->hasFile('photo')) {

            $photo = $this->upload($request->photo, 'serviceCategories', true);

            $data['photo'] = $photo;

        }

        CategoryService::create($data);
        return redirect()->route('servicesCategories.index')->with('success', 'data added successfully');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $cat = $this->Category->findById($id);
        return view('servicemodule::categories.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $cat = $this->Category->findById($id);
        $data = $request->except(['_token', '_method', 'photo']);
        $translatedData = $request->only('ar', 'en');

        if ($request->hasFile('photo')) {

            /*delete old photo*/
            $oldPath = public_path('/images/serviceCategories/' . $cat->photo);
            $oldPaththumb = public_path('/images/serviceCategories/thumb/' . $cat->photo);
            File::delete($oldPath, $oldPaththumb);

            $newPhoto = $this->upload($request->photo, 'serviceCategories', true);
            $data['photo'] = $newPhoto;

        }

        $this->Category->updateData($id, $data, $translatedData);

        return redirect()->route('servicesCategories.index')->with('update', 'data updated');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $cat = $this->Category->findById($id);
        /*delete  photos*/
        $path = public_path('/images/serviceCategories/' . $cat->photo);
        $thumb = public_path('/images/serviceCategories/thumb/' . $cat->photo);
        File::delete($path, $thumb);

        $cat->delete();
        return redirect()->route('servicesCategories.index')->with('delete', 'data deleted');
    }

    public function changeActive(Request $request)
    {
        $data = $request->except('_token');

        $cat = CategoryService::find($data['id']);
        $cat->update(['status' => $data['active_num']]);

        return response()->json('updated', 200);

    }
}
