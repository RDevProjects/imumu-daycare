<?php

namespace App\Services;

use App\Models\Bank;
use App\Models\Setting;

class WhatsAppService
{
    /**
     * Generate WhatsApp URL for sending a message
     */
    public function generateUrl(string $phone, string $message): string
    {
        // Clean phone number - remove non-numeric characters except +
        $phone = preg_replace('/[^0-9+]/', '', $phone);

        // Convert to international format if starts with 0
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        // Remove + if present
        $phone = ltrim($phone, '+');

        $encodedMessage = urlencode($message);

        return "https://wa.me/{$phone}?text={$encodedMessage}";
    }

    /**
     * Get default WA number for the daycare
     */
    public function getDefaultNumber(): string
    {
        return Setting::get('daycare_wa', '6285877748008');
    }

    /**
     * Generate confirmation message for enrollment
     */
    public function generateConfirmationMessage($enrollment): string
    {
        $template = Setting::get('wa_template_konfirmasi') ?? "Halo {parent_name}! Pendaftaran {child_name} telah dikonfirmasi.";

        $banks = Bank::active()->get();
        $bankInfo = $banks->map(function ($b) {
            return "{$b->bank_name} - {$b->account_number} a.n. {$b->account_name}";
        })->join("\n");

        return str_replace(
            ['{parent_name}', '{child_name}', '{package_name}', '{amount}', '{bank_info}'],
            [
                $enrollment->parent_name,
                $enrollment->child_name,
                $enrollment->package->label,
                'Rp ' . number_format($enrollment->package->price, 0, ',', '.'),
                $bankInfo,
            ],
            $template
        );
    }
}
