@extends('admin.layouts.admin')

@section('title')
Data Pendaftaran Siswa Baru
@endsection

@section('content')
<div class="flex flex-col sm:flex-row justify-between mb-6 gap-2">
    <div class="flex gap-2">
        <a href="{{ route('admin.printAcceptedRegistrations') }}" target="_blank" class="inline-block px-6 py-2 bg-green-700 text-white rounded hover:bg-green-800 font-semibold shadow transition">
            
            Rekap PDF Siswa Lolos
        </a>
        <form id="form-hapus-semua" action="{{ route('admin.registrations.deleteAll') }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="button" id="btn-hapus-semua" class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 font-semibold shadow transition">Hapus Semua Data</button>
        </form>
    </div>
</div>
<div class="bg-white rounded-xl shadow-lg overflow-x-auto max-w-screen-2xl mx-auto p-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative m-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative m-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    @php
        if (!function_exists('penghasilanToNominal')) {
            function penghasilanToNominal($val) {
                if ($val === '<1.000.000') return 500000;
                if ($val === '1.000.000-1.999.999') return 1500000;
                if ($val === '2.000.000-4.999.999') return 3500000;
                if ($val === '>=5.000.000') return 5000000;
                return 0;
            }
        }
    @endphp
    <div class="w-full overflow-x-auto">
        <table class="min-w-[900px] w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <!-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th> -->
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal Tes ABK</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan Ayah</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pekerjaan Ibu</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penghasilan Ayah</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penghasilan Ibu</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Hp Orang Tua</th>
                    {{-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Penghasilan Orang Tua (Poin)</th> --}}
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status PIP</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File KK</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File Akta</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tes Warna</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interaksi</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tes Baca Tulis</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ABK</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <div class="flex items-center gap-1">
                            Total
                            <form method="GET" action="{{ route('admin.leaderboard') }}">
                                <input type="hidden" name="sort" value="{{ (isset($sort) && $sort == 'desc') ? 'asc' : 'desc' }}">
                                <button type="submit" class="p-0 m-0 bg-transparent border-none focus:outline-none" title="Sortir Total Poin">
                                    @if(isset($sort) && $sort == 'desc')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>

                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($registrations as $i => $reg)
                <tr>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $i+1 }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->nama }}</td>
                    <!-- <td class="px-4 py-3 whitespace-nowrap">{{ $reg->email }}</td> -->
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->jadwal_abk }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->tanggal_lahir }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->jenis_kelamin }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->pekerjaan_ayah }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->pekerjaan_ibu }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->penghasilan_ayah }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->penghasilan_ibu }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if($reg->telepon_ortu)
                            <div class="flex items-center gap-2">
                                <a href="https://wa.me/{{ '62' . substr(preg_replace('/[^0-9]/', '', $reg->telepon_ortu), 1) }}?text=Halo,%20Bapak/Ibu%2C%20saya%20dari%20SDIT%20Semesta%20Cendekia%20terkait%20pendaftaran%20{{ urlencode($reg->nama) }}" target="_blank" class="text-sm text-green-600 hover:text-green-800 hover:underline" title="WhatsApp">{{ $reg->telepon_ortu }}</a>
                            </div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    {{-- <td class="px-4 py-3 whitespace-nowrap">
                        @php
                            $total = penghasilanToNominal($reg->penghasilan_ayah) + penghasilanToNominal($reg->penghasilan_ibu);
                            if ($total < 1000000) {
                                $poin = 0;
                            } elseif ($total < 2000000) {
                                $poin = 1;
                            } elseif ($total < 5000000) {
                                $poin = 2;
                            } else {
                                $poin = 3;
                            }
                            if (!function_exists('formatRupiah')) {
                                function formatRupiah($angka) {
                                    return 'Rp ' . number_format($angka, 0, ',', '.');
                                }
                            }
                        @endphp
                        {{ formatRupiah($total) }} ({{ $poin }})
                    </td> --}}
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if($reg->status_pip === 'Y')
                            <span class="text-green-700 font-semibold">Mendapatkan Rekomendasi PIP</span>
                        @elseif($reg->status_pip === 'N')
                            <span class="text-red-700 font-semibold">Tidak Mendapatkan Rekomendasi PIP</span>
                        @else
                            -
                        @endif
                    </td>
                      <td class="px-4 py-3 whitespace-nowrap">
                        @if(!empty($reg->file_kk))
                            <a href="{{ asset('storage/kk/'.$reg->file_kk) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">Lihat KK</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        @if(!empty($reg->file_akta))
                            <a href="{{ asset('storage/akta/'.$reg->file_akta) }}" target="_blank" class="text-blue-600 underline hover:text-blue-800">Lihat Akta</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->tes_warna }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->interaksi }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->tes_baca_tulis }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->abk }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $reg->tes_warna + $reg->interaksi + $reg->tes_baca_tulis + $reg->abk }}</td>
                    <td class="px-4 py-3 whitespace-nowrap flex gap-2">
                        <a href="{{ route('admin.editTes', $reg->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 font-semibold">Edit Tes</a>
                        <a href="{{ route('admin.printRegistration', $reg->id) }}" target="_blank" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition font-semibold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9V2h12v7M6 18v4h12v-4M6 14h12M6 14v4m0-4V9m12 5v4m0-4V9" /></svg>
                            Print PDF
                        </a>
                        @if($reg->status_lolos)
                            <form action="{{ route('admin.belumloloskan', $reg->id) }}" method="POST" onsubmit="return confirm('Yakin ingin ubah status menjadi belum lolos?')">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 font-semibold">Belum Loloskan</button>
                            </form>
                        @else
                            <form action="{{ route('admin.loloskan', $reg->id) }}" method="POST" onsubmit="return confirm('Yakin ingin loloskan siswa ini?')">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">Loloskan</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.registrations.destroy', $reg->id) }}" method="POST" class="inline-block form-hapus-siswa">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700 font-semibold btn-hapus-siswa">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Hapus satu siswa
    document.querySelectorAll('.btn-hapus-siswa').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Data siswa akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    // Hapus semua siswa
    const btnHapusSemua = document.getElementById('btn-hapus-semua');
    if (btnHapusSemua) {
        btnHapusSemua.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Semua Data?',
                text: 'Seluruh data siswa akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-semua').submit();
                }
            });
        });
    }
});
</script>
                  
                  
@endsection
