<?php

namespace App\Services;

use App\Models\MedicalClinic;

class MedicalClinicService
{
    /**
     * Добавляет новое медицинское учреждение
     */
    public function store(array $data): MedicalClinic
    {
        return MedicalClinic::create($data);
    }

    /**
     * Обновляет данные доктора
     */
    public function update(int $id, array $data): MedicalClinic
    {
        $medicalClinic = MedicalClinic::findOrFail($id);

        $medicalClinic->update($data);

        return $medicalClinic;
    }

    /**
     * Удаляет медицинское учреждение по идентификатору
     */
    public function destroy(int $id): bool
    {
        return MedicalClinic::findOrFail($id)->delete();
    }
}
