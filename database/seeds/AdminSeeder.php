<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'superadmin',
            'nama_depan'   => 'super',
            'nama_belakang' => 'admin',
            'email' => 'superadmin@gmail.com',
            'area_id' => '1',
            'no_hp' => '7777',
            'password' => bcrypt('12345678'),
            'rule' => 'superadmin' ,
            'last_login_at' => '2019-11-29 09:38:45',
            'current_login_at' => '2019-12-03 06:46:59',
            'remember_token' => '',
            'created_at' => '2019-11-29 09:38:24',
            'updated_at' => '2019-12-03 06:46:59'
        ]);
    }
}
