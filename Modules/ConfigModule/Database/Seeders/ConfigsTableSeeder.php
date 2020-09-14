<?php

namespace Modules\ConfigModule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\ConfigModule\Entities\Config;
use Modules\ConfigModule\Entities\ConfigCategory;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $config = Config::class;
        $category = ConfigCategory::class;

        $category::create([
            'title' => 'General',

        ]);
        $category::create([
            'title' => 'Contact',

        ]);

        /*General*/
        $config::create([
            'is_static' => 0,
            'static_value' => '',
            'var' => 'title',
            'ar' => [
                'display_name' => 'اسم الموقع',
                'value' => 'تسوق',
            ],
            'en' => [
                'display_name' => 'website name',
                'value' => 'Shopping',
            ],
            'type' => 1,
            'cat_id' => 1,

        ]);

        $config::create([
            'is_static' => 0,
            'static_value' => '',
            'var' => 'about',
            'ar' => [
                'display_name' => 'وصف الموقع',
                'value' => 'ssss',
            ],
            'en' => [
                'display_name' => 'website description',
                'value' => 'website description',
            ],
            'type' => 1,
            'cat_id' => 1
        ]);


        $config::create([
            'is_static' => 0,
            'static_value' => '',
            'var' => 'about_index',
            'ar' => [
                'display_name' => 'وصف مختصر للموقع',
                'value' => 'وصف مختصر للموقع',
            ],
            'en' => [
                'display_name' => 'short description',
                'value' => 'short description',
            ],
            'type' => 3,
            'cat_id' => 1
        ]);

        /*Contact*/

        $config::create([
            'is_static' => 1,
            'static_value' => '0123456789',
            'ar' => [
                'display_name' => 'رقم الهاتف',
                'value' => 'dsadas',
            ],
            'en' => [
                'display_name' => 'phone',
            ],
            'var' => 'phone',
            'type' => 1,
            'cat_id' => 2
        ]);
        $config::create([
            'var' => 'email',
            'is_static' => 1,
            'static_value' => '0123456789',
            'ar' => [
                'display_name' => 'البريد الالكتروني',
            ],
            'en' => [
                'display_name' => 'email',
            ],
            'type' => 1,
            'cat_id' => 2
        ]);
        $config::create([
            'var' => 'tw_link',
            'is_static' => 1,
            'static_value' => 'tw_link',
            'ar' => [
                'display_name' => 'تويتر',
            ],
            'en' => [
                'display_name' => 'twitter',
            ],
            'type' => 1,
            'cat_id' => 2
        ]);
        $config::create([
            'var' => 'fb_link',
            'is_static' => 1,
            'static_value' => 'fb_link',
            'ar' => [
                'display_name' => 'فيس بوك',
            ],
            'en' => [
                'display_name' => 'facebook',
            ],
            'type' => 1,
            'cat_id' => 2
        ]);

        $config::create([
            'var' => 'youtube',
            'is_static' => 1,
            'static_value' => 'youtube',
            'ar' => [
                'display_name' => 'اليوتيوب',
            ],
            'en' => [
                'display_name' => 'youtube',
            ],
            'type' => 1,
            'cat_id' => 2
        ]);
        $config::create([
            'var' => 'instgram',
            'is_static' => 1,
            'static_value' => 'instgram',
            'ar' => [
                'display_name' => 'انستجرام',
            ],
            'en' => [
                'display_name' => 'Instgram',
            ],
            'type' => 1,
            'cat_id' => 2
        ]);
        $config::create([
            'var' => 'telegram',
            'is_static' => 1,
            'static_value' => 'telegram',
            'ar' => [
                'display_name' => 'تليجرام',
            ],
            'en' => [
                'display_name' => 'telegram',
            ],
            'type' => 1,
            'cat_id' => 2
        ]);

    }
}
