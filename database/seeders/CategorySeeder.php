<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pizza',
            'Burgers',
            'Meals',
            'Sandwiches',
            'Chicken',
            'Seafood',
            'Pasta',
            'Salads',
            'Desserts',
            'Drinks',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
            ]);
        }
    }
}