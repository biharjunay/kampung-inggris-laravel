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
                'type_id' => 1,
                'name' => 'Product 1',
                'program_title' => 'Program Title 1',
                'image_url' => 'https://example.com/images/product1.jpg',
                'published_by' => 'Admin 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 2',
                'program_title' => 'Program Title 2',
                'image_url' => 'https://example.com/images/product2.jpg',
                'published_by' => 'Admin 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 3',
                'program_title' => 'Program Title 3',
                'image_url' => 'https://example.com/images/product3.jpg',
                'published_by' => 'Admin 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 4',
                'program_title' => 'Program Title 4',
                'image_url' => 'https://example.com/images/product4.jpg',
                'published_by' => 'Admin 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 5',
                'program_title' => 'Program Title 5',
                'image_url' => 'https://example.com/images/product5.jpg',
                'published_by' => 'Admin 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 6',
                'program_title' => 'Program Title 6',
                'image_url' => 'https://example.com/images/product6.jpg',
                'published_by' => 'Admin 6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 7',
                'program_title' => 'Program Title 7',
                'image_url' => 'https://example.com/images/product7.jpg',
                'published_by' => 'Admin 7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 8',
                'program_title' => 'Program Title 8',
                'image_url' => 'https://example.com/images/product8.jpg',
                'published_by' => 'Admin 8',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 1,
                'name' => 'Product 9',
                'program_title' => 'Program Title 9',
                'image_url' => 'https://example.com/images/product9.jpg',
                'published_by' => 'Admin 9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'name' => 'Product 10',
                'program_title' => 'Program Title 10',
                'image_url' => 'https://example.com/images/product10.jpg',
                'published_by' => 'Admin 10',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'name' => 'Product 11',
                'program_title' => 'Program Title 11',
                'image_url' => 'https://example.com/images/product11.jpg',
                'published_by' => 'Admin 11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'name' => 'Product 12',
                'program_title' => 'Program Title 12',
                'image_url' => 'https://example.com/images/product12.jpg',
                'published_by' => 'Admin 12',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'name' => 'Product 13',
                'program_title' => 'Program Title 13',
                'image_url' => 'https://example.com/images/product13.jpg',
                'published_by' => 'Admin 13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'name' => 'Product 14',
                'program_title' => 'Program Title 14',
                'image_url' => 'https://example.com/images/product14.jpg',
                'published_by' => 'Admin 14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_id' => 2,
                'name' => 'Product 15',
                'program_title' => 'Program Title 15',
                'image_url' => 'https://example.com/images/product15.jpg',
                'published_by' => 'Admin 15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
