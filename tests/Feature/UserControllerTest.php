<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    /** @test */
    public function admin_can_access_admin_dashboard()
    {
        $admin = User::factory()->create([
            'user_type' => 1,
            'password' => bcrypt('password'),
        ]);

        $response = $this->withoutMiddleware()->post('/login', [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('admin/dashboard');
    }

    /** @test */
    public function student_can_access_student_dashboard()
    {
        $student = User::factory()->create([
            'user_type' => 3,
            'password' => bcrypt('password'),
        ]);

        $response = $this->withoutMiddleware()->post('/login', [
            'email' => $student->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('student/dashboard');
    }

    /** @test */
    public function teacher_can_access_student_dashboard()
    {
        $teacher = User::factory()->create([
            'user_type' => 2,
            'password' => bcrypt('password'),
        ]);

        $response = $this->withoutMiddleware()->post('/login', [
            'email' => $teacher->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('teacher/dashboard');
    }

    public function testUserCanLogout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // Kiểm tra xem user đã đăng nhập thành công hay chưa
        $this->assertAuthenticatedAs($user);

        // Gửi yêu cầu đến trang logout
        $response = $this->get('/logout');

        // Kiểm tra xem user đã được đăng xuất hay chưa
        $this->assertFalse(Auth::check());

        // Kiểm tra xem yêu cầu đã được chuyển hướng đến trang đăng nhập hay không
        $response->assertRedirect('/');
    }

    public function testCreateAdminWithUserTypeOne()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý tạo Class
        $response = $this->withoutMiddleware()->post('/admin/admin/add', [
            'name' => 'Class A',
            'email' => 'Admin@gmail.com',
            'user_type' => '1',
            'password' => 'password',
        ]);

        $response->assertRedirect('admin/admin/list');
    }

    public function testEditAdminWithUserTypeOne()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);
        //create class to edit
        $admin = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the class with valid input data
        $response = $this->withoutMiddleware()->post('/admin/admin/edit/' . $admin->id, [
            'name' => 'Class A',
            'email' => 'Admin@gmail.com',
            'user_type' => '1',
            'password' => 'password',

        ]);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect('admin/admin/list');

        $updatedAdmin = User::find($admin->id);
        $this->assertEquals('Class A', $updatedAdmin->name);
        $this->assertEquals('Admin@gmail.com', $updatedAdmin->email);
        $this->assertEquals('1', $updatedAdmin->user_type);
        $this->assertEquals('password', $updatedAdmin->password);
    }

    public function testDeleteAdminWithUserTypeOne()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);
        //create class to edit
        $admin = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);
        $response = $this->get("/admin/admin/delete/{$admin->id}");

        $response->assertRedirect('/admin/admin/list');
        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'is_delete' => 1,
        ]);
    }
}
