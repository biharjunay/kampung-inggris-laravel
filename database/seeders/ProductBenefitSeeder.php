<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductBenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('product_benefit')->insert([
            [
                'product_id' => 1,
                'benefit_id' => 1,
            ],
            [
                'product_id' => 2,
                'benefit_id' => 2,
            ],
            [
                'product_id' => 3,
                'benefit_id' => 3,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 3,
            ],
            [
                'product_id' => 2,
                'benefit_id' => 3,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 2,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 4,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 5,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 6,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 7,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 8,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 9,
            ],
            [
                'product_id' => 1,
                'benefit_id' => 10,
            ],
            // Add more rows as needed
        ]);
    }
}
