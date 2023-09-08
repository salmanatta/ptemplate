<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name_en' => 'Beginner',
            'name_ar' => 'مبتدئ',
            'sort_order' => 1,
            'image' => '',
            'passing_weightage' => 100
        ]);
        Level::create([
            'name_en' => 'Average',
            'name_ar' => 'متوسط',
            'sort_order' => 2,
            'image' => '',
            'passing_weightage' => 100
        ]);
        Level::create([
            'name_en' => 'Advance',
            'name_ar' => 'متقدم',
            'sort_order' => 3,
            'image' => '',
            'passing_weightage' => 100
        ]);
        Level::create([
            'name_en' => 'Professional',
            'name_ar' => 'محترف',
            'sort_order' => 4,
            'image' => '',
            'passing_weightage' => 100
        ]);
        Level::create([
            'name_en' => 'Expert',
            'name_ar' => 'خبير',
            'sort_order' => 5,
            'image' => '',
            'passing_weightage' => 100
        ]);
        Level::create([
            'name_en' => 'Genius',
            'name_ar' => 'عبقري',
            'sort_order' => 6,
            'image' => '',
            'passing_weightage' => 100
        ]);
    }
}
