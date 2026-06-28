<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $packages = Package::all()->keyBy(fn ($p) => $p->name.'-'.$p->type);

        $parentNames = [
            'Budi Santoso', 'Siti Rahayu', 'Agus Wijaya', 'Dewi Lestari', 'Eko Prasetyo',
            'Fitriani Putri', 'Gunawan Hadi', 'Hani Susanti', 'Irfan Maulana', 'Joko Susilo',
            'Kartini Wulandari', 'Lukman Hakim', 'Mega Pratiwi', 'Nanang Setiawan', 'Olga Permata',
            'Pandu Kusuma', 'Qorina Sari', 'Rizky Firmansyah', 'Sri Wahyuni', 'Taufik Hidayat',
            'Umi Kalsum', 'Vino Bastian', 'Wulan Dari', 'Xander Wibowo', 'Yanti Kusuma',
        ];

        $childNames = [
            'Aditya Putra', 'Bella Sari', 'Cahya Nugraha', 'Dinda Aulia', 'Evan Setiadi',
            'Fara Nabila', 'Gibran Rakabuming', 'Hana Putri', 'Ilham Ramadhan', 'Julia Safitri',
            'Kevin Ananda', 'Laila Azzahra', 'Mika Santoso', 'Nadia Permata', 'Omar Habibi',
            'Putri Cantika', 'Qisthi Nabila', 'Raka Putra', 'Salwa Ramadhani', 'Tirta Wijaya',
            'Ulfa Sari', 'Vina Rahayu', 'Wahyu Nugroho', 'Xena Safira', 'Yoga Pratama',
        ];

        $addresses = [
            'Jl. Merdeka No. 12, Bandung', 'Jl. Sudirman No. 45, Jakarta', 'Jl. Diponegoro No. 7, Surabaya',
            'Jl. Gatot Subroto No. 23, Medan', 'Jl. Ahmad Yani No. 56, Yogyakarta',
            'Jl. Pahlawan No. 9, Semarang', 'Jl. Veteran No. 34, Malang',
            'Jl. Kebon Jeruk No. 18, Bekasi', 'Jl. Raya Bogor No. 67, Depok',
            'Jl. Cikini Raya No. 11, Tangerang',
        ];

        $statuses = ['pending', 'pending', 'confirmed', 'confirmed', 'paid', 'paid', 'paid', 'rejected', 'cancelled', 'paid'];
        $genders = ['L', 'P'];
        $paymentMethods = ['cash', 'transfer'];
        $packageKeys = ['PAUD IMUMU-harian', 'PAUD IMUMU-bulanan', 'Non-PAUD-harian', 'Non-PAUD-bulanan'];

        $date = now();

        foreach (range(1, 25) as $i) {
            $status = $statuses[($i - 1) % count($statuses)];
            $packageKey = $packageKeys[($i - 1) % count($packageKeys)];
            $package = $packages[$packageKey] ?? $packages->first();
            $gender = $genders[$i % 2];
            $paymentMethod = $paymentMethods[$i % 2];
            $parentName = $parentNames[$i - 1];
            $childName = $childNames[$i - 1];
            $address = $addresses[$i % count($addresses)];
            $regDate = $date->copy()->subDays(rand(1, 90));
            $regNum = 'REG-'.$regDate->format('Ymd').'-'.str_pad($i, 3, '0', STR_PAD_LEFT);
            $childBirth = now()->subYears(rand(2, 5))->subMonths(rand(0, 11));

            $enrollment = DB::table('enrollments')->insertGetId([
                'registration_number' => $regNum,
                'parent_name' => $parentName,
                'parent_phone' => '08'.rand(100000000, 999999999),
                'parent_email' => Str::snake(explode(' ', $parentName)[0]).$i.'@email.com',
                'child_name' => $childName,
                'child_birth_date' => $childBirth->format('Y-m-d'),
                'child_gender' => $gender,
                'address' => $address,
                'package_id' => $package->id,
                'payment_method' => $paymentMethod,
                'status' => $status,
                'confirmed_by' => in_array($status, ['confirmed', 'paid']) ? $admin?->id : null,
                'confirmed_at' => in_array($status, ['confirmed', 'paid']) ? $regDate->copy()->addDay()->toDateTimeString() : null,
                'history_token' => Str::uuid(),
                'created_at' => $regDate->toDateTimeString(),
                'updated_at' => $regDate->toDateTimeString(),
            ]);

            if (in_array($status, ['confirmed', 'paid'])) {
                DB::table('children')->insert([
                    'enrollment_id' => $enrollment,
                    'name' => $childName,
                    'birth_date' => $childBirth->format('Y-m-d'),
                    'gender' => $gender,
                    'parent_name' => $parentName,
                    'parent_phone' => '08'.rand(100000000, 999999999),
                    'status' => $status === 'paid' ? 'aktif' : 'aktif',
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ]);
            }
        }
    }
}
