<?php
namespace App\Services;
use App\Http\Requests\TeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherService{

    public function createTeacher(TeacherRequest $request)
    {
        $data = $request->validated();
        $data['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();
        $data['joining_date'] = Carbon::createFromFormat('d-m-Y', $request->joining_date)->toDateTimeString();
        $data['password'] = Hash::make($request->password);
        $data['user_type'] = 2;

        if ($request->hasFile('user_avatar')) {
            $path = 'public/uploads/profile/';
            $get_image = $request->file('user_avatar');
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $data['user_avatar'] = $new_image;
        }

        User::create($data);
    }

    public function updateTeacher(UpdateTeacherRequest $request, $id)
    {
        $teacher = User::findOrFail($id);
        $data = $request->validated();
        $data['joining_date'] = Carbon::createFromFormat('d-m-Y', $request->joining_date)->toDateTimeString();
        $data['date_of_birth'] = Carbon::createFromFormat('d-m-Y', $request->date_of_birth)->toDateTimeString();

        if ($request->hasFile('user_avatar')) {
            $path = 'public/uploads/profile/';
            $get_image = $request->file('user_avatar');
            $name_image = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $oldImage = $teacher->user_avatar;
            if ($oldImage && Storage::exists("public/uploads/profile/$oldImage")) {
                Storage::delete("public/uploads/profile/$oldImage");
            }

            $data['user_avatar'] = $new_image;
        }

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $teacher->update($data);
    }

}
