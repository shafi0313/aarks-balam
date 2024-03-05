<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = [
            [
                'category_id' => 1,
                'name'        => 'BSRM Rod',
                'is_active'   => 1,
                'created_at'  => now(),
            ],
            [
                'category_id' => 1,
                'name'        => 'AKS Rod',
                'is_active'   => 1,
                'created_at'  => now(),
            ],
        ];
        SubCategory::insert($subCategories);
    }
}
