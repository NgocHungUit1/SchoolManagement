<?php

/**
 *  DashboardController
 *
 * @category   Controller
 * @package    MyApp
 * @subpackage Controllers
 * @author     Cody <cody.nguyen.goldenowl@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT
 * @link       https://laravel.com/
 */

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\ExamScore;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * DashboardController
 *
 * @category DashboardController
 * @package  PackageName
 *
 * @author  Cody <cody.nguyen.goldenowl@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    http://www.example.com
 */
class DashboardController extends Controller
{
    /**
     * Shows dashboard user.
     *
     * @return mixed Calendar
     */
    public function dashboard()
    {

        $data['getStudentStar'] = User::getStudentStar();
        $data['getStudent'] = User::getStudent();
        $data['getTeacher'] = User::getTeacher();
        $data['getClass'] = ClassModel::getRecord();
        $data['getSubject'] = Subject::getSubject();

        if (Auth::user()->user_type == 1) {
            return view('admin/dashboard', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher/dashboard', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student/dashboard', $data);
        }
    }
}
