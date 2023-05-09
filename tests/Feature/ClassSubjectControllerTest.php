<?php

namespace Tests\Feature;

use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectControllerTest extends TestCase
{
    use DatabaseTransactions;


    /** @test */
    public function it_adds_a_subject_to_a_class()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Create a class and subject to assign
        $class = ClassModel::factory()->create();
        $subject = Subject::factory()->create();

        // Make a request to add the subject to the class
        $response =$this->withoutMiddleware()->post('/admin/assign_subject/add', [
                'class_id' => $class->id,
                'subject_id' => [$subject->id],
                'created_by' => $user->id,
                'status' => 1
            ]);

        // Assert that the response status is HTTP 302 (redirect)
        $response->assertStatus(302);

        // Assert that the subject was assigned to the class
        $this->assertDatabaseHas('class_subject', [
            'class_id' => $class->id,
            'subject_id' => $subject->id,
            'status' => 1,
            'created_by' => $user->id,
        ]);
    }

    // public function test_update_method_successfully_redirects_to_list_page()
    // {
    //         // Tạo một user với user_type = 1
    //         $user = User::factory()->create(['user_type' => 1]);

    //         // Đăng nhập với user vừa tạo
    //         $this->actingAs($user);

    //     $classSubject = ClassSubject::factory()->create();
    //     $response = $this->post('/admin/assign_subject/edit/' . $classSubject->id, []);
    //     $response->assertRedirect('/admin/assign_subject/list');
    // }
}
