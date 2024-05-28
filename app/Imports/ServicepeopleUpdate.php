<?php

namespace App\Imports;

use App\Models\Serviceperson;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ServicepeopleUpdate implements ToModel, WithChunkReading, WithUpserts
{

    use Importable;

    public function model(array $row): Model|Serviceperson|null
    {
        return new Serviceperson([
            'number' => $row['number'],
            'battalion_id' => $row['battalion_id'],
            'company_id' => $row['company_id'],
            'department_id' => $row['department_id'] ?? null,
            'address_line_1' => $row['address_line_1'],
            'address_line_2' => $row['address_line_2'] ?? null,
            'city_id' => $row['city_id'],
        ]);
    }

    public function uniqueBy(): string
    {
        return 'number';
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
