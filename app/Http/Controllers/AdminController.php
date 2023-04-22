<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function insertUser(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);
        $user = new User();
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', 'User successfully created ');
    }

    public function editUser(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);
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
