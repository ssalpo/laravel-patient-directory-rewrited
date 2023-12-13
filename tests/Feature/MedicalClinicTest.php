<?php

namespace Tests\Feature;

use App\Models\MedicalClinic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\UserHelper;
use Tests\TestCase;

class MedicalClinicTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserHelper::auth();
    }

    public function testStore(): void
    {
        $model = MedicalClinic::factory()->make();

        $response = $this->postJson('/api/medical-clinics', $model->toArray());

        $response->assertCreated();

        $response->assertJson([
            'data' => [
                'name' => $model->name,
            ],
        ]);
    }

    public function testStoreWithIncorrectData(): void
    {
        $response = $this->postJson('/api/medical-clinics', [
            'name' => '',
        ]);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['name']);
    }

    public function testUpdate(): void
    {
        $model = MedicalClinic::factory()->create();

        $updatedData = [
            'name' => 'Some updated medical clinic',
        ];

        $response = $this->putJson('/api/medical-clinics/'.$model->id, $updatedData);

        $response->assertOk();

        $response->assertJson([
            'data' => [
                'id' => $model->id,
                ...$updatedData,
            ],
        ]);
    }

    public function testUpdateWithIncorrectData(): void
    {
        $model = MedicalClinic::factory()->create();

        $updatedData = [
            'name' => '',
        ];

        $response = $this->putJson('/api/medical-clinics/'.$model->id, $updatedData);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(['name']);
    }

    public function testDestroy(): void
    {
        $model = MedicalClinic::factory()->create();

        $response = $this->deleteJson('/api/medical-clinics/'.$model->id);

        $response->assertNoContent();
    }
}
