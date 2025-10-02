<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'USB-C Kabel',
            'price' => 9.99,
            'description' => 'Stevige 1m USB-C kabel.',
        ]);

        Product::create([
            'name' => 'Bluetooth Speaker',
            'price' => 29.95,
            'description' => 'Compacte speaker met helder geluid.',
        ]);

        Product::create([
            'name' => 'Draadloze Muis',
            'price' => 19.5,
            'description' => 'Comfortabele muis met 2,4GHz dongle.',
        ]);
    }
}
