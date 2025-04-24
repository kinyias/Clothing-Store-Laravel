<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MaterialsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('materials')->delete();
        
        \DB::table('materials')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Polyester',
                'code' => 'pol',
                'created_at' => '2025-04-01 02:52:01',
                'updated_at' => '2025-04-01 02:52:01',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Lanh',
                'code' => 'la',
                'created_at' => '2025-04-01 02:52:20',
                'updated_at' => '2025-04-01 02:52:20',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '100% Polyester Nano',
                'code' => 'polnano',
                'created_at' => '2025-04-01 02:52:51',
                'updated_at' => '2025-04-01 02:52:51',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '90% Nylon 10% Spandex',
                'code' => 'nylon',
                'created_at' => '2025-04-01 02:53:09',
                'updated_at' => '2025-04-01 02:53:09',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '100% Renu Polyester',
                'code' => 'renu',
                'created_at' => '2025-04-01 02:54:34',
                'updated_at' => '2025-04-01 02:54:34',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => '65% Polyester 15% Rayon 20% Acrylic',
                'code' => 'pra',
                'created_at' => '2025-04-01 02:55:06',
                'updated_at' => '2025-04-01 02:55:14',
            ),
        ));
        
        
    }
}