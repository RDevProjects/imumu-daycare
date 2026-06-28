<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DefaultSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Daycare Info
            'daycare_name' => 'IMUMU Daycare',
            'daycare_address' => 'Jl. Bone 3 RT 01 RW 03, Banyuanyar, Banjarsari, Surakarta, Jawa Tengah',
            'daycare_phone' => '',
            'daycare_wa' => '',
            'wa_contact_name' => '',
            'daycare_email' => 'info@imumu.com',
            'daycare_open_time' => '08:00',
            'daycare_close_time' => '16:00',

            // Tarif
            'tarif_pendaftaran' => '250000',

            // WhatsApp Template Konfirmasi (ASCII - no emoji issue)
            'wa_template_konfirmasi' => "Assalamu'alaikum {parent_title} {parent_name}!\n\nAlhamdulillah, pendaftaran putra/putri Anda, {child_name}, telah kami konfirmasi.\n\n[Detail Pendaftaran]\n===================\n[Paket] {package_name}\n[Total] {amount}\n===================\n\n[Transfer] Pembayaran dapat dilakukan melalui:\n{bank_info}\n\n[Berkas] Setelah pembayaran, mohon membawa:\n- FC KK & KTP Orang Tua\n- Foto 3x4 sebanyak 3 lembar\n\n[Link] Track status pendaftaran:\n{tracking_url}\n\nInsyaAllah kami tunggu kedatangan Anda. Jazakumullahu khairan.\n\nWassalamu'alaikum Warahmatullahi Wabarakatuh",

            // WhatsApp Template Invoice (ASCII)
            'wa_template_invoice' => "[Bukti Pembayaran]\n===================\n[No Invoice] {invoice_number}\n[Tanggal] {invoice_date}\n\n[Nama Anak] {child_name}\n[Orang Tua] {parent_title} {parent_name}\n[Paket] {package_name}\n\n[Total] {amount}\n[Status] LUNAS\n[Metode] {payment_method}\n===================\n\nTerima kasih atas pembayaran Anda.\nJazakumullahu khairan.\n\nWassalamu'alaikum Warahmatullahi Wabarakatuh",

            // Invoice
            'invoice_header_text' => 'Terima kasih atas kepercayaan Anda kepada IMUMU Daycare.',
            'invoice_footer_text' => 'Invoice ini digenerate otomatis oleh sistem.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
