<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $locations = [
            ['nombre' => 'Ciudad de México', 'descripcion' => 'Capital de México', 'municipio' => 'Ciudad de México'],
            ['nombre' => 'Guadalajara', 'descripcion' => 'Capital de Jalisco', 'municipio' => 'Guadalajara'],
            ['nombre' => 'Monterrey', 'descripcion' => 'Capital de Nuevo León', 'municipio' => 'Monterrey'],
            ['nombre' => 'Puebla', 'descripcion' => 'Capital de Puebla', 'municipio' => 'Puebla'],
            ['nombre' => 'Tijuana', 'descripcion' => 'Ciudad fronteriza en Baja California', 'municipio' => 'Tijuana'],
            ['nombre' => 'Querétaro', 'descripcion' => 'Capital de Querétaro', 'municipio' => 'Querétaro'],
            ['nombre' => 'Mérida', 'descripcion' => 'Capital de Yucatán', 'municipio' => 'Mérida'],
            ['nombre' => 'Cancún', 'descripcion' => 'Destino turístico en Quintana Roo', 'municipio' => 'Benito Juárez'],
            ['nombre' => 'Oaxaca', 'descripcion' => 'Capital de Oaxaca', 'municipio' => 'Oaxaca de Juárez'],
            ['nombre' => 'Acapulco', 'descripcion' => 'Destino turístico en Guerrero', 'municipio' => 'Acapulco de Juárez'],
        ];

        foreach ($locations as $location) {
            DB::table('locations')->insert($location);
        }
    }
}
