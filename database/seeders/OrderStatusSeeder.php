<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Новый'],
            ['name' => 'В обработке'],
            ['name' => 'Подтверждён'],
            ['name' => 'Отправлен'],
            ['name' => 'Доставлен'],
            ['name' => 'Отменён'],
        ];

        DB::table('order_statuses')->insert($statuses);
    }
}
