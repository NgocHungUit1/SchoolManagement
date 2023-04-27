<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminInsertUserRequest;
use App\Models\User;
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
        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'User successfully created ');
    }

    public function editUser(AdminInsertUserRequest $request, $id)
    {
        $user = User::getUserId($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/admin/list')->with('success', 'User successfully updated ');

    }

    public function delete($id)
    {
        $user = User::getUserId($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'User successfully deleted ');
    }

}
