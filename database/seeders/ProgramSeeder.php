<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('programs')->insert([
            [
                'product_id' => 1,
                'type_id' => 1,
                'name' => 'Beginner Program',
                'total_student' => 100,
                'review' => 'Excellent starter course!',
                'total_minute' => 120,
                'price' => 4999,
                'discount_price' => 3999,
                'discount_percentage' => 10,
                // 'due_date' => now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'type_id' => 1,
                'name' => 'Advanced Program',
                'total_student' => 50,
                'review' => 'Great for advanced learners.',
                'total_minute' => 300,
                'price' => 9999,
                'discount_price' => null,
                'discount_percentage' => 10,
                'due_date' => now()->addDays(60),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'type_id' => 2,
                'name' => 'Expert Program',
                'total_student' => 20,
                'review' => 'The ultimate learning experience.',
                'total_minute' => 600,
                'price' => 19999,
                'discount_price' => 17999,
                'due_date' => now()->addDays(90),
                'discount_percentage' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
