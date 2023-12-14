<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlergenosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $alergenos = [
            'cacahuetes',
            'crustaceo',
            'frutos-cascara',
            'gluten',
            'huevo',
            'leche',
            'moluscos',
            'mostaza',
            'pescado',
            'soja',
            'sulfitos',
        ];

        foreach ($alergenos as $alergeno) {
            $name = ucfirst(str_replace('-', ' ', $alergeno));
            $imageName = "alergeno-$alergeno.svg";
            $iconName = pathinfo($imageName, PATHINFO_FILENAME);
            $imagePath = "alergenos/December2023/$imageName";

            DB::table('alergenos')->insert([
                'name' => $name,
                'image' => $imagePath,
                'icon_name' => $iconName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
