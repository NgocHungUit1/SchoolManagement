<?php

namespace Tests\Feature;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SubjectTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // use DatabaseTransactions;

    public function testCreateSubjectWithUserTypeOne()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một request gửi lên route hoặc controller xử lý tạo Subject
        $response = $this->withoutMiddleware()->post('/admin/subject/add', [
            'name' => 'Subject A',
            'type' => 'THeory',
            'status' => '0',
            'is_delete' => '0',
            'created_by' => $user->id,
        ]);

        $response->assertRedirect('admin/subject/list');

    }

    public function test_edit_subject_with_valid_input()
    {
        //create Subject to edit
        $subject = Subject::factory()->create();

        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the Subject with valid input data
        $response = $this->withoutMiddleware()->post('/admin/subject/edit/' . $subject->id, [
            'name' => 'New Subject Name',
            'status' => '0',
            'type' => 'THeory',
            'is_delete' => '0',
            'created_by' => $user->id,
        ]);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect('admin/subject/list');


        $editedSubject = Subject::find($subject->id);
        $this->assertEquals('New Subject Name', $editedSubject->name);
    }

    public function test_edit_subject_with_missing_required_input()
    {
        //create Subject to edit
        $subject = Subject::factory()->create();

        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        //make a request to edit the subject with missing required input data
        $response = $this->withoutMiddleware()->post('/admin/subject/edit/' . $subject->id, []);

        //assert that the response status code is a redirect (302)
        $response->assertRedirect();

        //assert that the error message is displayed on the page
        $response->assertSessionHasErrors(['name']);
    }
}
