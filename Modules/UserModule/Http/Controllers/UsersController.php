<?php

namespace Modules\UserModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\UserModule\Entities\User;
use Modules\UserModule\Repository\UserRepository;
use Yajra\DataTables\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public $usersRepo;

    public function __construct(UserRepository $userRepository)
    {
        $this->usersRepo = $userRepository;
    }

    public function index()
    {
        $users = $this->usersRepo->getAll();
        return view('usermodule::users.index', compact('users'));
    }

    public function dataTable()
    {
        $users = $this->usersRepo->getAll();
        return DataTables::of($users)
            ->addColumn('name', function ($row) {

                return $row->name;

            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('phone', function ($row) {
                return $row->phone;
            })
            ->addColumn('address', function ($row) {
                return $row->address;
            })
            ->addColumn('operations', function ($row) {

                $edit = '<a href="' . url('/admin-panel/users/' . $row->id . '/edit') . '" class="button btn btn-primary" ><i class="fa fa-edit"></i></a>';
                $delete = '<a href="' . url('/admin-panel/users/delete/' . $row->id) . '" class="button btn btn-danger" onclick="return confirm(\'are you sure !! \')" ><i class="fa fa-trash"></i></a>';
                return $edit . ' ' . $delete;
            })
            ->rawColumns(['edit' => 'edit', 'delete' => 'delete', 'operations' => 'operations'])
            ->make(true);


    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('usermodule::users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'address' => 'required',
        ]);
        $data = $request->except('_token', 'password');
        $data['password'] = bcrypt($request->password);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'data added successfully');


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('usermodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $user = $this->usersRepo->findById($id);
        return view('usermodule::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token']);
        $user = $this->usersRepo->findById($id);
        $user->update($data);
        return redirect()->route('users.index')->with('update', 'data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $this->usersRepo->delete($id);
        return back()->with('delete', 'data deleted successfully');
    }
}
