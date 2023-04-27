<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
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
