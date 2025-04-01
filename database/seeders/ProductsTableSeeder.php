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
                'name' => 'Áo khoác văn phòng',
                'slug' => 'ao-khoac-van-phong',
                'short_description' => 'Áo khoác',
                'description' => 'Chất liệu: 90% Nylon 10% Spandex
Độ bền màu cao, hạn chế nhăn.
Không hấp hút chất bẩn, dễ vệ sinh.
Thiết kế trẻ trung với kiểu dáng thể thao dễ mặc, dễ phối đồ.
Tone màu phóng khoáng, cá tính.',
                'regular_price' => '1480.00',
                'sale_price' => '960.00',
                'stock_status' => 'instock',
                'featured' => 1,
                'quantity' => 200,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743475361/clothingstore/products/uzr8btqlfarvxao33k0w.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743475391/clothingstore/products/gallery/ca3aymehwpfwsdiyitna.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743475394/clothingstore/products/gallery/uhysqieajxg3ctumvust.webp',
                'category_id' => 1,
                'brand_id' => 5,
                'created_at' => '2025-04-01 02:21:21',
                'updated_at' => '2025-04-01 03:22:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Áo khoác dù',
                'slug' => 'ao-khoac-du',
                'short_description' => 'Áo khoác',
                'description' => 'Chất liệu: 100% Renu Polyester
Độ bền màu cao, hạn chế nhăn.
Không hấp hút chất bẩn, dễ vệ sinh.
Thiết kế trẻ trung với kiểu dáng thể thao dễ mặc, dễ phối đồ.
Tone màu phóng khoáng, cá tính.',
                'regular_price' => '1000.00',
                'sale_price' => '980.00',
                'stock_status' => 'instock',
                'featured' => 1,
                'quantity' => 400,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743477447/clothingstore/products/p07e5uucdvhber5l76lj.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743477467/clothingstore/products/gallery/dz1ylpv9lxvwieicirky.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743477470/clothingstore/products/gallery/uz25bnk7vlnowzzioc0w.webp',
                'category_id' => 1,
                'brand_id' => 5,
                'created_at' => '2025-04-01 03:17:27',
                'updated_at' => '2025-04-01 03:23:03',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Áo khoác thời trang',
                'slug' => 'ao-khoac-thoi-trang',
                'short_description' => 'Áo khoác',
                'description' => 'Chất liệu: 100% Renu Polyester
Độ bền màu cao, hạn chế nhăn.
Không hấp hút chất bẩn, dễ vệ sinh.
Thiết kế trẻ trung với kiểu dáng thể thao dễ mặc, dễ phối đồ.
Tone màu phóng khoáng, cá tính.',
                'regular_price' => '500.00',
                'sale_price' => '300.00',
                'stock_status' => 'instock',
                'featured' => 0,
                'quantity' => 506,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743477679/clothingstore/products/o3ihgvmgerq06er5easl.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743477682/clothingstore/products/gallery/iq4hsfmvdoy6fa8lpsy5.webp',
                'category_id' => 1,
                'brand_id' => 7,
                'created_at' => '2025-04-01 03:21:23',
                'updated_at' => '2025-04-01 03:23:21',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Quần tây nam',
                'slug' => 'quan-tay-nam',
                'short_description' => 'Quần tây nam',
                'description' => 'Quần tây kiểu dáng S-Form thể thao, mông đùi boom rộng.
Màu sắc trung tính dễ phối đồ.
Chất liệu:70% Polyester, 27% Rayon, 3% Spandex',
                'regular_price' => '400.00',
                'sale_price' => '350.00',
                'stock_status' => 'instock',
                'featured' => 1,
                'quantity' => 503,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478069/clothingstore/products/mpca73qdea48gpmgmpxd.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478227/clothingstore/products/gallery/dobicgnyqa5subrlx2be.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478230/clothingstore/products/gallery/tq6du6d91zvrd7b5oo1s.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478233/clothingstore/products/gallery/etuiuhhqihhfmfsvg2t2.webp',
                'category_id' => 2,
                'brand_id' => 4,
                'created_at' => '2025-04-01 03:28:00',
                'updated_at' => '2025-04-01 03:30:33',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Quần tây văn phòng',
                'slug' => 'quan-tay-van-phong',
                'short_description' => 'Quần văn phòng',
                'description' => 'Quần tây form slim fit có tăng đơ tôn dáng người mặc. 
