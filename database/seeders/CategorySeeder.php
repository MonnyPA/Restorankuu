<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan',
                'description' => 'Kategori Makanan'
            ],
            [
                'name' => 'Minuman',
                'description' => 'Kategori Minuman'
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
