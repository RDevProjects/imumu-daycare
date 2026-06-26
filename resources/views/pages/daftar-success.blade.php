@extends('layouts.front', ['activePage' => 'daftar'])

@section('title', 'Pendaftaran Berhasil - IMUMU Daycare')

@section('content')

    <section class="px-4 py-20 md:py-28 relative overflow-hidden"
        style="background: linear-gradient(135deg, #d8f7f5 0%, #fff8e8 50%, #fff4a8 100%)">
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-15 -translate-y-12 translate-x-12"
            style="background:#e83f7d"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full opacity-12 translate-y-10 -translate-x-10"
            style="background:#b85bd6"></div>

        <div class="relative mx-auto max-w-2xl text-center">
            <!-- Success Icon -->
            <div class="mx-auto w-24 h-24 rounded-full bg-green-500 flex items-center justify-center mb-6 shadow-lg"
                style="box-shadow: 0 8px 32px rgba(34,197,94,0.3)">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="font-display font-black text-ink" style="font-size: clamp(2rem, 5vw, 3rem); line-height:1.1">
                Pendaftaran Berhasil! 🎉
            </h1>

            <p class="section-subtitle mt-4 max-w-xl mx-auto">
                Terima kasih telah mendaftarkan <strong>{{ $enrollment->child_name }}</strong>. Kami akan segera menghubungi
                Anda via WhatsApp untuk informasi pembayaran.
            </p>

            <!-- Registration Details -->
            <div class="mt-8 rounded-card p-6 text-left border-2"
                style="background:white; border-color:#09b1ab; box-shadow: 5px 5px 0 #d8f7f5">
                <div class="space-y-3">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-sm font-semibold" style="color:#5c5555">No. Registrasi</span>
                        <span class="font-black text-ink">{{ $enrollment->registration_number }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-sm font-semibold" style="color:#5c5555">Nama Anak</span>
                        <span class="font-bold text-ink">{{ $enrollment->child_name }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-sm font-semibold" style="color:#5c5555">Paket</span>
                        <span class="font-bold text-ink">{{ $enrollment->package->label }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-sm font-semibold" style="color:#5c5555">Total</span>
                        <span class="font-black" style="color:#09b1ab">Rp
                            {{ number_format($enrollment->package->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-sm font-semibold" style="color:#5c5555">Pembayaran</span>
                        <span class="badge badge-warning">Via WhatsApp</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold" style="color:#5c5555">Status</span>
                        <span class="badge badge-warning">Menunggu Konfirmasi</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                @php
                    $waNumber = $enrollment->parent_phone
                        ? (str_starts_with($enrollment->parent_phone, '0')
                            ? '62' . substr($enrollment->parent_phone, 1)
                            : $enrollment->parent_phone)
                        : \App\Models\Setting::get('daycare_wa', '');
                @endphp
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="btn btn-secondary btn-lg">
                    💬 Chat
                    {{ \App\Models\Setting::get('wa_contact_name', '') ? 'Bunda ' . \App\Models\Setting::get('wa_contact_name', '') : 'Bunda' }}
                </a>
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                    🏠 Kembali ke Beranda
                </a>
            </div>

            <!-- Info -->
            <div class="mt-10 rounded-soft p-5 border-2 border-dashed" style="background:#fff4a8; border-color:#ffd900">
                <div class="font-display text-base font-black text-ink mb-2">📋 Langkah Selanjutnya</div>
                <ul class="space-y-1.5 text-sm font-semibold text-ink text-left max-w-md mx-auto">
                    <li class="flex items-start gap-2"><span class="text-teal font-bold mt-0.5">1.</span> Admin akan
                        menghubungi Anda via WhatsApp untuk info tagihan & pembayaran</li>
                    <li class="flex items-start gap-2"><span class="text-teal font-bold mt-0.5">2.</span> Lakukan transfer
                        sesuai petunjuk dari admin</li>
                    <li class="flex items-start gap-2"><span class="text-teal font-bold mt-0.5">3.</span> Kirim bukti
                        transfer via WhatsApp</li>
                    <li class="flex items-start gap-2"><span class="text-teal font-bold mt-0.5">4.</span> Bawa berkas (FC
                        KK, KTP, Foto 3×4) ke IMUMU Daycare</li>
                </ul>
            </div>
        </div>
    </section>

@endsection
