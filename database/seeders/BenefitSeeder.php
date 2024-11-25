<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BenefitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('benefits')->insert([
            [
                'name' => 'Free Shipping',
                'description' => 'Enjoy free shipping on all orders.',
                'icon_url' => 'https://example.com/icons/free-shipping.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '24/7 Customer Support',
                'description' => 'Get assistance anytime with our 24/7 customer support.',
                'icon_url' => 'https://example.com/icons/support.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Money-back Guarantee',
                'description' => 'We offer a 30-day money-back guarantee.',
                'icon_url' => 'https://example.com/icons/money-back.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Exclusive Discounts',
                'description' => 'Get exclusive discounts on special occasions.',
                'icon_url' => 'https://example.com/icons/discount.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gift Cards',
                'description' => 'Buy and redeem gift cards for special purchases.',
                'icon_url' => 'https://example.com/icons/gift-card.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Loyalty Program',
                'description' => 'Earn points for every purchase and redeem them for rewards.',
                'icon_url' => 'https://example.com/icons/loyalty.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fast Delivery',
                'description' => 'Get your order delivered within 48 hours.',
                'icon_url' => 'https://example.com/icons/fast-delivery.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Secure Payment',
                'description' => 'All payments are processed securely with encryption.',
                'icon_url' => 'https://example.com/icons/secure-payment.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Free Returns',
                'description' => 'Enjoy free returns within 30 days of purchase.',
                'icon_url' => 'https://example.com/icons/returns.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Customizable Products',
                'description' => 'Personalize your products with our customization options.',
                'icon_url' => 'https://example.com/icons/customizable.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
