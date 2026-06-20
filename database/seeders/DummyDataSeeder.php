<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Child;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\Bank;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    private $childFirst = ['Aisyah', 'Raka', 'Nadia', 'Farhan', 'Dimas', 'Zahra', 'Zidan', 'Alya', 'Rizki', 'Siti', 'Ahmad', 'Fatimah', 'Hafiz', 'Maryam', 'Ibrahim', 'Yusuf', 'Amina', 'Omar', 'Layla', 'Hamza', 'Nour', 'Karim', 'Lina', 'Tariq', 'Sara', 'Ali', 'Hana', 'Bilal', 'Khadijah', 'Putri'];
    private $childLast = ['Putri', 'Pratama', 'Safitri', 'Rizki', 'Aditya', 'Wulandari', 'Hidayat', 'Ramadhani', 'Susanti', 'Wibowo', 'Firmansyah', 'Maulida', 'Rahmawati', 'Setiawan', 'Handayani', 'Kurniawan', 'Lestari', 'Purnama', 'Sari', 'Kusuma'];
    private $parentNames = ['Ibu Mega', 'Bapak Budi', 'Ibu Rina', 'Bapak Andi', 'Ibu Dewi', 'Bapak Eko', 'Ibu Sri', 'Bapak Hendra', 'Ibu Yuni', 'Bapak Agus', 'Ibu Fitri', 'Bapak Roni', 'Ibu Lina', 'Bapak Doni', 'Ibu Maya', 'Bapak Fajar', 'Ibu Ratna', 'Bapak Iwan', 'Ibu Dian', 'Bapak Wati'];

    public function run(): void
    {
        $this->command->info('Generating dummy data...');

        $packages = Package::all()->toArray();
        if (empty($packages)) {
            $this->command->error('No packages found!');
            return;
        }

        $counter = 1;

        $this->command->info('Creating 800 enrollments...');

        for ($i = 0; $i < 800; $i++) {
            $package = $packages[array_rand($packages)];
            $childName = $this->childFirst[array_rand($this->childFirst)] . ' ' . $this->childLast[array_rand($this->childLast)];
            $parentName = $this->parentNames[array_rand($this->parentNames)];

            $rand = rand(1, 1000);
            if ($rand <= 50) $status = 'pending';
            elseif ($rand <= 150) $status = 'confirmed';
            elseif ($rand <= 950) $status = 'paid';
            else $status = 'rejected';

            $paymentMethod = rand(0, 1) ? 'cash' : 'transfer';
            $gender = rand(0, 1) ? 'L' : 'P';

            $regDate = Carbon::now()->subDays(rand(1, 180))->startOfDay();
            $regNumber = 'REG-' . $regDate->format('Ymd') . '-' . str_pad($counter++, 4, '0', STR_PAD_LEFT);

            Enrollment::create([
                'registration_number' => $regNumber,
                'parent_name' => $parentName,
                'parent_phone' => '08' . rand(100000000, 999999999),
                'parent_email' => strtolower(str_replace(' ', '', $parentName)) . '_' . $i . '@email.com',
                'child_name' => $childName,
                'child_birth_date' => Carbon::now()->subYears(rand(2, 6))->subMonths(rand(0, 11))->subDays(rand(1, 28))->format('Y-m-d'),
                'child_gender' => $gender,
                'address' => 'Jl. Contoh No. ' . rand(1, 100) . ', Surakarta',
                'package_id' => $package['id'],
                'payment_method' => $paymentMethod,
                'notes' => rand(0, 1) ? 'Mohon konfirmasi segera' : null,
                'status' => $status,
                'admin_notes' => $status === 'rejected' ? 'Data tidak lengkap' : null,
                'confirmed_by' => $status !== 'pending' ? 1 : null,
                'confirmed_at' => $status !== 'pending' ? $regDate->copy()->addDays(rand(1, 3)) : null,
                'history_token' => Str::uuid()->toString(),
            ]);

            if ($i % 100 === 0) {
                $this->command->info("  Created $i enrollments...");
            }
        }

        $this->command->info('Creating payments, children, and invoices...');
        $enrollments = Enrollment::where('status', '!=', 'pending')->get();
        $payCounter = 1;

        foreach ($enrollments as $enrollment) {
            $payDate = $enrollment->created_at->copy()->addDays(rand(1, 7));

            $payment = Payment::create([
                'enrollment_id' => $enrollment->id,
                'amount' => $enrollment->package->price,
                'payment_method' => $enrollment->payment_method,
                'payment_date' => $enrollment->status === 'paid' ? $payDate : null,
                'due_date' => $payDate->copy()->addDays(7),
                'bukti_transfer' => $enrollment->payment_method === 'transfer' && $enrollment->status === 'paid' ? 'bukti-transfer/dummy-' . $enrollment->id . '.jpg' : null,
                'verified_by' => $enrollment->status === 'paid' ? 1 : null,
                'verified_at' => $enrollment->status === 'paid' ? $payDate->copy()->addDays(1) : null,
                'status' => $enrollment->status === 'paid' ? 'paid' : 'pending',
            ]);

            if ($enrollment->status === 'paid') {
                Child::create([
                    'enrollment_id' => $enrollment->id,
                    'name' => $enrollment->child_name,
                    'birth_date' => $enrollment->created_at->copy()->subYears(rand(2, 6))->subMonths(rand(0, 11)),
                    'gender' => $enrollment->child_gender,
                    'parent_name' => $enrollment->parent_name,
                    'parent_phone' => $enrollment->parent_phone,
                    'allergies' => rand(0, 1) ? 'Tidak ada' : null,
                    'status' => 'aktif',
                ]);

                $invDate = $payDate->copy()->addDays(1);
                $invNumber = 'INV-' . $invDate->format('Ymd') . '-' . str_pad($payCounter++, 4, '0', STR_PAD_LEFT);

                Invoice::create([
                    'invoice_number' => $invNumber,
                    'slug' => Str::uuid()->toString(),
                    'payment_id' => $payment->id,
                    'enrollment_id' => $enrollment->id,
                    'issued_date' => $invDate,
                    'total_amount' => $enrollment->package->price,
                    'status' => 'paid',
                ]);
            }
        }

        // Add banks
        Bank::insertOrIgnore([
            ['bank_name' => 'BCA', 'account_number' => '1234567890', 'account_name' => 'IMUMU Daycare', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'Mandiri', 'account_number' => '0987654321', 'account_name' => 'IMUMU Daycare', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'BRI', 'account_number' => '5555666677', 'account_name' => 'IMUMU Daycare', 'is_active' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);

        $this->command->info('Done! Summary:');
        $this->command->info('  Enrollments: ' . Enrollment::count());
        $this->command->info('  Payments: ' . Payment::count());
        $this->command->info('  Children: ' . Child::count());
        $this->command->info('  Invoices: ' . Invoice::count());
    }
}
