<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            [
                "product_id" => 1,
                "rating" => 1,
                "message" => "keren banget",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "product_id" => 1,
                "rating" => 2,
                "message" => "keren banget",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "product_id" => 2,
                "rating" => 3,
                "message" => "keren banget",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "product_id" => 3,
                "rating" => 2,
                "message" => "keren banget",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "product_id" => 3,
                "rating" => 4,
                "message" => "keren banget",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                "product_id" => 1,
                "rating" => 2,
                "message" => "keren banget",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
