<?php

namespace Database\Seeders;

use App\Models\Part;
use Illuminate\Database\Seeder;

class PartsTableSeeder extends Seeder
{
    public function run()
    {
        Part::truncate();

        $parts = [
            // Registros de la Tabla 4
            [
                'id' => '001',
                'name' => 'B01',
                'theoretical_weight' => 4,
                'real_weight' => 4.5,
                'status' => 'Fabricado',
                'block_id' => '135-1110', // Ajustado para coincidir con BlocksTableSeeder
                'registration_date' => '2020-09-11 00:00:00',
                'registered_by' => 2, // Gabriel
            ],
            [
                'id' => '002',
                'name' => 'A02',
                'theoretical_weight' => 20,
                'real_weight' => null,
                'status' => 'Pendiente',
                'block_id' => '135-3310',
                'registration_date' => null,
                'registered_by' => null,
            ],
            [
                'id' => '003',
                'name' => 'H12',
                'theoretical_weight' => 16,
                'real_weight' => 16.6,
                'status' => 'Fabricado',
                'block_id' => '100-2210',
                'registration_date' => '2020-09-11 00:00:00',
                'registered_by' => 3, // Sergio
            ],
            [
                'id' => '004',
                'name' => 'R23',
                'theoretical_weight' => 8,
                'real_weight' => null,
                'status' => 'Pendiente',
                'block_id' => '130-1110',
                'registration_date' => null,
                'registered_by' => null,
            ],
            [
                'id' => '005',
                'name' => 'J25',
                'theoretical_weight' => 11,
                'real_weight' => null,
                'status' => 'Pendiente',
                'block_id' => '130-1110',
                'registration_date' => null,
                'registered_by' => null,
            ],
            [
                'id' => '006',
                'name' => 'U23',
                'theoretical_weight' => 5,
                'real_weight' => 4,
                'status' => 'Fabricado',
                'block_id' => '130-1110',
                'registration_date' => '2020-09-11 00:00:00',
                'registered_by' => 3, // Sergio
            ],
            [
                'id' => '007',
                'name' => 'E29',
                'theoretical_weight' => 8,
                'real_weight' => 7.2,
                'status' => 'Fabricado',
                'block_id' => '130-1110',
                'registration_date' => '2020-09-11 00:00:00',
                'registered_by' => 1, // Luis
            ],
            // Registros adicionales de la Tabla 5
            [
                'id' => '008',
                'name' => 'E21',
                'theoretical_weight' => 18,
                'real_weight' => null,
                'status' => 'Pendiente',
                'block_id' => '130-3510',
                'registration_date' => null,
                'registered_by' => null,
            ],
            // Puedes agregar más piezas según sea necesario
        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }
}