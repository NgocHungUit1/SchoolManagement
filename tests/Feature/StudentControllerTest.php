<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testAddStudentValidation()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request không có dữ liệu
        $response = $this->withoutMiddleware()->post('/admin/student/add', []);

        $response->assertSessionHasErrors(['name', 'roll_number', 'class_id', 'gender', 'date_of_birth', 'mobile_number', 'email', 'password']);
    }

    public function testCreateStudentWithUserTypeThree()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);
        $class = ClassModel::factory()->create();
        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý tạo Student
        $response = $this->withoutMiddleware()->post('/admin/student/add', [
            'name' => 'John Doe',
            'admission_number' => '123456',
            'roll_number' => 'A01',
            'class_id' => $class->id,
            'gender' => 'Male',
            'date_of_birth' => '01-01-1999',
            'mobile_number' => '0987654321',
            'email' => 'john.doe@example.com',
            'address' => 'address',
            'password' => 'password',
            'user_type' => '3',
        ]);

        $response->assertRedirect('admin/student/list');
    }

    public function testUpdateStudentValidation()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một student
        $student = User::factory()->create(['user_type' => 3]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request không có dữ liệu
        $response = $this->withoutMiddleware()->post('/admin/student/edit/' . $student->id, [
            'name' => '',
            'roll_number' => '',
            'class_id' => '',
            'gender' => '',
            'date_of_birth' => '',
            'mobile_number' => '',

        ]);

        $response->assertSessionHasErrors(['name', 'roll_number', 'class_id', 'gender', 'date_of_birth', 'mobile_number']);
    }

    public function testUpdateStudentWithUserTypeThree()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        $class = ClassModel::factory()->create();

        // Tạo một student
        $student = User::factory()->create(['user_type' => 3]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý update Student
        $response = $this->withoutMiddleware()->post('/admin/student/edit/' . $student->id, [
            'name' => 'John Doe',
            'roll_number' => 'A01',
            'class_id' => $class->id,
            'gender' => 'Male',
            'date_of_birth' => '01-01-1999',
            'mobile_number' => '0987654321',
            'address' => 'address',
            'password' => 'password',
            'user_type' => '3',
        ]);

        $response->assertRedirect('admin/student/list');
    }

    public function testDeleteStudent()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một student
        $student = User::factory()->create(['user_type' => 3]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request để xóa student
        $response = $this->withoutMiddleware()->get('/admin/student/delete/' . $student->id);

        // Kiểm tra xem có redirect đến trang danh sách sinh viên không
        $response->assertRedirect('admin/student/list');

        // Kiểm tra xem student đã bị xóa khỏi cơ sở dữ liệu chưa
        $this->assertDatabaseHas('users', [
            'id' => $student->id,
            'is_delete' => 1,
        ]);
    }
}
