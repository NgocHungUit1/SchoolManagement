<?php

namespace Tests\Feature;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testAddTeacherValidation()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request không có dữ liệu
        $response = $this->withoutMiddleware()->post('/admin/teacher/add', []);

        $response->assertSessionHasErrors(['name', 'teacher_id', 'joining_date', 'qualification', 'experience', 'address', 'gender', 'date_of_birth', 'mobile_number', 'email', 'password']);
    }

    public function testCreateTeacherWithUserTypeTwo()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        $subject = Subject::factory()->create();

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý tạo Teacher
        $response = $this->withoutMiddleware()->post('/admin/teacher/add', [
            'name' => 'John Doe',
            'teacher_id' => 'T001',
            'joining_date' => '01-01-1999',
            'qualification' => 'Bachelor',
            'subject_id' => $subject->id,
            'experience' => '2 years',
            'address' => '123 Main St',
            'gender' => 'Male',
            'date_of_birth' => '01-01-1999',
            'mobile_number' => '0987654321',
            'email' => 'john.doe@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('admin/teacher/list');
    }

    public function testUpdateTeacherValidation()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một teacher
        $teacher = User::factory()->create(['user_type' => 2]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request không có dữ liệu
        $response = $this->withoutMiddleware()->post('/admin/teacher/edit/' . $teacher->id, [
            'name' => '',
            'joining_date' => '',
            'qualification' => '',
            'experience' => '',
            'address' => '',
            'gender' => '',
            'date_of_birth' => '',
            'mobile_number' => '',
            'password' => '',

        ]);

        $response->assertSessionHasErrors(['name', 'joining_date', 'qualification', 'experience', 'address', 'gender', 'date_of_birth', 'mobile_number', 'password']);
    }

    public function testUpdateTeacherWithUserTypeTwo()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một teacher
        $teacher = User::factory()->create(['user_type' => 2]);
        $subject = Subject::factory()->create();

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý update Teacher
        $response = $this->withoutMiddleware()->post('/admin/teacher/edit/' . $teacher->id, [
            'name' => 'John Doe',
            'joining_date' => '01-01-1999',
            'qualification' => 'Bachelor',
            'experience' => '2 years',
            'subject_id' => $subject->id,
            'address' => '123 Main St',
            'gender' => 'Male',
            'date_of_birth' => '01-01-1999',
            'mobile_number' => '0987654321',
            'password' => 'password',
        ]);

        $response->assertRedirect('admin/teacher/list');
    }

    public function testDeleteTeacher()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một teacher
        $teacher = User::factory()->create(['user_type' => 2]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request để xóa teacher

        $response = $this->withoutMiddleware()->get('/admin/teacher/delete/' . $teacher->id);

        // Kiểm tra xem có redirect đến trang danh sách teacher không
        $response->assertRedirect('admin/teacher/list');

        // Kiểm tra xem teacher đã bị xóa khỏi cơ sở dữ liệu chưa
        $this->assertDatabaseHas('users', [
            'id' => $teacher->id,
            'is_delete' => 1,
        ]);

    }
}
