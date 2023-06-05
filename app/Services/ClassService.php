<?php

/**
 *  ClassService
 *
 * @category   Services
 * @package    App\Services
 * @subpackage Services
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Services;

use App\Http\Requests\ClassRequest;
use App\Models\ClassModel;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


/**
 * ClassService
 *
 * @category Services
 * @package  App\Services
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class ClassService
{
    /**
     * ClassService::getData()
     *
     * Gets data for all classes.
     *
     * @return array
     */
    public function list()
    {
        $data['getRecord'] = ClassModel::getRecord();
        return view('admin.class.list', $data);
    }

    /**
     * ClassService::getData()
     *
     * Gets data for all classes.
     *
     * @return array
     */
    public function getData()
    {
        $data['data'] = ClassModel::getRecord();
        return $data;
    }

    /**
     * ClassService::add()
     *
     * Displays the form to add a new class.
     *
     * @return \Illuminate\View\View
     */
    public function add()
    {
        return view('admin.class.add');
    }

    /**
     * ClassService::insertClass()
     *
     * Inserts a new class into the database.
     *
     * @param ClassRequest $request The request object containing class information.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function insertClass()
    {
        try {
            $data['created_by'] = Auth::user()->id;
            ClassModel::create($data);
            return redirect('admin/class/list')
                ->with('success', 'Class successfully created ');
        } catch (\Exception $e) {
            Log::error($e); // Ghi lỗi vào log
            throw new Exception('My first Sentry error!');
            return response()->json(['success'
            => false, 'message' => 'Failed to insert class'], 500);
        }
    }

    /**
     * ClassService::edit()
     *
     * Displays the form to edit a class.
     *
     * @param int $id The ID of the class to edit.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['getRecord'] = ClassModel::find($id);

        return view('admin.class.edit', $data);
    }

    /**
     * ClassService::view()
     *
     * Displays the details of a class and its students.
     *
     * @param int $id The ID of the class to view.
     *
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $data['getRecord'] = User::getStudents($id);
        $data['getClass'] = ClassModel::find($id);
        return  $data;
    }

    /**
     * ClassService::myClass()
     *
     * Displays the details of a student's class.
     *
     */
    public function myClass()
    {
        $data['getRecord'] = User::getStudents(Auth::user()->class_id);
        $data['getClass'] = ClassModel::find(Auth::user()->class_id);
        return  $data;
    }

    /**
     * ClassService::editClass()
     *
     * Updates a class with new information.
     *
     * @param ClassRequest $request The request object containing class information.
     * @param int          $id      The ID of the class to update.
     *
     */
    public function editClass($data, $id)
    {
        try {
            $class = ClassModel::findOrFail($id);
            $class->update($data);
            return $class;
        } catch (\Exception $e) {
            Log::error($e); // Ghi lỗi vào log
            throw new Exception('error!');
        }
    }


    /**
     * ClassService::delete()
     *
     * Deletes a class from the database.
     *
     * @param int $id The ID of the class to delete.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $class = ClassModel::find($id);
        $class->is_delete = 1;
        $class->save();
        return $class;
    }
}
