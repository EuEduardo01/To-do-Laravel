<?php

namespace Tests\Feature;

use App\Http\Controllers\TaskController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

//php artisan test --filter=TaskControllerTest 

class TaskControllerTest extends TestCase
{
//php artisan test --filter=TaskControllerTest::test_create_task_with_valid_data 
    use RefreshDatabase;

    public function test_create_task_with_valid_data() {
        // Arrange (preparação)
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $request = Request::create('/tasks/create', 'POST', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'due_date' => '2024-06-01',
            'category_id' => $category->id,
            'user_id' => $user->id
        ]);

        // Act (ação)
        $controller = new TaskController;
        $response = $controller->create_action($request);

        // Assert (afirmação)
        $this->assertEquals(
            redirect(route('home'))->getTargetUrl(),
            $response->getTargetUrl()
        );

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            'due_date' => '2024-06-01',
            'category_id' =>$category->id,
            'user_id' => $user->id
        ]);
    }
}
