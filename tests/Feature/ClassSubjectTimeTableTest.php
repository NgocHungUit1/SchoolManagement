<?php

namespace Tests\Feature;

use App\Http\Requests\AssignSubjectClassRequest;
use App\Models\ClassModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\ClassSubject;
use App\Models\ClassSubjectTimeTable;
use App\Models\Subject;
use App\Models\Week;
use App\Services\ClassTimeTableService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class ClassSubjectTimeTableTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_adds_a_subject_to_a_class()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);


        $day = Week::factory()->create();
        $class_subject = ClassSubjectTimeTable::factory()->create();

        // Make a request to add the subject to the class
        $response = $this->withoutMiddleware()->post('/admin/class_timetable/add', [
            'class_id' => $class_subject->class_id,
            'subject_id' => $class_subject->subject_id,
            'day_id' => [$day->id],
            'room_number' => ['John Doe'],
            'start_time' => ['11:30'],
            'end_time' => ['12:30'],
            'start_date' => '01-01-1999',
            'end_date' => '01-02-1999',
        ]);

        // Assert that the response status is HTTP 302 (redirect)
        $response->assertStatus(302);

        // Assert that the subject was assigned to the class
        // $this->assertDatabaseHas('class_subject_timetable', [
        //     'class_id' => $class_subject->class_id,
        //     'subject_id' => $class_subject->subject_id,
        //     'day_id' => [$day->id],
        // ]);
    }

    public function testUpdate()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Tạo một ClassSubject mới
        $class_subject = ClassSubject::factory()->create();

        // Gửi yêu cầu PUT để cập nhật thông tin của ClassSubject với dữ liệu mới
        $response = $this->withoutMiddleware()->post("/admin/assign_subject/edit/{$class_subject->id}", [
            'class_id' => $class_subject->class_id,
            'subject_id' => [$class_subject->subject_id],
            'is_delete' => '0',
            'status' => '0',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('class_subject', [
            'class_id' => $class_subject->class_id,
            'subject_id' => [$class_subject->subject_id],
            'is_delete' => '0',
            'status' => '0'
        ]);
        $response->assertRedirect('admin/assign_subject/list');
    }

    public function testClassSubject()
    {
        // Tạo một user với user_type = 1
        $user = User::factory()->create(['user_type' => 1]);

        // Tạo một student
        $class_subject = ClassSubject::factory()->create();

        // Đăng nhập với user vừa tạo
        $this->actingAs($user);

        // Gửi request để xóa student
        $response = $this->withoutMiddleware()->get('/admin/assign_subject/delete/' . $class_subject->id);

        // Kiểm tra xem có redirect đến trang danh sách sinh viên không
        $response->assertRedirect('admin/assign_subject/list');

        // Kiểm tra xem student đã bị xóa khỏi cơ sở dữ liệu chưa
        $this->assertDatabaseHas('class_subject', [
            'id' => $class_subject->id,
            'is_delete' => 1,
        ]);
    }
}
