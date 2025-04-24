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
                'id' => 1,
                'name' => 'Áo',
                'slug' => 'ao',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743472932/clothingstore/rxxswyakqocbehspdwb8.png',
                'created_at' => '2025-04-01 02:02:13',
                'updated_at' => '2025-04-01 02:02:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Quần',
                'slug' => 'quan',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743473017/clothingstore/hemcspcu6iilnkkgw0gn.png',
                'created_at' => '2025-04-01 02:03:38',
                'updated_at' => '2025-04-01 02:03:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Váy & Đầm',
                'slug' => 'vay-dam',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743473037/clothingstore/aobgkeakjicxojth6b2f.png',
                'created_at' => '2025-04-01 02:03:58',
                'updated_at' => '2025-04-01 02:03:58',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Phụ kiện',
                'slug' => 'phu-kien',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743473119/clothingstore/vrnxwmptgxvibdqbgeps.png',
                'created_at' => '2025-04-01 02:05:20',
                'updated_at' => '2025-04-01 02:05:20',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Đồ bộ',
                'slug' => 'do-bo',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743473285/clothingstore/nju0azaqyyspahtvxq8b.png',
                'created_at' => '2025-04-01 02:08:05',
                'updated_at' => '2025-04-01 02:08:05',
            ),
        ));
        
        
    }
}