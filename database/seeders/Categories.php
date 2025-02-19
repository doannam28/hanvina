<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tin tức'],
            ['name' => 'Bí kip'],
            ['name' => 'Hướng dẫn'],
            ['name' => 'Tư vấn'],
            ['name' => 'Khuyến mãi'],
        ];

        DB::table('categories')->truncate();
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
