<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use App\Jobs\ProcessSubmissionJob;

class ApiControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_and_dispatches_a_job()
    {
        Queue::fake();

        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'This is a test message.',
        ];

        $response = $this->postJson('/api/endpoint', $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => 'Data received and job dispatched',
            ]);

        // Ensure the job was dispatched using the getter method
        Queue::assertPushed(ProcessSubmissionJob::class, function ($job) use ($data) {
            $jobData = $job->getData(); // Using getter method
            return $jobData['name'] === $data['name'] &&
                $jobData['email'] === $data['email'] &&
                $jobData['message'] === $data['message'];
        });
    }

    /** @test */
    public function it_validates_input_data()
    {
        $response = $this->postJson('/api/endpoint', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }
}