Màu sắc trung tính dễ phối đồ.
Chất liệu:70% Polyester, 27% Rayon, 3% Spandex',
                'regular_price' => '450.00',
                'sale_price' => '360.00',
                'stock_status' => 'instock',
                'featured' => 1,
                'quantity' => 56,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478401/clothingstore/products/hpiwyqeysrejmtk8fnel.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478404/clothingstore/products/gallery/idtg0chnmrceyg9vzlbs.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478407/clothingstore/products/gallery/zkpfepk77ggdafkou9up.webp',
                'category_id' => 2,
                'brand_id' => 4,
                'created_at' => '2025-04-01 03:33:28',
                'updated_at' => '2025-04-01 03:33:28',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Áo len nam',
                'slug' => 'ao-len-nam',
                'short_description' => 'Áo len nam',
                'description' => 'Áo len kiểu dáng reguler fit tôn dáng người mặc
Màu sắc trẻ trung, năng động
Chất liệu: 55% Acrylic 45% Cotton',
                'regular_price' => '780.00',
                'sale_price' => '650.00',
                'stock_status' => 'instock',
                'featured' => 1,
                'quantity' => 450,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478688/clothingstore/products/ipqmkgmrywvtacvqp0ri.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478691/clothingstore/products/gallery/xbbkxm6cs3encjtrznry.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478694/clothingstore/products/gallery/gvtaimmackltcr5wultc.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478696/clothingstore/products/gallery/pwtqu7iulmnnpgtucowd.webp',
                'category_id' => 1,
                'brand_id' => 6,
                'created_at' => '2025-04-01 03:38:17',
                'updated_at' => '2025-04-01 03:38:17',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Thắt lưng',
                'slug' => 'that-lung',
                'short_description' => 'Thắt lưng',
                'description' => 'Dây lưng khóa trượt, da thật, màu nâu.',
                'regular_price' => '310.00',
                'sale_price' => '300.00',
                'stock_status' => 'instock',
                'featured' => 0,
                'quantity' => 12,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478952/clothingstore/products/yi5zgwioiofg9fmk7ws5.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743478954/clothingstore/products/gallery/bqbnc7lvnmjmfhc4vthw.webp',
                'category_id' => 4,
                'brand_id' => 2,
                'created_at' => '2025-04-01 03:42:35',
                'updated_at' => '2025-04-01 03:42:35',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Bộ Veston',
                'slug' => 'bo-veston',
                'short_description' => 'Veston',
                'description' => 'Bộ Vest Nam được thiết kế và đảm bảo chất lượng theo tiêu chuẩn Nhật Bản.
Form áo cứng cáp với lớp đệm giúp tôn lên vóc dáng mạnh mẽ, lịch lãm của nam giới.
Chất liệu vải nhẹ, thoáng, dễ dàng trong vận động và di chuyển',
                'regular_price' => '3560.00',
                'sale_price' => '3500.00',
                'stock_status' => 'instock',
                'featured' => 1,
                'quantity' => 20,
                'image' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743479179/clothingstore/products/r9m9x8qlkjyknpjhxzre.webp',
                'images' => 'https://res.cloudinary.com/ddmqtxja3/image/upload/v1743479182/clothingstore/products/gallery/jw407vfmvbo0l2o6wgrv.webp,https://res.cloudinary.com/ddmqtxja3/image/upload/v1743479185/clothingstore/products/gallery/lycnrmb5jokfqxlziacd.webp',
                'category_id' => 1,
                'brand_id' => 6,
                'created_at' => '2025-04-01 03:46:25',
                'updated_at' => '2025-04-01 03:46:25',
            ),
        ));
        
        
    }
}