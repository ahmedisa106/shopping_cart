<?php

namespace Modules\ServiceModule\Http\Controllers;

use File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Helper\UploaderHelper;
use Modules\ServiceModule\Entities\CategoryService;
use Modules\ServiceModule\Entities\Service;
use Modules\ServiceModule\Repository\ServiceRepository;
use Yajra\DataTables\DataTables;

class ServicesController extends Controller
{
    use UploaderHelper;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public $services;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->services = $serviceRepository;
    }

    public function index()
    {
        return view('servicemodule::services.index');
    }


    public function dataTable()
    {
        $services = Service::all();
        return DataTables::of($services)
            ->addColumn('title', function ($row) {
                return $row->title;

            })
            ->addColumn('description', function ($row) {

                return strip_tags($row->description);
            })
            ->addColumn('photo', function ($row) {
                return '<img style="max-width:100px; max-height:50px;" src="' . asset('/images/services/' . $row->photo) . '">';

            })
            ->addColumn('cover', function ($row) {
                return '<img style="max-width:100px; max-height:50px;" src="' . asset('/images/services/' . $row->cover) . '">';

            })
            ->addColumn('status', function ($row) {
                $id = '<input type="hidden" value="' . $row->id . '" id="service_id">';

                if ($row->status == 1) {
                    $btn = 'btn btn-success';
                    $font = 'fa fa-check';
                    $active_number = 0;
                    $text = 'active';

                } else {
                    $btn = 'btn btn-danger';
                    $font = 'fa fa-close';
                    $active_number = 1;
                    $text = 'in Active';
                }
                $active = '<input type="hidden" value="' . $active_number . '" id="active">';
                $button = '<button id="status" type="button" class="  ' . $btn . '" value="' . $text . '"><i id="icon" class="' . $font . '"></i> ' . $text . '</button>';

                return $id . '' . $active . '' . $button;

            })
            ->addColumn('operations', function ($row) {

                $edit = '<a href="' . route('services.edit', $row->id) . '" class="button btn btn-primary">edit</a>';
                $delete = '<a onClick="return confirm(\'are you sure !\')" href="' . url('admin-panel/services/delete/' . $row->id) . '" class="button btn btn-danger">delete</a>';

                return $edit . ' ' . $delete;

            })
            ->rawColumns(['edit' => 'edit', 'delete' => 'delete', 'photo' => 'photo', 'cover' => 'cover', 'operations' => 'operations', 'status'])
            ->make(true);


    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $cats = CategoryService::with('translations')->get();
        return view('servicemodule::services.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $data = $request->except(['_token', 'photo', 'cover']);

        if ($request->hasFile('photo')) {
            $photo = $this->upload($request->photo, 'services', true);
            $data['photo'] = $photo;

        }
        if ($request->hasFile('cover')) {
            $cover = $this->upload($request->cover, 'services', true);
            $data['cover'] = $cover;

        }

        Service::create($data);
        return redirect()->route('services.index')->with('success', 'data added');
        return $request->all();
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $cats = CategoryService::with('translations')->get();
        $service = Service::find($id);
        return view('servicemodule::services.edit', compact('service', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        $data = $request->except(['_token', '_method', 'photo', 'cover']);
        $dataTranslations = $request->only('ar', 'en');
        if ($request->hasFile('photo')) {
            /*delete old photo */
            $path = public_path('/images/services/' . $service->photo);
            $thumb = public_path('/images/services/thumb/', $service->photo);
            File::delete($path, $thumb);

            /*store new photo*/

            $photo = $this->upload($request->photo, 'services', true);
            $data['photo'] = $photo;

        }
        if ($request->hasFile('cover')) {
            /*delete old photo */
            $path = public_path('/images/services/' . $service->photo);
            $thumb = public_path('/images/services/thumb/', $service->photo);
            File::delete($path, $thumb);

            /*store new photo*/

            $cover = $this->upload($request->cover, 'services', true);
            $data['cover'] = $cover;

        }

        $this->services->updateData($id, $data, $dataTranslations);

        return redirect()->route('services.index')->with('update', 'data updated');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        /*delete old photo*/

        $photoPath = public_path('/images/services/' . $service->photo);
        $photoPathThumb = public_path('/images/services/thumb/' . $service->photo);

        /*delete old cover*/

        $coverPath = public_path('/images/services/' . $service->cover);
        $coverPathThumb = public_path('/images/services/thumb' . $service->cover);

        File::delete($photoPath, $photoPathThumb, $coverPath . $coverPathThumb);
        $service->delete();
        return redirect()->route('services.index')->with('delete', 'data deleted');


    }

    public function changeActive(Request $request)
    {
        try {


            $this->services->changeActive($request->id, $request->active_number);
            return response()->json('updated', 200);
        } catch (\Exception $exception) {
            return response()->json('error', 422);

        }

    }
}
