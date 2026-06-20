@extends('layouts.front', ['activePage' => 'home'])

@php
    $waNumber = \App\Models\Setting::get('daycare_wa', '');
    $waName = \App\Models\Setting::get('wa_contact_name', '');
    $waDisplayName = $waName ? "Bunda {$waName}" : 'Bunda';
    $waDisplayNumber = $waNumber ? '0' . substr($waNumber, 2) : '';
    if (strlen($waDisplayNumber) > 4) {
        $waDisplayNumber = preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $waDisplayNumber);
    }
@endphp

@section('title', 'IMUMU Daycare – Penitipan Anak Terpercaya di Surakarta')
@section('description', 'IMUMU Daycare menyediakan penitipan anak yang aman, hangat, dan menyenangkan. Usia 3 bulan – 7
    tahun. Senin–Sabtu 08.00–16.00.')

@section('content')

    <!-- ===== HERO ===== -->
    <section class="relative overflow-hidden" style="background:#fff8e8">
        <div class="absolute top-0 right-0 w-72 h-72 rounded-full opacity-20 -translate-y-16 translate-x-16"
            style="background:#09b1ab"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full opacity-20 translate-y-16 -translate-x-16"
            style="background:#e83f7d"></div>

        <div class="relative mx-auto max-w-7xl px-4 py-14 md:py-20 lg:py-28 md:flex md:items-center md:gap-16">
            <div class="md:w-1/2">
                <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full font-bold text-sm border-2 border-teal-dark rotate-[-1deg]"
                    style="background:white; color:#087c7a">
                    🕐 Senin–Sabtu &nbsp;|&nbsp; 08.00–16.00 WIB
                </div>

                <h1 class="font-display font-black text-ink leading-tight" style="font-size: clamp(2.5rem, 5vw, 4rem)">
                    Tempat Si Kecil<br />
                    <span style="color:#09b1ab; -webkit-text-stroke: 2px #087c7a">Tumbuh &amp; Bahagia</span> ☀️
                </h1>
                <p class="mt-4 text-lg font-semibold leading-relaxed" style="color:#5c5555; max-width:480px">
                    Daycare islami dengan tenaga pengasuh berpengalaman, program stimulasi tumbuh kembang, dan suasana
                    belajar yang menyenangkan untuk anak <strong>usia 3 bulan – 7 tahun</strong>.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('daftar') }}" class="btn btn-primary btn-lg">🌟 Daftar Sekarang</a>
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"
                        class="btn btn-secondary btn-lg">💬 Tanya {{ $waDisplayName }}</a>
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <span class="badge badge-teal">✓ Tenaga Berpengalaman</span>
                    <span class="badge badge-pink">✓ Program Islami</span>
                    <span class="badge badge-orange">✓ Makan &amp; Mandi Sore</span>
                </div>
            </div>

            <div class="mt-12 md:mt-0 md:w-1/2 flex justify-center">
                <div class="relative">
                    <div class="rounded-card bg-white p-8 w-80"
                        style="box-shadow: 0 12px 30px rgba(47,43,43,0.12)">
                        <div class="text-center">
                            <div class="text-6xl mb-3">👶🍼</div>
                            <div class="font-display text-2xl font-black text-ink">Usia 3 Bln – 7 Thn</div>
                            <div class="mt-2 text-sm font-semibold" style="color:#5c5555">Kami siap menjaga si kecil dengan
                                penuh kasih!</div>
                        </div>
                        <div class="mt-5 space-y-2.5">
                            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#d8f7f5">
                                <span class="text-xl">🎒</span>
                                <span class="font-semibold text-sm text-ink">Stimulasi Perkembangan</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#ffd6e5">
                                <span class="text-xl">🕌</span>
                                <span class="font-semibold text-sm text-ink">Hafalan Do'a &amp; Surat</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#ffe0c7">
                                <span class="text-xl">🍲</span>
                                <span class="font-semibold text-sm text-ink">Makan Siang Bergizi</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 rounded-soft" style="background:#f0d7ff">
                                <span class="text-xl">🩺</span>
                                <span class="font-semibold text-sm text-ink">Pemeriksaan Kesehatan</span>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-5 -right-5 flex h-16 w-16 items-center justify-center rounded-full font-display font-black text-xs text-center text-white rotate-12"
                        style="background:#e83f7d">ISLAMI ✨</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== PROGRAM & FASILITAS (2-col teaser) ===== -->
    <section class="px-4 py-16 md:py-24 md:px-8 mx-auto max-w-7xl">
            <div class="text-center mb-12">
                <h2 class="section-title">Program &amp; Fasilitas</h2>
                <p class="section-subtitle mt-2 max-w-2xl mx-auto">Dirancang oleh tim ahli untuk tumbuh kembang anak yang
                    optimal, fisik maupun spiritual.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-card overflow-hidden border-2"
                    style="border-color:#e83f7d">
                    <div class="px-6 py-4 font-display text-xl font-black text-white" style="background:#e83f7d">🎒 Program
                        Kegiatan</div>
                    <div class="p-6 space-y-3" style="background:white">
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Stimulasi
                            Perkembangan</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Hafalan
                            Do'a &amp; Surat Pendek</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Praktek
                            Wudhu &amp; Sholat</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span>
                            Pemeriksaan Kesehatan Rutin</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Baby
                            Massage</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Read Aloud
                            &amp; Literasi</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Cooking
                            Class</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#e83f7d">✓</span> Taman Gizi
                        </div>
                    </div>
                </div>

                <div class="rounded-card overflow-hidden border-2"
                    style="border-color:#f36b21">
                    <div class="px-6 py-4 font-display text-xl font-black text-white" style="background:#f36b21">🏠
                        Fasilitas Unggulan</div>
                    <div class="p-6 space-y-3" style="background:white">
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Kasur
                            Busa &amp; Tidur AC</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Tenaga
                            Pengasuh Berpengalaman</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Sarana
                            Bermain Edukatif</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Freezer
                            ASI</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span>
                            Sterilizer Peralatan Bayi</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Makan
                            Siang Bergizi</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span> Mandi
                            Sore</div>
                        <div class="check-list-item"><span class="check-icon" style="background:#f36b21">✓</span>
                            Lingkungan Bersih &amp; Aman</div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('programs') }}" class="btn btn-primary btn-lg">Lihat Detail Lengkap →</a>
            </div>
        </div>
    </section>

    <!-- ===== HARGA / TARIF ===== -->
    <section class="px-4 py-16 md:py-24" style="background:#eaf9fc">

        <div class="mx-auto max-w-7xl">
            <div class="text-center mb-12">
                <span class="badge badge-teal mb-3">💰 Harga Terjangkau</span>
                <h2 class="section-title">Tarif Penitipan</h2>
                <p class="section-subtitle mt-2 max-w-xl mx-auto">Harga bersahabat, fasilitas dan program terlengkap.</p>
            </div>


            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-card text-center p-8 border-2"
                    style="background:white; border-color:#ffd900">
                    <div class="text-5xl mb-3">📋</div>
                    <div class="font-display text-xl font-black text-ink">Pendaftaran</div>
                    <div class="mt-4 font-display font-black text-ink" style="font-size: 2.5rem; line-height:1">Rp
                        {{ $tarifPendaftaran['main'] }}<span class="text-xl">{{ $tarifPendaftaran['sub'] }}</span></div>
                    <div class="mt-1 text-sm font-semibold" style="color:#5c5555">Biaya satu kali</div>
                    <div class="mt-5 space-y-2 text-sm text-left">
                        <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>FC KK &amp; KTP
                            Orang Tua</div>
                        <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>Foto 3×4 (3 lembar)
                        </div>
                        <div class="flex items-center gap-2"><span class="text-teal font-bold">✓</span>Formulir
                            Pendaftaran</div>
                    </div>
                    <a href="{{ route('daftar') }}" class="btn btn-secondary w-full mt-6">Daftar Sekarang</a>
                </div>

                <div class="rounded-card text-center p-8 border-2 relative"
                    style="background:#09b1ab; border-color:#087c7a; box-shadow: 0 6px 20px rgba(8,124,122,0.3)">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 badge badge-sunshine px-5 py-2 text-sm font-black whitespace-nowrap">
                        ⭐ PALING POPULER</div>
                    <div class="text-5xl mt-2 mb-3">🎒</div>
                    <div class="font-display text-xl font-black text-white">Murid PAUD IMUMU</div>
                    <div class="mt-4 border-t border-white/30 pt-4 space-y-3">
                        <div>
                            <div class="text-white/70 text-xs font-bold uppercase tracking-wider">Harian</div>
                            <div class="font-display font-black text-white" style="font-size:2rem">Rp
                                {{ $paudHarian['main'] }}<span class="text-lg">{{ $paudHarian['sub'] }}</span></div>
                        </div>
                        <div class="border-t border-white/30 pt-3">
                            <div class="text-white/70 text-xs font-bold uppercase tracking-wider">Bulanan</div>
                            <div class="font-display font-black text-white" style="font-size:2rem">Rp
                                {{ $paudBulanan['main'] }}<span class="text-lg">{{ $paudBulanan['sub'] }}</span></div>
                        </div>
                    </div>
                    <a href="{{ route('daftar') }}" class="btn w-full mt-6 font-black"
                        style="background:#ffd900; color:#2f2b2b">Pilih Paket
                        Ini</a>
                </div>

                <div class="rounded-card text-center p-8 border-2"
                    style="background:white; border-color:#b85bd6">
                    <div class="text-5xl mb-3">🧸</div>
                    <div class="font-display text-xl font-black text-ink">Murid Non-PAUD</div>
                    <div class="mt-4 border-t border-border-default pt-4 space-y-3">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Harian</div>
                            <div class="font-display font-black text-ink" style="font-size:2rem">Rp
                                {{ $nonPaudHarian['main'] }}<span class="text-lg">{{ $nonPaudHarian['sub'] }}</span>
                            </div>
                        </div>
                        <div class="border-t border-border-default pt-3">
                            <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Bulanan</div>
                            <div class="font-display font-black text-ink" style="font-size:2rem">Rp
                                {{ $nonPaudBulanan['main'] }}<span class="text-lg">{{ $nonPaudBulanan['sub'] }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('daftar') }}" class="btn btn-ghost w-full mt-6"
                        style="border-color:#b85bd6; color:#b85bd6">Pilih Paket Ini</a>
                </div>
            </div>

            <div class="mt-10 rounded-soft p-6 border-2 border-dashed" style="background:#fff4a8; border-color:#ffd900">
                <div class="font-display text-lg font-black text-ink mb-3">📋 Syarat Pendaftaran</div>
                <div class="flex flex-wrap gap-4 text-sm font-semibold text-ink">
                    <span class="flex items-center gap-2">📄 Fotokopi KK &amp; KTP Orang Tua</span>
                    <span class="flex items-center gap-2">📸 Foto 3×4 sebanyak 3 lembar</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== KENAPA PILIH IMUMU ===== -->
    <section class="px-4 py-16 md:py-24" style="background:#eaf9fc">

        <div class="mx-auto max-w-7xl">
            <div class="text-center mb-12">
                <h2 class="section-title">Kenapa Pilih IMUMU Daycare?</h2>
                <p class="section-subtitle mt-2">Dipercaya ratusan keluarga di Surakarta.</p>
            </div>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="card text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3"
                        style="background:#d8f7f5">🕌</div>
                    <div class="font-display text-lg font-black text-ink">Bernuansa Islami</div>
                    <p class="mt-1 text-sm" style="color:#5c5555">Hafalan do'a, surat, wudhu &amp; sholat terintegrasi</p>
                </div>
                <div class="card text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3"
                        style="background:#ffd6e5">🧸</div>
                    <div class="font-display text-lg font-black text-ink">Aman &amp; Nyaman</div>
                    <p class="mt-1 text-sm" style="color:#5c5555">AC, kasur busa, sterilizer, dan lingkungan bersih</p>
                </div>
                <div class="card text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3"
                        style="background:#ffe0c7">👩‍🏫</div>
                    <div class="font-display text-lg font-black text-ink">Pengasuh Terlatih</div>
                    <p class="mt-1 text-sm" style="color:#5c5555">Berpengalaman dalam stimulasi tumbuh kembang anak</p>
                </div>
                <div class="card text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl mb-3"
                        style="background:#f0d7ff">🤱</div>
                    <div class="font-display text-lg font-black text-ink">Ramah Busui</div>
                    <p class="mt-1 text-sm" style="color:#5c5555">Freezer ASI tersedia, mendukung ibu menyusui</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA WHATSAPP ===== -->
    <section class="px-4 py-16 md:py-24">

        <div class="mx-auto max-w-3xl rounded-card text-center px-8 py-12 md:px-16"
            style="background:#09b1ab; box-shadow: 0 8px 24px rgba(8,124,122,0.25)">
            <div class="text-5xl mb-4">💬</div>
            <h2 class="font-display text-3xl font-black text-white md:text-4xl">Ada Pertanyaan?</h2>
            <p class="mt-2 text-lg font-semibold" style="color:rgba(255,255,255,0.85)">
                Hubungi langsung <strong class="text-white">{{ $waDisplayName }}</strong> via WhatsApp. Kami siap
                membantu!
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener"
                    class="btn btn-secondary btn-lg">💬 {{ $waDisplayNumber }}</a>
                    <a href="{{ route('daftar') }}" class="btn btn-ghost btn-lg"
                        style="color:white; box-shadow: inset 0 0 0 2px white">Isi Formulir
                        Daftar</a>
            </div>
        </div>
    </section>

@endsection
