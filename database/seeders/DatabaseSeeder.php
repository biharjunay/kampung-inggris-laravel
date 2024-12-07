<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('product_types')->truncate();
        \DB::table('products')->truncate();
        \DB::table('benefits')->truncate();
        \DB::table('product_benefit')->truncate();
        \DB::table('programs')->truncate();
        \DB::table('heroes')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            UserSeeder::class,
            ProductTypeSeeder::class,
            ProductSeeder::class,
            BenefitSeeder::class,
            ProductBenefitSeeder::class,
            ProgramSeeder::class,
            HeroSeeder::class
        ]);
    }
}
