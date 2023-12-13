<?php

namespace App\Services;

use App\Models\Doctor;

class DoctorService
{
    /**
     * Добавляет нового доктора
     */
    public function store(array $data): Doctor
    {
        return Doctor::create($data);
    }

    /**
     * Обновляет данные доктора
     */
    public function update(int $id, array $data): Doctor
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->update($data);

        return $doctor;
    }

    /**
     * Удаляет доктора по идентификатору
     */
    public function destroy(int $id): bool
    {
        return Doctor::findOrFail($id)->delete();
    }
}
