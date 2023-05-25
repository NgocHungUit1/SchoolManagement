<?php

namespace Tests\Feature;

use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class ClassTeacherTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_adds_a_teacher_to_a_class()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Create a class and subject to assign
        $class_teacher = ClassTeacher::factory()->create();

        // Make a request to add the subject to the class
        $response = $this->withoutMiddleware()->post('/admin/assign_class_teacher/add', [
            'class_id' => $class_teacher->class_id,
            'subject_id' => $class_teacher->subject_id,
            'teacher_id' => $class_teacher->teacher_id,
        ]);

        // Assert that the response status is HTTP 302 (redirect)
        $response->assertStatus(302);

        // Assert that the subject was assigned to the class
        // $this->assertDatabaseHas('teacher_class', [
        //     'class_id' => $class_teacher->class_id,
        //     'subject_id' => $class_teacher->subject_id,
        //     'teacher_id' => $class_teacher->teacher_id,
        // ]);
    }

    public function testUpdate()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một ClassSubject mới
        $class_teacher = ClassTeacher::factory()->create();

        // Gửi yêu cầu PUT để cập nhật thông tin của ClassSubject với dữ liệu mới
        $response = $this->withoutMiddleware()->post("/admin/assign_class_teacher/edit/{$class_teacher->id}", [
            'class_id' => $class_teacher->class_id,
            'subject_id' => $class_teacher->subject_id,
            'teacher_id' => $class_teacher->teacher_id,
            'is_delete' => '0',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('teacher_class', [
            'class_id' => $class_teacher->class_id,
            'subject_id' => $class_teacher->subject_id,
            'teacher_id' => $class_teacher->teacher_id,
            'is_delete' => '0',
        ]);
        $response->assertRedirect('admin/assign_class_teacher/list');
    }

    public function testDeleteClassTeacher()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một student
        $class_teacher = ClassTeacher::factory()->create();

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request để xóa student
        $response = $this->withoutMiddleware()->get('/admin/assign_class_teacher/delete/' . $class_teacher->id);

        // Kiểm tra xem có redirect đến trang danh sách sinh viên không
        $response->assertRedirect('admin/assign_class_teacher/list');

        // Kiểm tra xem student đã bị xóa khỏi cơ sở dữ liệu chưa
        $this->assertDatabaseHas('teacher_class', [
            'id' => $class_teacher->id,
            'is_delete' => 1,
        ]);
    }
}
