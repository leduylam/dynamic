<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddAdminRequest;
use App\Http\Requests\Admin\EditAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        return view('backend.dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function listAdmin()
    {
        $admins = Admin::all();

        return view('backend.admin.index', compact('admins'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('backend.admin.create');
    }

    /**
     * @param AddAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AddAdminRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['confirmation_code'] = md5(uniqid(mt_rand(), true));
        $data['confirmed'] = true;
        $data['status'] = true;
        Admin::create($data);

        return redirect()->route('admin.list')->with('success', 'Admin created successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $admin = Admin::find($id);

        return view('backend.admin.edit', compact('admin'));
    }

    /**
     * @param EditAdminRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EditAdminRequest $request, $id)
    {
        $admin = Admin::find($id);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $admin->update($data);

        return redirect()->route('admin.list')->with('success', 'Admin update successfully');
    }

    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Delete category successfully');
    }
}
