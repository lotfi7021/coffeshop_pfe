<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Café en grains',
            'Café moulu',
            'Capsules & Dosettes',
            'Café soluble',
            'Café décaféiné',
            'Café aromatisé',
            'Thé & Infusions',
        ];

        foreach ($categories as $titre) {
            DB::table('categories')->insert([
                'titre' => $titre,
                'image' => '',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
