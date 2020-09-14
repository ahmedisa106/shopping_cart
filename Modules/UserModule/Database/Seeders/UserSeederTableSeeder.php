<?php

namespace Modules\UserModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\UserModule\Entities\User;

class UserSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@admin.com',
            'phone' => '01023442308',
            'address' => 'shebin elkomm',
            'photo' => 'default.png',

        ]);


    }
}
