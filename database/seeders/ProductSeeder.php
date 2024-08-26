<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Product::create([
            'name' => 'Cappuccino',
            'description' => 'Delicious hot cappuccino.',
            'price' => 35000,
            'image_url' => 'cappuccino.jpg',
            'category' => 'Beverages',
        ]);
    
        \App\Models\Product::create([
            'name' => 'Cheeseburger',
            'description' => 'Juicy cheeseburger with lettuce and tomato.',
            'price' => 50000,
            'image_url' => 'cheeseburger.jpg',
            'category' => 'Main Course',
        ]);
    
        // Add more products as needed
    }
    
}
