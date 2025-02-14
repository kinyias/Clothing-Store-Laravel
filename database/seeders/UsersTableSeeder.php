<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Tỉ Tỉ',
                'email' => 'admin@gmail.com',
                'mobile' => '1234567891',
                'email_verified_at' => NULL,
                'password' => '$2y$12$b9NWBIviQccjWDUBS.LBjOS/6Oh9LhbAub2ckhvLrqxu4bi2pO0i6',
                'utype' => 'ADM',
                'remember_token' => NULL,
                'created_at' => '2025-02-12 01:40:34',
                'updated_at' => '2025-02-12 01:40:34',
            ),
        ));
        
        
    }
}