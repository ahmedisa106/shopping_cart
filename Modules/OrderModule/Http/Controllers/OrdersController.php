<?php

namespace Modules\OrderModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\OrderModule\Entities\Order;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('ordermodule::orders.index');
    }

    public function dataTable()
    {

        $orders = Order::with('user')->get();


        return DataTables::of($orders)
            ->addColumn('client', function ($row) {

                return $row->user->name;
            })
            ->addColumn('address', function ($row) {

                return $row->user->address;

            })
            ->addColumn('phone', function ($row) {

                return $row->user->phone;
            })
            ->addColumn('operations', function ($row) {
                $edit = '<a>edit</a>';
                $delete = '<a>delete</a>';

                return $edit . ' ' . $delete;

            })
            ->rawColumns(['operations' => 'operations', 'edit' => 'edit', 'delete' => 'delete'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ordermodule::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('ordermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ordermodule::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
