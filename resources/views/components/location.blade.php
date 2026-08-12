<section id="lokasi" class="scroll-mt-20 bg-muted py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto mb-16 max-w-3xl text-center">
            <p class="mb-4 text-xs font-semibold uppercase tracking-[0.28em] text-primary">
                Peta Wilayah
            </p>
            <h2 class="text-4xl font-semibold text-primary md:text-5xl">
                Lokasi & Geografis
            </h2>
            <p class="mx-auto mt-6 max-w-2xl text-lg text-muted-foreground">
                Informasi lengkap lokasi, kondisi geografis, dan data kependudukan Kepenghuluan Sintong Pusaka.
            </p>
        </div>

        @php
            $wilayahInfo = [
                ['label' => 'Kabupaten', 'value' => 'Rokan Hilir'],
                ['label' => 'Provinsi', 'value' => 'Riau'],
                ['label' => 'Luas Wilayah', 'value' => '253,21 Km²'],
                ['label' => 'Batas Utara', 'value' => 'Kepenghuluan Teluk Mega'],
                ['label' => 'Batas Selatan', 'value' => 'Kepenghuluan Sekeladi'],
                ['label' => 'Batas Barat', 'value' => 'Kecamatan Bangko'],
                ['label' => 'Batas Timur', 'value' => 'Kecamatan Mandau'],
            ];
        @endphp

        <!-- Peta + Informasi Wilayah: satu kartu menyatu -->
        <div class="mb-6 grid grid-cols-1 overflow-hidden rounded-sm border border-border lg:grid-cols-2">
            <!-- Peta -->
            <div class="min-h-[420px] bg-muted">
                <iframe src="https://desa-sintongpusaka.my.id/Peta/" width="100%" height="100%"
                    class="h-full min-h-[420px] w-full" frameborder="0" style="border: none;"
                    allowfullscreen></iframe>
            </div>

            <!-- Informasi Wilayah -->
            <div class="border-t border-border bg-background p-8 lg:border-l lg:border-t-0">
                <h3 class="mb-4 text-lg font-semibold text-primary">Informasi Wilayah</h3>
                <div class="divide-y divide-dashed divide-border">
                    @foreach ($wilayahInfo as $item)
                        <div class="flex items-center justify-between gap-4 py-2.5">
                            <span class="text-sm font-medium text-muted-foreground">{{ $item['label'] }}</span>
                            <span class="text-right text-sm font-semibold text-foreground">{{ $item['value'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Data Administrasi & Demografi -->
        <div class="rounded-sm border border-border bg-background">
            <div class="border-b border-border px-6 py-4">
                <h3 class="text-xl font-semibold text-primary">Data Administrasi & Demografi</h3>
                <p class="mt-1 text-muted-foreground">
                    Pembagian wilayah administratif dan data kependudukan
                </p>
            </div>
            <div class="grid grid-cols-2 gap-px bg-border sm:grid-cols-3">
                @foreach ($data as $item)
                    <div class="bg-background py-6 text-center">
                        <div class="mb-1 text-2xl font-bold text-primary">
                            {{ number_format($item['value'], 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-muted-foreground">
                            {{ $item['label'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
