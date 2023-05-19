<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminInsertUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

class AdminController extends Controller
{
    function list() {
        $data['getRecord'] = User::getAdmin();
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        return view('admin.admin.add');
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getUserId($id);

        return view('admin.admin.edit', $data);
    }

    public function insertUser(AdminInsertUserRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;
        $data['password'] = Hash::make($request->password);
        $data['user_type'] = 1;
        User::create($data);
        return redirect('admin/admin/list')->with('success', 'User successfully created ');
    }

    public function editUser(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect('admin/admin/list')->with('success', 'User successfully updated ');

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'User successfully deleted ');
    }

}
