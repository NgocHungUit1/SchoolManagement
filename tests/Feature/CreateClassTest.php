<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testCreateClassWithUserTypeOne()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý tạo Class
        $response = $this->withoutMiddleware()->post('/admin/class/add', [
            'name' => 'Class A',
            'status' => '0',
            'is_delete' => '0',
            'created_by' => $user->id,
        ]);

        $response->assertRedirect('admin/class/list');
        // Kiểm tra số lượng class trong database sau khi tạo class

    }

    public function test_edit_class_with_valid_input()
    {
        //create class to edit
        $class = ClassModel::factory()->create();

        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the class with valid input data
        $response = $this->withoutMiddleware()->post('/admin/class/edit/' . $class->id, [
            'name' => 'New Class Name',
            'status' => '0',
            'is_delete' => '0',
            'created_by' => $user->id,
        ]);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect('admin/class/list');

        //assert that the edited class's name and status have been updated in the database
        $editedClass = ClassModel::find($class->id);
        $this->assertEquals('New Class Name', $editedClass->name);
    }

    public function test_edit_class_with_missing_required_input()
    {
        //create class to edit
        $class = ClassModel::factory()->create();

        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the class with missing required input data
        $response = $this->withoutMiddleware()->post('/admin/class/edit/' . $class->id, []);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect();

        //assert that the error message is displayed on the page
        $response->assertSessionHasErrors(['name']);
    }

    public function testDeleteClassSubject()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một student
        $class = ClassModel::factory()->create();

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request để xóa student
        $response = $this->withoutMiddleware()->get('/admin/class/delete/' . $class->id);

        // Kiểm tra xem có redirect đến trang danh sách sinh viên không


        // Kiểm tra xem student đã bị xóa khỏi cơ sở dữ liệu chưa
        $this->assertDatabaseHas('class', [
            'id' => $class->id,
            'is_delete' => 1,
        ]);
    }
}
