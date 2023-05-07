<?php

namespace Tests\Feature;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateClassTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;

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

}
