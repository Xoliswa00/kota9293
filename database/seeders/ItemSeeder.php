<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\models\item;
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [

            /* =====================
               BURGERS (START R30)
            ======================*/
            [
                'name' => 'Classic Burger',
                'price' => 30,
                'category' => 'burger',
            ],
            [
                'name' => 'Cheese Burger',
                'price' => 35,
                'category' => 'burger',
            ],
            [
                'name' => 'Burger + Egg',
                'price' => 38,
                'category' => 'burger',
            ],
            [
                'name' => 'Burger + Cheese + Egg',
                'price' => 42,
                'category' => 'burger',
            ],
            [
                'name' => 'Fully Loaded Burger',
                'price' => 50,
                'category' => 'burger',
            ],

            /* =====================
               KOTAS (SAME LOGIC)
            ======================*/
            [
                'name' => 'Classic Kota',
                'price' => 30,
                'category' => 'kota',
            ],
            [
                'name' => 'Kota + Chips',
                'price' => 35,
                'category' => 'kota',
            ],
            [
                'name' => 'Kota + Chips + Cheese',
                'price' => 40,
                'category' => 'kota',
            ],
            [
                'name' => 'Kota + Chips + Egg',
                'price' => 42,
                'category' => 'kota',
            ],
            [
                'name' => 'Fully Loaded Kota',
                'price' => 55,
                'category' => 'kota',
            ],

            /* =====================
               CHIPS (PLAIN SIZES)
            ======================*/
            [
                'name' => 'Small Chips',
                'price' => 15,
                'category' => 'chips',
            ],
            [
                'name' => 'Medium Chips',
                'price' => 20,
                'category' => 'chips',
            ],
            [
                'name' => 'Large Chips',
                'price' => 25,
                'category' => 'chips',
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
