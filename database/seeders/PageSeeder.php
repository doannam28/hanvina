<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Trang chủ',
                'type' => 'home-page',
                'content' => [],
            ],
            [
                'title' => 'Giới thiệu',
                'type' => 'about',
                'content' => [],
            ],
            [
                'title' => 'Liên hệ',
                'type' => 'contact',
                'content' => [],
            ],
        ];
        DB::table('pages')->truncate();
        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
