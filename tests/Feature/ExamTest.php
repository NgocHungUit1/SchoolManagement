<?php

namespace Tests\Feature;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExamTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseTransactions;

    public function testCreateExamWithUserTypeOne()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý tạo Class
        $response = $this->withoutMiddleware()->post('/admin/exam/add', [
            'name' => 'Class A',
            'description' => 'THeory',
            'is_delete' => '0',
            'created_by' => $user->id,
        ]);

        $response->assertRedirect('admin/exam/list');

    }

    public function test_edit_Exam_with_valid_input()
    {
        //create class to edit
        $exam = Exam::factory()->create();

        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the class with valid input data
        $response = $this->withoutMiddleware()->post('/admin/exam/edit/' . $exam->id, [
            'name' => 'New Exam Name',
            'description' => 'THeory',
            'is_delete' => '0',
            'created_by' => $user->id,
        ]);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect('admin/exam/list');

        //assert that the edited class's name and status have been updated in the database

        //assert that the edited class's name and status have been updated in the database
        $editedExam = Exam::find($exam->id);
        $this->assertEquals('New Exam Name', $editedExam->name);
    }

    public function test_edit_class_with_missing_required_input()
    {
        //create class to edit
        $exam = Exam::factory()->create();

        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the class with missing required input data
        $response = $this->withoutMiddleware()->post('/admin/exam/edit/' . $exam->id, []);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect();

        //assert that the error message is displayed on the page
        $response->assertSessionHasErrors(['name']);
    }
}
