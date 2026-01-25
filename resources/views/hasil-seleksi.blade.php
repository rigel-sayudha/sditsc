<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" type="image/png" href="images/logo.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Hasil Seleksi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-between">
    @include('partial.navbar')
    <main class="flex-grow">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-2xl font-bold mb-6 text-center">DAFTAR SISWA YANG BERHASIL LOLOS SELEKSI TAHUN AJARAN {{ $currentYear }}</h1>
            <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-6 text-left">Peringkat</th>
                            <th class="py-3 px-6 text-left">Nama Siswa</th>
                            {{-- <th class="py-3 px-6 text-left">Total Skor</th> --}}
                            {{-- <th class="py-3 px-6 text-left">Skor Ujian</th>
                            <th class="py-3 px-6 text-left">Jumlah Sumbangan</th>
                            <th class="py-3 px-6 text-left">Poin Sumbangan</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php $rank = 1; @endphp
                        @forelse ($acceptedRegistrations as $reg)
                            <tr class="{{ $rank % 2 == 1 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $rank }}</td>
                                <td class="py-3 px-6">{{ $reg->nama ?? 'N/A' }}</td>
                            </tr>
                            @php $rank++; @endphp
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data siswa yang diterima.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@include('partial.footer')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @stack('scripts')
</body>
</html>
