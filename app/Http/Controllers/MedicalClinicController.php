<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicalClinicRequest;
use App\Http\Resources\MedicalClinicResource;
use App\Models\MedicalClinic;
use App\Services\MedicalClinicService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Attributes as OAT;

class MedicalClinicController extends Controller
{
    public function __construct(
        public readonly MedicalClinicService $medicalClinicService
    ) {
    }

    #[
        OAT\Get(
            path: '/medical-clinics',
            summary: 'Возвращает список медицинских учреждений',
            security: [['bearerAuth' => []]],
            tags: ['Медицинское учреждение'],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'OK',
                    content: new OAT\JsonContent(ref: '#/components/schemas/MedicalClinicResponseWrapper')
                ),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        )
    ]
    public function index(): AnonymousResourceCollection
    {
        return MedicalClinicResource::collection(
            MedicalClinic::paginate()
        );
    }

    #[
        OAT\Post(
            path: '/medical-clinics',
            summary: 'Добавляет новое учреждение',
            security: [['bearerAuth' => []]],
            requestBody: new OAT\RequestBody(
                required: true,
                content: new OAT\JsonContent(
                    ref: '#/components/schemas/MedicalClinicRequest'
                )
            ),
            tags: ['Медицинское учреждение'],
            responses: [
                new OAT\Response(
                    response: 201,
                    description: 'OK',
                    content: new OAT\JsonContent(ref: '#/components/schemas/MedicalClinicResponse')
                ),
                new OAT\Response(ref: '#/components/responses/validation', response: 422),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        )
    ]
    public function store(MedicalClinicRequest $request): MedicalClinicResource
    {
        return MedicalClinicResource::make(
            $this->medicalClinicService->store(
                $request->validated()
            )
        );
    }

    #[
        OAT\Put(
            path: '/medicalClinics/{medicalClinic}',
            summary: 'Изменяет данные мед. учреждения по идентификатору',
            security: [['bearerAuth' => []]],
            requestBody: new OAT\RequestBody(
                required: true,
                content: new OAT\JsonContent(
                    ref: '#/components/schemas/MedicalClinicRequest'
                )
            ),
            tags: ['Медицинское учреждение'],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'OK',
                    content: new OAT\JsonContent(ref: '#/components/schemas/MedicalClinicResponse')
                ),
                new OAT\Response(ref: '#/components/responses/notFound', response: 404),
                new OAT\Response(ref: '#/components/responses/validation', response: 422),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        ),
        OAT\Parameter(name: 'doctor', ref: '#/components/parameters/doctor')
    ]
    public function update(MedicalClinicRequest $request, int $id): MedicalClinicResource
    {
        return MedicalClinicResource::make(
            $this->medicalClinicService->update(
                $id, $request->validated()
            )
        );
    }

    #[
        OAT\Delete(
            path: '/medicalClinics/{medicalClinic}',
            summary: 'Удаляет мед. учреждение по идентификатору',
            security: [['bearerAuth' => []]],
            tags: ['Медицинское учреждение'],
            responses: [
                new OAT\Response(ref: '#/components/responses/noContent', response: 204),
                new OAT\Response(ref: '#/components/responses/notFound', response: 404),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        ),
        OAT\Parameter(name: 'medicalClinic', ref: '#/components/parameters/medicalClinic')
    ]
    public function destroy(int $id): Response
    {
        $this->medicalClinicService->destroy($id);

        return response()->noContent();
    }
}
