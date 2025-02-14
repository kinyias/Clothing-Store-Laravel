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
        ));
        
        
    }
}