<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $autos = [
            ['marca' => 'Nissan', 'modelo' => 'X-Trail', 'tipo' => 'camioneta'],
            ['marca' => 'Toyota', 'modelo' => 'RAV4', 'tipo' => 'camioneta'],
            ['marca' => 'Ford', 'modelo' => 'Escape', 'tipo' => 'camioneta'],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'tipo' => 'auto'],
            ['marca' => 'Chevrolet', 'modelo' => 'Equinox', 'tipo' => 'camioneta'],
            ['marca' => 'Honda', 'modelo' => 'CR-V', 'tipo' => 'camioneta'],
            ['marca' => 'Mazda', 'modelo' => 'CX-5', 'tipo' => 'camioneta'],
            ['marca' => 'Kia', 'modelo' => 'Sportage', 'tipo' => 'camioneta'],
            ['marca' => 'Hyundai', 'modelo' => 'Tucson', 'tipo' => 'camioneta'],
            ['marca' => 'Seat', 'modelo' => 'León', 'tipo' => 'auto'],
        ];

        foreach ($autos as $auto) {
            DB::table('autos')->insert($auto);
        }
    }
}
