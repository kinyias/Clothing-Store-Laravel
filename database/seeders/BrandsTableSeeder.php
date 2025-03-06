<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Brand 1',
                'slug' => 'brand-1',
                'image' => '1739328137.png',
                'created_at' => '2025-02-12 02:42:17',
                'updated_at' => '2025-02-12 03:32:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'brandtest',
                'slug' => 'brandtest',
                'image' => '1740990675.jpg',
                'created_at' => '2025-03-03 08:31:15',
                'updated_at' => '2025-03-03 08:47:16',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '1ee',
                'slug' => '1ee',
                'image' => '1740986835.jpg',
                'created_at' => '2025-03-03 08:48:35',
                'updated_at' => '2025-03-03 08:48:35',
            ),
        ));
        
        
    }
}