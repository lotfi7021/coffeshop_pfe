<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MarquesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marques = [
            'Lavazza',
            'Illy',
            'Nespresso',
            'Nescafé',
            'Segafredo',
            'Jacobs',
            'Carte Noire',
        ];

        foreach ($marques as $titre) {
            DB::table('marques')->insert([
                'titre' => $titre,
                'slug' => Str::slug($titre),
                'image' => '',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
