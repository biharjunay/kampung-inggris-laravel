<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'type_id' => 1, // type_id 1
                'name' => 'Item 1',
                'image_url' => 'https://example.com/item1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2, // type_id 2
                'name' => 'Item 2',
                'image_url' => 'https://example.com/item2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1, // type_id 1
                'name' => 'Item 3',
                'image_url' => 'https://example.com/item3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2, // type_id 2
                'name' => 'Item 4',
                'image_url' => 'https://example.com/item4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1, // type_id 1
                'name' => 'Item 5',
                'image_url' => 'https://example.com/item5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2, // type_id 2
                'name' => 'Item 6',
                'image_url' => 'https://example.com/item6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1, // type_id 1
                'name' => 'Item 7',
                'image_url' => 'https://example.com/item7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2, // type_id 2
                'name' => 'Item 8',
                'image_url' => 'https://example.com/item8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1, // type_id 1
                'name' => 'Item 9',
                'image_url' => 'https://example.com/item9.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2, // type_id 2
                'name' => 'Item 10',
                'image_url' => 'https://example.com/item10.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
