<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Setting;

class PageController extends Controller
{
    private function formatPrice(int $price): array
    {
        if ($price >= 1000000) {
            return ['main' => number_format($price / 1000000, 0, ',', '.'), 'sub' => ' Juta'];
        }
        return [
            'main' => number_format(floor($price / 1000), 0, ',', '.'),
            'sub' => '.' . str_pad($price % 1000, 3, '0', STR_PAD_LEFT),
        ];
    }

    public function index()
    {
        $packages = Package::active()->orderBy('name')->orderBy('type')->get();
        $tarifPendaftaran = Setting::get('tarif_pendaftaran', '250000');

        $paudHarian = $packages->where('name', 'PAUD IMUMU')->where('type', 'harian')->first();
        $paudBulanan = $packages->where('name', 'PAUD IMUMU')->where('type', 'bulanan')->first();
        $nonPaudHarian = $packages->where('name', 'Non-PAUD')->where('type', 'harian')->first();
        $nonPaudBulanan = $packages->where('name', 'Non-PAUD')->where('type', 'bulanan')->first();

        return view('pages.index', [
            'packages' => $packages,
            'tarifPendaftaran' => $this->formatPrice((int) $tarifPendaftaran),
            'paudHarian' => $paudHarian ? $this->formatPrice((int) $paudHarian->price) : '-',
            'paudBulanan' => $paudBulanan ? $this->formatPrice((int) $paudBulanan->price) : '-',
            'nonPaudHarian' => $nonPaudHarian ? $this->formatPrice((int) $nonPaudHarian->price) : '-',
            'nonPaudBulanan' => $nonPaudBulanan ? $this->formatPrice((int) $nonPaudBulanan->price) : '-',
        ]);
    }

    public function programs()
    {
        $packages = Package::active()->orderBy('name')->orderBy('type')->get();
        $tarifPendaftaran = Setting::get('tarif_pendaftaran', '250000');

        $paudHarian = $packages->where('name', 'PAUD IMUMU')->where('type', 'harian')->first();
        $paudBulanan = $packages->where('name', 'PAUD IMUMU')->where('type', 'bulanan')->first();
        $nonPaudHarian = $packages->where('name', 'Non-PAUD')->where('type', 'harian')->first();
        $nonPaudBulanan = $packages->where('name', 'Non-PAUD')->where('type', 'bulanan')->first();

        return view('pages.programs', [
            'tarifPendaftaran' => $this->formatPrice((int) $tarifPendaftaran),
            'paudHarian' => $paudHarian ? $this->formatPrice((int) $paudHarian->price) : '-',
            'paudBulanan' => $paudBulanan ? $this->formatPrice((int) $paudBulanan->price) : '-',
            'nonPaudHarian' => $nonPaudHarian ? $this->formatPrice((int) $nonPaudHarian->price) : '-',
            'nonPaudBulanan' => $nonPaudBulanan ? $this->formatPrice((int) $nonPaudBulanan->price) : '-',
        ]);
    }
}
