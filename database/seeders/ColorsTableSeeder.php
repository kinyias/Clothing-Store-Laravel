<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('colors')->delete();
        
        \DB::table('colors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Xám',
                'code' => '#ababab',
                'created_at' => '2025-04-01 02:47:00',
                'updated_at' => '2025-04-01 02:47:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Đen',
                'code' => '#0a0a0a',
                'created_at' => '2025-04-01 02:47:39',
                'updated_at' => '2025-04-01 02:47:39',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Xanh',
                'code' => '#264a2b',
                'created_at' => '2025-04-01 02:48:04',
                'updated_at' => '2025-04-01 02:48:04',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Tím',
                'code' => '#5673b3',
                'created_at' => '2025-04-01 02:48:34',
                'updated_at' => '2025-04-01 02:48:34',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Kem',
                'code' => '#f7f4c3',
                'created_at' => '2025-04-01 02:48:56',
                'updated_at' => '2025-04-01 02:48:56',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Nâu',
                'code' => '#99571a',
                'created_at' => '2025-04-01 02:49:09',
                'updated_at' => '2025-04-01 02:49:09',
            ),
        ));
        
        
    }
}