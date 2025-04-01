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
                'name' => 'Zara',
                'slug' => 'zara',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743414621/clothingstore/jmebfrqoatxrvbrvh0zb.png',
                'created_at' => '2025-03-31 09:50:21',
                'updated_at' => '2025-03-31 09:50:21',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Nike',
                'slug' => 'nike',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743414650/clothingstore/r4bklxad7vjandavfikq.png',
                'created_at' => '2025-03-31 09:50:50',
                'updated_at' => '2025-03-31 09:50:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Puma',
                'slug' => 'puma',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743414670/clothingstore/byk4zggxnuavygyd5yzm.png',
                'created_at' => '2025-03-31 09:51:10',
                'updated_at' => '2025-03-31 09:51:10',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Adidas',
                'slug' => 'adidas',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743414694/clothingstore/krzrtbwrxqkkhlt2q28u.png',
                'created_at' => '2025-03-31 09:51:34',
                'updated_at' => '2025-03-31 09:51:34',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Kenwood',
                'slug' => 'kenwood',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743414719/clothingstore/uz7s7xpnidpg6a0rhdvh.png',
                'created_at' => '2025-03-31 09:51:59',
                'updated_at' => '2025-03-31 09:51:59',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Ikea',
                'slug' => 'ikea',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743414743/clothingstore/umsqgukibw0ikzevkpje.png',
                'created_at' => '2025-03-31 09:52:23',
                'updated_at' => '2025-03-31 09:52:23',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Jordan',
                'slug' => 'jordan',
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743444741/clothingstore/r2rso45zltjbx1k5n7fg.png',
                'created_at' => '2025-03-31 18:11:53',
                'updated_at' => '2025-03-31 18:12:21',
            ),
        ));
        
        
    }
}