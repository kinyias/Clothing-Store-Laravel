<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('products')->delete();

        \DB::table('products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Product 001',
                'slug' => 'product-001',
                'short_description' => 'Description hereUpdateee',
                'description' => 'Description long',
                'regular_price' => '600.00',
                'sale_price' => '300.00',
                'SKU' => 'KIIY111',
                'stock_status' => 'outofstock',
                'featured' => 1,
                'quantity' => 9888,
                'image' => '1739478589.jpg',
                'images' => '1739479871.1.jpg,1739479871.2.jpg,1739479871.3.jpg',
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => '2025-02-13 09:57:39',
                'updated_at' => '2025-02-13 20:51:12',
            ),
            1 =>
            array (
                'id' => 3,
                'name' => 'Pro03',
                'slug' => 'pro03',
                'short_description' => 'fff',
                'description' => 'cccc',
                'regular_price' => '500.00',
                'sale_price' => '300.00',
                'SKU' => 'KIIY111c',
                'stock_status' => 'instock',
                'featured' => 0,
                'quantity' => 6277,
                'image' => '1739479407.jpg',
                'images' => '1739479889.1.jpg,1739479889.2.jpg,1739479889.3.jpg',
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => '2025-02-13 20:43:28',
                'updated_at' => '2025-02-13 20:51:30',
            ),
            2 =>
            array (
                'id' => 5,
                'name' => 'Minh Luân',
                'slug' => 'minh-luan',
                'short_description' => 'dgd',
                'description' => 'dgdgdgdg',
                'regular_price' => '500.00',
                'sale_price' => '300.00',
                'SKU' => 'KIIY114',
                'stock_status' => 'instock',
                'featured' => 0,
                'quantity' => 6277,
                'image' => '1739734149.jpg',
                'images' => '1739734149.1.jpg,1739734149.2.jpg,1739734149.3.jpg',
                'category_id' => 1,
                'brand_id' => 1,
                'created_at' => '2025-02-16 19:29:13',
                'updated_at' => '2025-02-16 20:23:34',
            ),
        ));


    }
}
