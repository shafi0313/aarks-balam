<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Rod & Steel', 'created_at' => now()],
            ['name' => 'Cements', 'created_at' => now()],
            ['name' => 'CI Sheet (Tin)', 'created_at' => now()],
            ['name' => 'Sanitary', 'created_at' => now()],
        ];

        Category::insert($categories);
    }
}
