<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Http\Resources\DoctorResource;
use App\Models\Doctor;
use App\Services\DoctorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use OpenApi\Attributes as OAT;

class DoctorController extends Controller
{
    public function __construct(
        public readonly DoctorService $doctorService
    ) {
    }

    #[
        OAT\Get(
            path: '/doctors',
            summary: 'Возвращает список докторов',
            security: [['bearerAuth' => []]],
            tags: ['Доктор'],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'OK',
                    content: new OAT\JsonContent(ref: '#/components/schemas/DoctorResponseWrapper')
                ),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        )
    ]
    public function index(): AnonymousResourceCollection
    {
        return DoctorResource::collection(
            Doctor::paginate()
        );
    }

    #[
        OAT\Post(
            path: '/doctors',
            summary: 'Добавляет нового доктора',
            security: [['bearerAuth' => []]],
            requestBody: new OAT\RequestBody(
                required: true,
                content: new OAT\JsonContent(
                    ref: '#/components/schemas/DoctorRequest'
                )
            ),
            tags: ['Доктор'],
            responses: [
                new OAT\Response(
                    response: 201,
                    description: 'OK',
                    content: new OAT\JsonContent(ref: '#/components/schemas/DoctorResource')
                ),
                new OAT\Response(ref: '#/components/responses/validation', response: 422),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        )
    ]
    public function store(DoctorRequest $request): DoctorResource
    {
        return DoctorResource::make(
            $this->doctorService->store(
                $request->validated()
            )
        );
    }

    #[
        OAT\Put(
            path: '/doctors/{doctor}',
            summary: 'Изменяет данные доктора по идентификатору',
            security: [['bearerAuth' => []]],
            requestBody: new OAT\RequestBody(
                required: true,
                content: new OAT\JsonContent(
                    ref: '#/components/schemas/DoctorRequest'
                )
            ),
            tags: ['Доктор'],
            responses: [
                new OAT\Response(
                    response: 200,
                    description: 'OK',
                    content: new OAT\JsonContent(ref: '#/components/schemas/DoctorResource')
                ),
                new OAT\Response(ref: '#/components/responses/notFound', response: 404),
                new OAT\Response(ref: '#/components/responses/validation', response: 422),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        ),
        OAT\Parameter(name: 'doctor', ref: '#/components/parameters/doctor')
    ]
    public function update(DoctorRequest $request, int $id): DoctorResource
    {
        return DoctorResource::make(
            $this->doctorService->update(
                $id, $request->validated()
            )
        );
    }

    #[
        OAT\Delete(
            path: '/doctors/{doctor}',
            summary: 'Удаляет доктора по идентификатору',
            security: [['bearerAuth' => []]],
            tags: ['Доктор'],
            responses: [
                new OAT\Response(ref: '#/components/responses/noContent', response: 204),
                new OAT\Response(ref: '#/components/responses/notFound', response: 404),
                new OAT\Response(ref: '#/components/responses/unauthenticated', response: 401),
            ],
        ),
        OAT\Parameter(name: 'doctor', ref: '#/components/parameters/doctor')
    ]
    public function destroy(int $id): Response
    {
        $this->doctorService->destroy($id);

        return response()->noContent();
    }
}
