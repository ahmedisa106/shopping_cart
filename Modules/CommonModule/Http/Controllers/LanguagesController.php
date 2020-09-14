<?php

namespace Modules\CommonModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CommonModule\Entities\Language;
use Yajra\DataTables\DataTables;


class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */


    public function index()
    {

        $languages = Language::paginate(5);

        return view('commonmodule::languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('commonmodule::languages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'lang' => 'required',
            'display_lang' => 'required',

        ]);

        Language::create($request->all());
        return redirect()->route('languages.index')->with('success', 'data_created_successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('commonmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $lang = Language::find($id);
        return view('commonmodule::languages.edit', compact('lang'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lang' => 'required',
            'display_lang' => 'required',

        ]);

        $lang = Language::find($id);
        $lang->update($request->all());
        return redirect()->route('languages.index')->with('update', 'data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $lang = Language::find($id);

        $lang->delete();
        return redirect()->route('languages.index')->with('delete', 'data deleted successfully');


    }

    public function desactiveLang($id)
    {
        $lang = Language::find($id);
        $lang->update(['active' => 0]);
        return redirect()->back()->with('update', 'data updated');


    }

    public function activeLang($id)
    {
        $lang = Language::find($id);
        $lang->update(['active' => 1]);
        return redirect()->back()->with('update', 'data updated');


    }


    public function dataTables()
    {
        $langs = Language::get();

        return DataTables::of($langs)
            ->addColumn('lang', function ($row) {
                return $row->lang;
            })
            ->addColumn('display_lang', function ($row) {

                return $row->display_lang;

            })
            ->addColumn('active', function ($row) {

                if ($row->active == 1) {

                    return  '<a href="' . route('language.disactive', $row->id) . '" type="button" class="btn btn-warning"><i class="fa fa-times"></i></a>';

                } else {
                    return '<a href="' . route('language.active', $row->id) . '" type="button" class="btn btn-success"><i class="fa fa-check"></i></a>';

                }


            })
            ->addColumn('operations', function ($row) {
                $edit = '<a href="' . route('languages.edit', $row->id) . '" type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                $delete = '<a href="' . route('languages.delete', $row->id) . '" class="btn btn-danger" onclick="return confirm(\'are you sure ! \')" data-confirm="are you sure !" data-method="delete"><i class="fa fa-trash"></i></a>';
                return $edit . ' ' . $delete;
            })
            ->rawColumns(['edit' => 'edit', 'delete' => 'delete', 'active' => 'active', 'operations' => 'operations'])
            ->make(true);
    }
}
