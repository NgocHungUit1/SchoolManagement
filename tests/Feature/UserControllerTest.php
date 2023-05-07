<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            'password' => bcrypt('password')
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
            'password' => bcrypt('password')
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
            'password' => bcrypt('password')
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

}
