<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'content' => '<h2>Ascending Excellence: Elevate Your Experience with Our Premier Lift Solutions</h2>',
                'image' => 'slider-c99fc79e48.webp',
                'is_active' => 1,
            ],
            [
                'content' => '<h2>Ascend with Precision: Elevate Your Experience with ECO Lifts Ltd Lifts</h2>',
                'image' => 'slider-8c88b7be88.webp',
                'is_active' => 1,
            ],
            [
                'content' => '<h2>Ascending Excellence: Elevate Your Experience with Our Lift Solutions</h2>',
                'image' => 'slider-759216aa69.webp',
                'is_active' => 1,
            ],
        ];

        Slider::insert($sliders);
    }
}
