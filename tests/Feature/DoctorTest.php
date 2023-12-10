<?php

namespace Tests\Feature;

use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\UserHelper;
use Tests\TestCase;

class DoctorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserHelper::auth();
    }

    public function testStore(): void
    {
        $doctor = Doctor::factory()->make();

        $response = $this->postJson('/api/doctors', $doctor->toArray());

        $response->assertCreated();

        $response->assertJson([
            'data' => [
                'name' => $doctor->name,
                'phone' => $doctor->phone,
            ],
        ]);
    }

    public function testStoreWithIncorrectData(): void
    {
        $response = $this->postJson('/api/doctors', [
            'name' => 'S',
            'phone' => '+7952234dde',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['name', 'phone']);
    }

    public function testUpdate(): void
    {
        $doctor = Doctor::factory()->create();

        $updatedData = [
            'name' => 'Sanjar',
            'phone' => '79521621026',
        ];

        $response = $this->putJson('/api/doctors/'.$doctor->id, $updatedData);

        $response->assertOk();

        $response->assertJson([
            'data' => [
                'id' => $doctor->id,
                ...$updatedData,
            ],
        ]);
    }

    public function testUpdateWithIncorrectData(): void
    {
        $doctor = Doctor::factory()->create();

        $updatedData = [
            'name' => 'S',
            'phone' => '+7952234dde',
        ];

        $response = $this->putJson('/api/doctors/'.$doctor->id, $updatedData);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['name', 'phone']);
    }

    public function testDestroy(): void
    {
        $doctor = Doctor::factory()->create();

        $response = $this->deleteJson('/api/doctors/'.$doctor->id);

        $response->assertNoContent();
    }
}
