<?php

namespace Modules\CommonModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\CommonModule\Entities\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

       Language::create([
           'lang'=>'Arabic',
           'display_lang'=>'ar',
           'active'=>1

       ]);
        Language::create([
            'lang'=>'English',
            'display_lang'=>'en',
            'active'=>1

        ]);
    }
}
