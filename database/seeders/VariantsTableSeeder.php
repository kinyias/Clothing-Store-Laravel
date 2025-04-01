<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VariantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('variants')->delete();
        
        \DB::table('variants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'color_id' => 1,
                'size_id' => 1,
                'material_id' => 1,
                'created_at' => '2025-04-01 02:56:41',
                'updated_at' => '2025-04-01 02:56:41',
                'regular_price' => '1480.000',
                'sale_price' => '960.000',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 1,
                'color_id' => 1,
                'size_id' => 2,
                'material_id' => 1,
                'created_at' => '2025-04-01 02:57:27',
                'updated_at' => '2025-04-01 02:57:27',
                'regular_price' => '1560.000',
                'sale_price' => '1320.000',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 1,
                'color_id' => 1,
                'size_id' => 3,
                'material_id' => 1,
                'created_at' => '2025-04-01 02:57:57',
                'updated_at' => '2025-04-01 02:58:10',
                'regular_price' => '1520.000',
                'sale_price' => '1326.000',
            ),
            3 => 
            array (
                'id' => 4,
                'product_id' => 1,
                'color_id' => 2,
                'size_id' => 3,
                'material_id' => 3,
                'created_at' => '2025-04-01 02:59:25',
                'updated_at' => '2025-04-01 02:59:41',
                'regular_price' => '1650.000',
                'sale_price' => '1350.000',
            ),
            4 => 
            array (
                'id' => 5,
                'product_id' => 2,
                'color_id' => 5,
                'size_id' => 1,
                'material_id' => 5,
                'created_at' => '2025-04-01 03:48:17',
                'updated_at' => '2025-04-01 03:48:17',
                'regular_price' => '1000.000',
                'sale_price' => '980.000',
            ),
            5 => 
            array (
                'id' => 6,
                'product_id' => 2,
                'color_id' => 5,
                'size_id' => 2,
                'material_id' => 5,
                'created_at' => '2025-04-01 03:48:57',
                'updated_at' => '2025-04-01 03:48:57',
                'regular_price' => '1000.000',
                'sale_price' => '980.000',
            ),
            6 => 
            array (
                'id' => 7,
                'product_id' => 2,
                'color_id' => 5,
                'size_id' => 3,
                'material_id' => 5,
                'created_at' => '2025-04-01 03:49:34',
                'updated_at' => '2025-04-01 03:49:34',
                'regular_price' => '1000.000',
                'sale_price' => '990.000',
            ),
            7 => 
            array (
                'id' => 8,
                'product_id' => 3,
                'color_id' => 2,
                'size_id' => 1,
                'material_id' => 5,
                'created_at' => '2025-04-01 03:50:30',
                'updated_at' => '2025-04-01 03:50:30',
                'regular_price' => '500.000',
                'sale_price' => '300.000',
            ),
            8 => 
            array (
                'id' => 9,
                'product_id' => 3,
                'color_id' => 6,
                'size_id' => 2,
                'material_id' => 5,
                'created_at' => '2025-04-01 03:50:55',
                'updated_at' => '2025-04-01 03:51:08',
                'regular_price' => '600.000',
                'sale_price' => '540.000',
            ),
            9 => 
            array (
                'id' => 10,
                'product_id' => 3,
                'color_id' => 2,
                'size_id' => 3,
                'material_id' => 6,
                'created_at' => '2025-04-01 03:52:14',
                'updated_at' => '2025-04-01 03:52:14',
                'regular_price' => '750.000',
                'sale_price' => '680.000',
            ),
            10 => 
            array (
                'id' => 11,
                'product_id' => 4,
                'color_id' => 2,
                'size_id' => 1,
                'material_id' => 6,
                'created_at' => '2025-04-01 03:53:03',
                'updated_at' => '2025-04-01 03:53:03',
                'regular_price' => '400.000',
                'sale_price' => '350.000',
            ),
            11 => 
            array (
                'id' => 12,
                'product_id' => 4,
                'color_id' => 2,
                'size_id' => 2,
                'material_id' => 6,
                'created_at' => '2025-04-01 03:53:24',
                'updated_at' => '2025-04-01 03:53:24',
                'regular_price' => '500.000',
                'sale_price' => '490.000',
            ),
            12 => 
            array (
                'id' => 13,
                'product_id' => 4,
                'color_id' => 2,
                'size_id' => 3,
                'material_id' => 6,
                'created_at' => '2025-04-01 03:54:00',
                'updated_at' => '2025-04-01 03:54:00',
                'regular_price' => '500.000',
                'sale_price' => '490.000',
            ),
            13 => 
            array (
                'id' => 14,
                'product_id' => 4,
                'color_id' => 1,
                'size_id' => 2,
                'material_id' => 6,
                'created_at' => '2025-04-01 03:55:05',
                'updated_at' => '2025-04-01 03:55:05',
                'regular_price' => '500.000',
                'sale_price' => '480.000',
            ),
            14 => 
            array (
                'id' => 15,
                'product_id' => 6,
                'color_id' => 3,
                'size_id' => 2,
                'material_id' => 2,
                'created_at' => '2025-04-01 03:56:16',
                'updated_at' => '2025-04-01 03:56:16',
                'regular_price' => '760.000',
                'sale_price' => '560.000',
            ),
            15 => 
            array (
                'id' => 16,
                'product_id' => 6,
                'color_id' => 2,
                'size_id' => 1,
                'material_id' => 2,
                'created_at' => '2025-04-01 03:56:46',
                'updated_at' => '2025-04-01 03:57:09',
                'regular_price' => '780.000',
                'sale_price' => '770.000',
            ),
            16 => 
            array (
                'id' => 17,
                'product_id' => 7,
                'color_id' => 2,
                'size_id' => 1,
                'material_id' => 1,
                'created_at' => '2025-04-01 04:00:10',
                'updated_at' => '2025-04-01 04:00:10',
                'regular_price' => '310.000',
                'sale_price' => '300.000',
            ),
            17 => 
            array (
                'id' => 18,
                'product_id' => 8,
                'color_id' => 3,
                'size_id' => 2,
                'material_id' => 5,
                'created_at' => '2025-04-01 04:00:58',
                'updated_at' => '2025-04-01 04:00:58',
                'regular_price' => '3560.000',
                'sale_price' => '3500.000',
            ),
            18 => 
            array (
                'id' => 19,
                'product_id' => 8,
                'color_id' => 3,
                'size_id' => 3,
                'material_id' => 5,
                'created_at' => '2025-04-01 04:02:04',
                'updated_at' => '2025-04-01 04:02:04',
                'regular_price' => '3590.000',
                'sale_price' => '3530.000',
            ),
        ));
        
        
    }
}