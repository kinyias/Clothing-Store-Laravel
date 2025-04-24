<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sizes')->delete();
        
        \DB::table('sizes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Size S',
                'code' => 'S',
                'created_at' => '2025-04-01 02:50:06',
                'updated_at' => '2025-04-01 02:50:06',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Size M',
                'code' => 'M',
                'created_at' => '2025-04-01 02:50:16',
                'updated_at' => '2025-04-01 02:50:16',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Size L',
                'code' => 'L',
                'created_at' => '2025-04-01 02:50:28',
                'updated_at' => '2025-04-01 02:50:28',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Size XL',
                'code' => 'XL',
                'created_at' => '2025-04-01 02:50:49',
                'updated_at' => '2025-04-01 02:50:49',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Size XXL',
                'code' => 'XXL',
                'created_at' => '2025-04-01 02:51:03',
                'updated_at' => '2025-04-01 02:51:03',
            ),
        ));
        
        
    }
}