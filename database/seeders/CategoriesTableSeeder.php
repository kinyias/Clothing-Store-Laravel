<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'category1',
                'slug' => 'category1',
                'image' => '1739335574.png',
                'parent_id' => NULL,
                'created_at' => '2025-02-12 04:46:14',
                'updated_at' => '2025-02-12 05:00:46',
            ),
        ));
        
        
    }
}