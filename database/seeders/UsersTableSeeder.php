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
                'name' => 'Minh Luan',
                'email' => 'abc@gmail.com',
                'mobile' => '0364640984',
                'email_verified_at' => NULL,
                'password' => '$2y$12$RK/k4fzLiOFVop1T1OUpFeOfAEDIwvWHlxDDJijpbRYjGREWE8j3C',
                'utype' => 'USR',
                'remember_token' => NULL,
                'created_at' => '2025-03-31 09:48:33',
                'updated_at' => '2025-03-31 09:48:33',
            ),
        ));
        
        
    }
}