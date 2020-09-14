<?php

namespace Modules\AdminModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\AdminModule\Entities\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Admin::create([
           'name'=>'admin',
           'username'=>'admin',
           'email'=>'admin@admin.com',
           'password'=>bcrypt('admin'),

        ]);
    }
}
