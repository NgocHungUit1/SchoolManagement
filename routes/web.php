<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\ClassTimeTableController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authLogin']);
Route::get('logout', [AuthController::class, 'authLogout']);
Route::get('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'changePassword']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/getData', [ClassController::class, 'getData']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insertClass']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::get('admin/class/view/{id}', [ClassController::class, 'view']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'editClass']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);
    Route::get('admin/class/export', [ClassController::class, 'export']);

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insertUser']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'editUser']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    Route::get('admin/admin/profile', [UserController::class, 'Profile']);
    Route::get('admin/admin/profile-edit', [UserController::class, 'profileEdit']);
    Route::post('admin/admin/profile-edit', [UserController::class, 'updateProfileAdmin']);
    Route::post('admin/admin/profile', [UserController::class, 'updatePassword']);

    //Student
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/getData', [StudentController::class, 'getData']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'addStudent']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'editStudent']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

    //Teacher
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/getData', [TeacherController::class, 'getData']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'addTeacher']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'editTeacher']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);

    //CLASS
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/getData', [ClassController::class, 'getData']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insertClass']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::get('admin/class/view/{id}', [ClassController::class, 'view']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'editClass']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);
    Route::get('admin/class/export', [ClassController::class, 'export']);

    //Subject
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/getData', [SubjectController::class, 'getData']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insertSubject']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'editSubject']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);
    Route::get('admin/subject/export', [SubjectController::class, 'export']);

    //Exam
    Route::get('admin/exam/list', [ExamController::class, 'list']);
    Route::get('admin/exam/getData', [ExamController::class, 'getData']);
    Route::get('admin/exam/add', [ExamController::class, 'add']);
    Route::post('admin/exam/add', [ExamController::class, 'addExam']);
    Route::get('admin/exam/edit/{id}', [ExamController::class, 'edit']);
    Route::post('admin/exam/edit/{id}', [ExamController::class, 'update']);
    Route::get('admin/exam/delete/{id}', [ExamController::class, 'delete']);
    Route::get('admin/exam_schedule', [ExamController::class, 'examSchedule']);
    Route::get('admin/my-subject-class/timetable/{class_id}/{subject_id}/{semester_id}', [ClassTimeTableController::class, 'myTimeTableTeacher']);
    Route::get('admin/exam/score', [ExamController::class, 'examScore']);
    Route::post('admin/exam/score', [ExamController::class, 'insertScore']);
    Route::post('admin/exam/exam_score', [ExamController::class, 'addScore']);
    Route::post('admin/exam_schedule/add', [ExamController::class, 'examScheduleInsert']);
    Route::get('admin/academic', [ExamController::class, 'academic']);
    Route::get('admin/academic_record/{id}/{semester_id}', [ExamController::class, 'academicRecord']);
    Route::get('admin/academic_record_year/{id}', [ExamController::class, 'academicRecords']);

    //TimeTable
    Route::get('admin/class_timetable/list', [ClassTimeTableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimeTableController::class, 'getSubject']);
    Route::post('admin/class_timetable/add', [ClassTimeTableController::class, 'add']);

    //Assign Subject
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/getData', [ClassSubjectController::class, 'getData']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'assignSubject']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
    Route::get('admin/assign_subject/export', [ClassSubjectController::class, 'export']);

    //Assign Class Teacher
    Route::get('admin/assign_class_teacher/list', [ClassTeacherController::class, 'list']);
    Route::get('admin/assign_class_teacher/getData', [ClassTeacherController::class, 'getData']);
    Route::get('admin/assign_class_teacher/add', [ClassTeacherController::class, 'add']);
    Route::post('admin/assign_class_teacher/add', [ClassTeacherController::class, 'assignTeacherClass']);
    Route::post('admin/assign_class_teacher/get_subject', [ClassTeacherController::class, 'getSubject']);
    Route::post('admin/assign_class_teacher/get_teacher', [ClassTeacherController::class, 'getTeacher']);
    Route::get('admin/assign_class_teacher/edit/{id}', [ClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/edit/{id}', [ClassTeacherController::class, 'update']);
    Route::get('admin/assign_class_teacher/delete/{id}', [ClassTeacherController::class, 'delete']);
});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/profile', [UserController::class, 'profile']);
    Route::get('teacher/profile-edit', [UserController::class, 'profileEdit']);
    Route::post('teacher/profile-edit', [UserController::class, 'updateProfileTeacher']);
    Route::post('teacher/profile', [UserController::class, 'updatePassword']);
    Route::get('teacher/my-subject-class', [ClassTeacherController::class, 'mySubjectClass']);
    Route::get('teacher/my-subject-class/timetable/{class_id}/{subject_id}', [ClassTimeTableController::class, 'myTimeTableTeacher']);
    Route::post('teacher/exam/get_subject', [ExamController::class, 'getSubjectTeacher']);
    Route::post('teacher/exam_score', [ExamController::class, 'addScoreByTeacher']);
    Route::get('teacher/exam_score', [ExamController::class, 'examScoreTeacher']);
    Route::get('teacher/my-student', [TeacherController::class, 'myStudent']);
    Route::get('teacher/my-student/view/{id}', [ClassController::class, 'view']);
    Route::get('teacher/my-class/score/{id}/{semester_id}', [ExamController::class, 'academicScoreClass']);
    Route::get('teacher/academic_record_year/{id}', [ExamController::class, 'academicRecords']);
    Route::get('teacher/get-student', [TeacherController::class, 'getStudent']);
    Route::get('teacher/get_subject', [ClassTeacherController::class, 'getSubject']);
    Route::get('teacher/get_class', [TeacherController::class, 'getClass']);
    Route::get('teacher/my_exam', [ExamController::class, 'myExamTeacher']);
    Route::get('teacher/my-calendar', [CalendarController::class, 'myTeacherCalendar']);
});

Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('student/profile', [UserController::class, 'Profile']);
    Route::get('student/profile-edit', [UserController::class, 'profileEdit']);
    Route::get('student/my-subject', [SubjectController::class, 'mySubject']);
    Route::get('student/my-timetable', [ClassTimeTableController::class, 'myTimeTable']);
    Route::post('student/profile-edit', [UserController::class, 'updateProfileStudent']);
    Route::post('student/profile', [UserController::class, 'updatePassword']);
    Route::get('student/my-exam', [ExamController::class, 'myExam']);
    Route::get('student/my-score', [ExamController::class, 'scoreStudent']);
    // Route::get('teacher/academic_record_year/{id}', [ExamController::class, 'academicRecords']);
    Route::get('student/my-class', [ClassController::class, 'myClass']);
    Route::get('student/my-calendar', [CalendarController::class, 'myCalendar']);
});
function set_active($url)
{
    if (is_array($url)) {
        return in_array(Request::path(), $url) ? 'active' : '';
    }
    return Request::path() == $url ? 'active' : '';
}
