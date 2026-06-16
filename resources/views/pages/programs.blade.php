@extends('layouts.front', ['activePage' => 'programs'])
@php
    $waNumber = \App\Models\Setting::get('daycare_wa', '');
    $waName = \App\Models\Setting::get('wa_contact_name', '');
    $waDisplayName = $waName ? "Bunda {$waName}" : 'Bunda';
    $waDisplayNumber = $waNumber ? '0' . substr($waNumber, 2) : '';
    if (strlen($waDisplayNumber) > 4) {
        $waDisplayNumber = preg_replace('/(\d{4})(\d{4})(\d+)/', '$1-$2-$3', $waDisplayNumber);
    }
@endphp

@section('title', 'Program & Fasilitas – IMUMU Daycare Surakarta')
@section('description',
    'Program kegiatan dan fasilitas IMUMU Daycare: stimulasi perkembangan, hafalan do\'a, baby
    massage, cooking class, freezer ASI, dan lebih banyak lagi.')

@section('content')

    <!-- Page Hero -->
    <section class="px-4 py-16 md:py-20 relative overflow-hidden"
        style="background: linear-gradient(135deg, #ffd6e5 0%, #fff4a8 50%, #ffe0c7 100%)">
        <div class="absolute top-0 right-0 w-64 h-64 rounded-full opacity-20 -translate-y-12 translate-x-12"
            style="background:#09b1ab"></div>
        <div class="relative mx-auto max-w-3xl text-center">
            <span class="badge badge-pink mb-4">🎒 Lengkap &amp; Terprogram</span>
            <h1 class="font-display font-black text-ink" style="font-size: clamp(2rem, 5vw, 3.5rem); line-height:1.1">
                Program &amp; Fasilitas<br />IMUMU Daycare
            </h1>
            <p class="section-subtitle mt-4 max-w-2xl mx-auto">
                Kami menggabungkan stimulasi tumbuh kembang, nilai-nilai islami, dan fasilitas modern untuk memastikan si
                kecil tumbuh optimal.
            </p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                <span class="badge badge-teal">Usia 3 Bln – 7 Thn</span>
                <span class="badge badge-sunshine">Senin–Sabtu 08.00–16.00</span>
                <span class="badge badge-orange">Surakarta, Jawa Tengah</span>
            </div>
        </div>
    </section>

    <!-- Program Kegiatan -->
    <section class="section-decorated bg-dot-pattern mx-auto max-w-7xl px-4 py-16 md:py-20 md:px-8 relative overflow-hidden"
        style="--dot-color: rgba(232,63,125,0.06); --dot-size: 20px; --deco-opacity: 0.12">
        <!-- Floating decorative shapes -->
        <div class="deco-shape deco-circle animate-deco-float"
            style="--deco-color: #ffd900; --deco-rotate: 12deg; --deco-duration: 7s; width: 70px; height: 70px; top: 5%; right: 3%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-blob"
            style="--deco-color: #09b1ab; --deco-rotate: -8deg; width: 50px; height: 55px; bottom: 10%; left: 4%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-star animate-deco-float"
            style="--deco-color: #e83f7d; --deco-rotate: 20deg; --deco-duration: 5.5s; --deco-delay: 1s; width: 36px; height: 36px; top: 35%; right: 8%;"
            aria-hidden="true"></div>

        <div class="relative flex items-center gap-4 mb-10">
            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full text-2xl"
                style="background:#e83f7d; color:white">🎒</div>
            <div>
                <h2 class="font-display text-3xl font-black text-ink">Program Kegiatan</h2>
                <p class="text-sm font-semibold" style="color:#5c5555">Dirancang untuk stimulasi perkembangan menyeluruh</p>
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">🧠</div>
                <h3 class="font-display text-lg font-black text-ink">Stimulasi Perkembangan</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Aktivitas terstruktur untuk merangsang kognitif, motorik, dan
                    sensoris anak.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">🕌</div>
                <h3 class="font-display text-lg font-black text-ink">Hafalan Do'a &amp; Surat</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Pengenalan do'a harian dan surat-surat pendek Al-Qur'an sejak
                    dini.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">🙏</div>
                <h3 class="font-display text-lg font-black text-ink">Praktek Wudhu &amp; Sholat</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Bimbingan tata cara ibadah yang menyenangkan dan mudah
                    dipahami anak.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">🩺</div>
                <h3 class="font-display text-lg font-black text-ink">Pemeriksaan Kesehatan</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Pemantauan kesehatan rutin agar tumbuh kembang anak terpantau
                    optimal.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">💆‍♀️</div>
                <h3 class="font-display text-lg font-black text-ink">Baby Massage</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Pijat bayi yang menenangkan dan bermanfaat bagi pertumbuhan si
                    kecil.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">📖</div>
                <h3 class="font-display text-lg font-black text-ink">Read Aloud</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Sesi membaca nyaring untuk meningkatkan kecintaan anak pada
                    buku dan literasi.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">👨‍🍳</div>
                <h3 class="font-display text-lg font-black text-ink">Cooking Class</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Belajar memasak sederhana yang menyenangkan dan mengasah
                    kreativitas.</p>
            </div>
            <div class="card" style="border-color:#e83f7d; background: linear-gradient(135deg, white 70%, #ffd6e5 100%)">
                <div class="text-4xl mb-3">🌱</div>
                <h3 class="font-display text-lg font-black text-ink">Taman Gizi</h3>
                <p class="mt-1 text-sm" style="color:#5c5555">Edukasi gizi dan kesehatan melalui kegiatan berkebun yang
                    edukatif.</p>
            </div>
        </div>
    </section>

    <!-- Wavy Divider -->
    <div class="wavy-divider" aria-hidden="true">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0 30C120 55 240 5 480 30C720 55 840 5 1080 30C1200 50 1320 10 1440 30V60H0V30Z" fill="#eaf9fc" />
            <path d="M0 30C120 55 240 5 480 30C720 55 840 5 1080 30C1200 50 1320 10 1440 30" stroke="#f36b21"
                stroke-opacity="0.12" stroke-width="2" />
        </svg>
    </div>

    <!-- Fasilitas Unggulan -->
    <section class="section-decorated px-4 py-16 md:py-20 relative overflow-hidden"
        style="background:#eaf9fc; --deco-opacity: 0.1">
        <!-- Floating decorative shapes -->
        <div class="deco-shape deco-circle"
            style="--deco-color: #f36b21; --deco-rotate: 15deg; width: 75px; height: 75px; top: 8%; left: 5%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-blob animate-deco-float"
            style="--deco-color: #b85bd6; --deco-rotate: -10deg; --deco-duration: 6.5s; width: 55px; height: 65px; bottom: 15%; right: 4%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-diamond animate-deco-float"
            style="--deco-color: #ffd900; --deco-rotate: 35deg; --deco-duration: 7s; --deco-delay: 2s; width: 22px; height: 22px; top: 40%; right: 10%;"
            aria-hidden="true"></div>

        <div class="relative mx-auto max-w-7xl">
            <div class="flex items-center gap-4 mb-10">
                <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full text-2xl"
                    style="background:#f36b21; color:white">🏠</div>
                <div>
                    <h2 class="font-display text-3xl font-black text-ink">Fasilitas Unggulan</h2>
                    <p class="text-sm font-semibold" style="color:#5c5555">Aman, nyaman, dan mendukung tumbuh kembang si
                        kecil</p>
                </div>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🛏️</div>
                    <h3 class="font-display text-lg font-black text-ink">Kasur Busa &amp; AC</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Area tidur siang yang nyaman, bersih, dan berpendingin
                        udara.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">👩‍🏫</div>
                    <h3 class="font-display text-lg font-black text-ink">Tenaga Berpengalaman</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Pengasuh terlatih yang berpengalaman dalam perawatan
                        &amp; stimulasi anak.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🎠</div>
                    <h3 class="font-display text-lg font-black text-ink">Sarana Bermain</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Peralatan bermain edukatif yang aman dan sesuai usia
                        anak.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🧊</div>
                    <h3 class="font-display text-lg font-black text-ink">Freezer ASI</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Tersedia penyimpanan ASI khusus untuk mendukung ibu
                        menyusui.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🧴</div>
                    <h3 class="font-display text-lg font-black text-ink">Sterilizer</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Peralatan makan &amp; botol susu selalu terjaga
                        kesterilannya.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🍲</div>
                    <h3 class="font-display text-lg font-black text-ink">Makan Siang Bergizi</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Menu makan siang bergizi seimbang setiap hari untuk si
                        kecil.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🛁</div>
                    <h3 class="font-display text-lg font-black text-ink">Mandi Sore</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Anak pulang ke rumah dalam keadaan bersih dan segar.</p>
                </div>
                <div class="card"
                    style="border-color:#f36b21; background: linear-gradient(135deg, white 70%, #ffe0c7 100%)">
                    <div class="text-4xl mb-3">🔒</div>
                    <h3 class="font-display text-lg font-black text-ink">Lingkungan Aman</h3>
                    <p class="mt-1 text-sm" style="color:#5c5555">Area yang terpantau, bersih, dan ramah untuk anak-anak.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Harga -->
    <section class="section-decorated px-4 py-16 md:py-24 relative overflow-hidden"
        style="background: linear-gradient(180deg, #fff8e8 0%, #ddf7ff 100%); --deco-opacity: 0.1">
        <!-- Floating decorative shapes -->
        <div class="deco-shape deco-circle animate-deco-float"
            style="--deco-color: #ffd900; --deco-rotate: 10deg; --deco-duration: 8s; width: 50px; height: 50px; top: 8%; left: 4%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-blob"
            style="--deco-color: #b85bd6; --deco-rotate: -12deg; width: 70px; height: 60px; bottom: 20%; right: 6%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-star animate-deco-float"
            style="--deco-color: #e83f7d; --deco-rotate: 25deg; --deco-duration: 6s; --deco-delay: 2s; width: 35px; height: 35px; top: 45%; right: 10%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-diamond animate-deco-float"
            style="--deco-color: #09b1ab; --deco-rotate: 30deg; --deco-duration: 7s; --deco-delay: 0.5s; width: 24px; height: 24px; bottom: 10%; left: 8%;"
            aria-hidden="true"></div>

        <div class="relative mx-auto max-w-7xl">
            <div class="text-center mb-12">
                <span class="badge badge-teal mb-3">💰 Harga Terjangkau</span>
                <h2 class="section-title">Tarif Penitipan</h2>
                <p class="section-subtitle mt-2 max-w-xl mx-auto">Harga bersahabat, fasilitas dan program terlengkap.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded-card text-center p-8 border-2"
                    style="background:white; border-color:#ffd900; box-shadow: 6px 6px 0 #ffd900">
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
                    style="background:#09b1ab; border-color:#087c7a; box-shadow: 6px 6px 0 #087c7a">
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
                        style="background:#ffd900; color:#2f2b2b; box-shadow: 3px 3px 0 rgba(47,43,43,0.25)">Pilih Paket
                        Ini</a>
                </div>

                <div class="rounded-card text-center p-8 border-2"
                    style="background:white; border-color:#b85bd6; box-shadow: 6px 6px 0 #b85bd6">
                    <div class="text-5xl mb-3">🧸</div>
                    <div class="font-display text-xl font-black text-ink">Murid Non-PAUD</div>
                    <div class="mt-4 border-t border-border-default pt-4 space-y-3">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Harian</div>
                            <div class="font-display font-black text-ink" style="font-size:2rem">Rp
                                {{ $nonPaudHarian['main'] }}<span class="text-lg">{{ $nonPaudHarian['sub'] }}</span></div>
                        </div>
                        <div class="border-t border-border-default pt-3">
                            <div class="text-xs font-bold uppercase tracking-wider" style="color:#5c5555">Bulanan</div>
                            <div class="font-display font-black text-ink" style="font-size:2rem">Rp
                                {{ $nonPaudBulanan['main'] }}<span class="text-lg">{{ $nonPaudBulanan['sub'] }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('daftar') }}" class="btn btn-ghost w-full mt-6"
                        style="box-shadow: 3px 3px 0 #b85bd6; border-color:#b85bd6; color:#b85bd6">Pilih Paket Ini</a>
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

    <!-- CTA -->
    <section class="section-decorated px-4 py-16 md:py-20 relative overflow-hidden" style="--deco-opacity: 0.15">
        <!-- Floating decorative shapes -->
        <div class="deco-shape deco-circle animate-deco-float"
            style="--deco-color: #ffd900; --deco-rotate: 20deg; --deco-duration: 6s; width: 55px; height: 55px; top: 8%; left: 5%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-star animate-deco-float"
            style="--deco-color: #e83f7d; --deco-rotate: -10deg; --deco-duration: 5s; --deco-delay: 1s; width: 40px; height: 40px; top: 12%; right: 7%;"
            aria-hidden="true"></div>
        <div class="deco-shape deco-blob animate-deco-float"
            style="--deco-color: #b85bd6; --deco-rotate: 15deg; --deco-duration: 7s; --deco-delay: 2s; width: 45px; height: 55px; bottom: 10%; right: 10%;"
            aria-hidden="true"></div>

        <div class="relative mx-auto max-w-3xl rounded-card text-center px-8 py-12"
            style="background:#09b1ab; box-shadow: 8px 8px 0 #087c7a">
            <h2 class="font-display text-3xl font-black text-white">Siap Daftar?</h2>
            <p class="mt-2 text-lg font-semibold" style="color:rgba(255,255,255,0.85)">Isi formulir pendaftaran atau
                hubungi {{ $waDisplayName }} langsung.</p>
            <div class="mt-6 flex flex-wrap justify-center gap-4">
                <a href="{{ route('daftar') }}" class="btn btn-secondary btn-lg">Isi Formulir Daftar</a>
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" rel="noopener" class="btn btn-ghost btn-lg"
                    style="color:white; box-shadow: inset 0 0 0 2px white, 4px 4px 0 rgba(47,43,43,0.2)">💬
                    {{ $waDisplayNumber }}</a>
            </div>
        </div>
    </section>

@endsection
