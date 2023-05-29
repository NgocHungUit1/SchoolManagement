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
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
     * @param Request $request The HTTP request.
     *
     * @return mixed Calendar
     */
    public function dashboard(Request $request)
    {

        $data['getStudentStar'] = User::getStudentStar();
        $data['getStudent'] = User::getStudent();
        $data['getTeacher'] = User::getTeacher();
        $data['getClass'] = ClassModel::getRecord();
        $data['getSubject'] = Subject::getSubject();


        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')
            ->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')
            ->subMonth()->endOfMonth()->toDateString();
        $oneyear = Carbon::now('Asia/Ho_Chi_Minh')
            ->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //total last month
        $visitor_lastmonth = Visitor::whereBetween(
            'date_visitor',
            [$dauthangtruoc, $cuoithangtruoc]
        )->get();

        $data['visitor_lastmonth_count'] = $visitor_lastmonth->count();

        //total this month
        $visitor_thismonth = Visitor::whereBetween(
            'date_visitor',
            [$dauthangnay, $now]
        )->get();
        $data['visitor_thismonth_count']  = $visitor_thismonth->count();
        //total this on years
        $visitor_thisyear = Visitor::whereBetween(
            'date_visitor',
            [$oneyear, $now]
        )->get();

        $data['visitor_thisyear_count'] = $visitor_thisyear->count();
        //current online
        $user_ip_address = $request->getClientIp();
        $visitor = Visitor::where('ip_address', $user_ip_address)->first();
        if ($visitor) {
            // update last activity time
            $visitor->date_visitor = Carbon::now();
            $visitor->save();
        } else {
            // create new visitor
            $visitor = new Visitor();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now();
            $visitor->save();
        }

        //total visitor
        $visitor = Visitor::all();
        $data['visitor_total'] = $visitor->count();

        $online_users = Visitor::where('date_visitor', '>', Carbon::now()->subMinutes(5))->get();
        $data['visitor_counts'] = $online_users->count();

        if (Auth::user()->user_type == 1) {
            return view('admin/dashboard', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher/dashboard', $data);
        } elseif (Auth::user()->user_type == 3) {
            return view('student/dashboard', $data);
        }
    }
}
