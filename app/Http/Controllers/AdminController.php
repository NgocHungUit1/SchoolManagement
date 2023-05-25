<?php

/**
 *  AdminController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Http\Requests\AdminInsertUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;


/**
 * Admin Controller
 *
 * @category CategoryName
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class AdminController extends Controller
{
    /**
     * Displays a list of admin users.
     *
     * @return mixed List of admin users
     */
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        return view('admin.admin.list', $data);
    }

    /**
     * Shows the add admin user form.
     *
     * @return mixed The add admin user form
     */
    public function add()
    {
        return view('admin.admin.add');
    }

    /**
     * Shows the edit admin user form.
     *
     * @param int $id User ID
     *
     * @return mixed The edit admin user form
     */
    public function edit($id)
    {
        $data['getRecord'] = User::getUserId($id);

        return view('admin.admin.edit', $data);
    }

    /**
     * Inserts a new user record.
     *
     * @param AdminInsertUserRequest $request Request object
     *
     * @return mixed Result of the insert operation
     */
    public function insertUser(AdminInsertUserRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = Auth::user()->id;
        $data['password'] = Hash::make($request->password);
        $data['user_type'] = 1;
        User::create($data);
        return redirect('admin/admin/list')
            ->with('success', 'User successfully created ');
    }

    /**
     * Updates an existing user record.
     *
     * @param UpdateUserRequest $request Request object
     * @param int               $id      User ID
     *
     * @return mixed Result of the update operation
     */
    public function editUser(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return redirect('admin/admin/list')
            ->with('success', 'User successfully updated ');
    }

    /**
     * Deletes an existing user record.
     *
     * @param int $id User ID
     *
     * @return mixed Result of the delete operation
     */
    public function delete($id)
    {
        $user = User::find($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/admin/list')
            ->with('success', 'User successfully deleted ');
    }
}
