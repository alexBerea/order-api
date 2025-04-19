<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = DB::table('order_statuses')->pluck('id')->toArray();

        $orders = [];

        for ($i = 0; $i < 20; $i++) {
            $orders[] = [
                'name' => $faker->sentence(3), // Случайное название заказа, например, "Покупка электроники"
                'price' => $faker->randomFloat(2, 10, 1000), // Случайная цена от 10 до 1000
                'order_status_id' => $faker->randomElement($statuses), // Случайный ID статуса
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('orders')->insert($orders);
    }
}
