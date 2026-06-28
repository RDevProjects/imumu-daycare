<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class DefaultPackagesSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'PAUD IMUMU',
                'type' => 'harian',
                'price' => 35000,
                'description' => 'Penitipan harian dengan program PAUD terintegrasi',
                'is_active' => true,
            ],
            [
                'name' => 'PAUD IMUMU',
                'type' => 'bulanan',
                'price' => 500000,
                'description' => 'Penitipan bulanan dengan program PAUD terintegrasi - Paket Populer',
                'is_active' => true,
            ],
            [
                'name' => 'Non-PAUD',
                'type' => 'harian',
                'price' => 50000,
                'description' => 'Penitipan harian tanpa program PAUD',
                'is_active' => true,
            ],
            [
                'name' => 'Non-PAUD',
                'type' => 'bulanan',
                'price' => 1000000,
                'description' => 'Penitipan bulanan tanpa program PAUD',
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                [
                    'name' => $package['name'],
                    'type' => $package['type'],
                ],
                $package
            );
        }
    }
}
