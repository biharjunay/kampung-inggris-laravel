<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('heroes')->insert([
            [
                'key' => 'registration_image',
                'image_url' => ''
            ],
            [
                'key' => 'header_image',
                'image_url' => ''
            ],
            [
                'key' => 'about_image',
                'image_url' => ''
            ],
        ]);
    }
}
