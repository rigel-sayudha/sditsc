<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDIT SEMESTA CENDEKIA - Sekolah Dasar Berkualitas</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        @media (max-width: 640px) {
            .carousel-item img {
                height: 100vh;
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    @php
        $poster = \App\Models\Poster::where('status', 'published')->latest()->first();
    @endphp
    @if($poster)
    <div id="home-poster-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40" style="display:none;">
        <div class="relative bg-white rounded-xl shadow-2xl overflow-hidden" style="max-width:350px;">
            <button id="close-home-poster" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900 text-lg font-bold" style="background:rgba(255,255,255,0.7);border:none;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;cursor:pointer;">&times;</button>
            <img src="{{ asset('storage/' . $poster->gambar) }}" alt="Poster Iklan" class="w-full h-auto" style="max-height:400px;object-fit:cover;">
        </div>
    </div>
    @endif

    @include('partial.navbar')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fallback: jika partial.navbar tidak bisa diubah, tambahkan link secara paksa ke menu mobile
        var mobileNav = document.querySelector('.mobile-nav ul, .mobile-navbar ul, #mobile-navbar ul, .navbar-mobile ul, nav ul');
        if (mobileNav && !mobileNav.querySelector('.hasil-seleksi-link')) {
            var li = document.createElement('li');
            li.className = 'hasil-seleksi-link';
            var a = document.createElement('a');
            a.href = "{{ route('hasil-seleksi') }}";
            a.textContent = 'Hasil Seleksi';
            a.className = 'block px-4 py-2 text-gray-700 hover:bg-gray-100';
            li.appendChild(a);
            // Selipkan setelah link Pendaftaran jika ada
            var daftar = mobileNav.querySelector('a[href*="pendaftaran"]');
            if (daftar && daftar.parentElement.nextElementSibling) {
                daftar.parentElement.parentNode.insertBefore(li, daftar.parentElement.nextElementSibling);
            } else {
                mobileNav.appendChild(li);
            }
        }
    });
    </script>

    @include('partial.carousel')

    <!-- Visi & Misi Section -->
    <section id="visi-misi" class="py-12 md:py-16 px-4">
        <div class="container mx-auto">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">Visi & Misi</h2>
                
                <!-- Visi -->
                <div class="mb-8 md:mb-12 fade-in-up">
                    <div class="flex flex-col md:flex-row items-start md:items-center mb-4">
                        <div class="rounded-full p-2 mb-4 md:mb-0 md:mr-3" style="background-color:#0f8941;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-semibold text-gray-800">Visi Sekolah</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed md:ml-11">
                        "Menjadi lembaga pendidikan dasar unggulan yang menghasilkan generasi berkarakter, 
                        berprestasi akademik tinggi, dan berwawasan global dengan berlandaskan nilai-nilai luhur bangsa."
                    </p>
                </div>

                <div class="fade-in-up">
                    <div class="flex items-center mb-4">
                        <div class="rounded-full p-2 mr-3" style="background-color:#0f8941;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-xl md:text-2xl font-semibold text-gray-800">Misi Sekolah</h3>
                    </div>                    <ul class="space-y-4 ml-11">
                        <li class="flex items-start text-gray-600">
                            <div class="text-blue-600 mr-3">•</div>
                            Menyelenggarakan pendidikan karakter yang mengintegrasikan nilai-nilai luhur bangsa dalam setiap aktivitas pembelajaran dan kehidupan sekolah
                        </li>
                        <li class="flex items-start text-gray-600">
                            <div class="text-blue-600 mr-3">•</div>
                            Mengembangkan pembelajaran inovatif berbasis teknologi dan kearifan lokal untuk menciptakan pengalaman belajar yang bermakna dan kontekstual
                        </li>
                        <li class="flex items-start text-gray-600">
                            <div class="text-blue-600 mr-3">•</div>
                            Membangun lingkungan belajar yang inspiratif dan kondusif untuk mendukung pengembangan potensi akademik, sosial, dan emosional siswa secara optimal
                        </li>
                        <li class="flex items-start text-gray-600">
                            <div class="text-blue-600 mr-3">•</div>
                            Menjalin kerjasama strategis dengan berbagai pihak untuk pengembangan kompetensi siswa dan peningkatan kualitas pendidikan secara berkelanjutan
                        </li>
                        <li class="flex items-start text-gray-600">
                            <div class="text-blue-600 mr-3">•</div>
                            Membekali siswa dengan keterampilan abad 21, nilai-nilai kepemimpinan, dan karakter unggul untuk menjadi pribadi yang tangguh dan berdaya saing global
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi & Sambutan Section 
    <section id="informasi-sambutan" class="py-12 md:py-16 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-12 mb-12 md:mb-20">
                <div class="lg:col-span-3">
                    <div class="h-full relative rounded-xl overflow-hidden shadow-xl hover-card">
                        <img src="{{ asset('images/banner-kartini.jpeg') }}" alt="Banner" class="w-full h-[150px] md:h-[200px] object-cover">
                    </div>
                </div>               
                <div class="lg:col-span-9">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                         Pengumuman 
                        <div class="lg:col-span-1 bg-white rounded-xl shadow-lg p-6 hover-card">
                            <h2 class="text-2xl font-bold mb-6">Pengumuman</h2>
                            <div class="space-y-4">
                                <div class="border-b pb-4">
                                    <div class="flex justify-between mb-2">
                                        <h3 class="font-semibold text-gray-800">Penerimaan Siswa Baru 2025/2026</h3>
                                    </div>
                                    <p class="text-sm text-gray-600">Pendaftaran dibuka 15 Mei - 30 Juni 2025</p>
                                </div>

                                <div class="border-b pb-4">
                                    <div class="flex justify-between mb-2">
                                        <h3 class="font-semibold text-gray-800">Jadwal Ujian Akhir Semester</h3>
                                       
                                    </div>
                                    <p class="text-sm text-gray-600">1-10 Juni 2025</p>
                                </div>

                                <div>
                                    <div class="flex justify-between mb-2">
                                        <h3 class="font-semibold text-gray-800">Pekan Olahraga dan Seni</h3>
                           
                                    </div>
                                    <p class="text-sm text-gray-600">20-25 Mei 2025</p>
                                </div>
                            </div>
                            <a href="#" class="inline-block mt-4 text-green-600 hover:text-green-800 text-sm font-semibold">Lihat semua pengumuman →</a>                        
                        </div>                       
                        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6 hover-card">
                            <h2 class="text-2xl font-bold mb-6">Sambutan Kepala Sekolah</h2>
                            @php
                                $sambutan = \App\Models\Sambutan::where('status', 'published')->latest()->first();
                            @endphp
                            @if($sambutan)
                            <div class="flex flex-col md:flex-row md:space-x-8">
                                <div class="flex-shrink-0 mb-4 md:mb-0 w-full md:w-40">
                                    @if($sambutan->foto)
                                        <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Kepala Sekolah" class="w-full h-40 object-cover rounded-lg shadow-md" style="max-width:160px;max-height:160px;display:block;margin:auto;">
                                    @else
                                        <div class="w-full md:w-40 h-40 bg-gray-200 flex items-center justify-center rounded-lg">
                                            <span class="text-gray-400">No Image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <div class="text-gray-600 text-justify" id="sambutan-short">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($sambutan->isi), 180) }}
                                    </div>
                                    <div class="text-gray-600 text-justify hidden" id="sambutan-full">
                                        {!! nl2br(e($sambutan->isi)) !!}
                                    </div>
                                    <div class="mt-4 text-right">
                                        <p class="font-semibold text-gray-800 mb-0">{{ $sambutan->nama_kepala }}</p>
                                        @if($sambutan->jabatan)
                                            <p class="text-gray-600 mt-0">{{ $sambutan->jabatan }}</p>
                                        @endif
                                    </div>
                                    <button type="button" id="read-more" class="font-semibold mt-4" style="color:#0f8941;" onclick="toggleSambutan()">Baca selengkapnya →</button>
                                </div>
                            </div>
                            <script>
                                function toggleSambutan() {
                                    const shortDiv = document.getElementById('sambutan-short');
                                    const fullDiv = document.getElementById('sambutan-full');
                                    const btn = document.getElementById('read-more');
                                    if (fullDiv.classList.contains('hidden')) {
                                        shortDiv.classList.add('hidden');
                                        fullDiv.classList.remove('hidden');
                                        btn.textContent = '← Tutup';
                                    } else {
                                        shortDiv.classList.remove('hidden');
                                        fullDiv.classList.add('hidden');
                                        btn.textContent = 'Baca selengkapnya →';
                                    }
                                }
                            </script>
                            @else
                                <div class="text-gray-500">Belum ada sambutan kepala sekolah yang dipublikasikan.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
-->
    <!-- Articles Section -->
    <section id="articles" class="py-12 md:py-16" style="background-color:#e6f4ec;">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Berita Terkini</h2>
                <div class="w-24 h-1 mx-auto" style="background-color:#0f8941;"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($articles as $article)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:-translate-y-2">
                <div class="relative">
                    <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-56 object-cover">
                    <div class="absolute bottom-2 left-2 bg-black bg-opacity-50 rounded-md px-3 py-1">
                        <span class="text-white text-xs font-semibold">{{ $article->created_at->format('d F Y') }}</span>
                    </div>
                </div>
            <div class="p-6">
                <!--<div class="text-sm text-gray-500 mb-2">{{ $article->created_at->format('d F Y') }}</div>-->
                <h3 class="text-xl font-semibold mb-3 text-gray-800">{{ $article->judul }}</h3>
                <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($article->konten), 120) }}</p>
                <a href="{{ route('berita.show', $article->slug) }}" class="px-4 py-2 rounded text-white" style="background-color:#0f8941;transition:background-color 0.2s;" onmouseover="this.style.backgroundColor='#0c6c33'" onmouseout="this.style.backgroundColor='#0f8941'">Baca Selengkapnya</a>
            </div>
        </div>
                @empty
                <div class="col-span-3 text-center text-gray-500">Belum ada berita.</div>
                @endforelse
            </div>
        </div>
    </section>

    @include('partial.article-modal')

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('article-modal');
        const modalTitle = document.getElementById('modal-article-title');
        const modalContent = document.getElementById('modal-article-content');
        const closeBtn = document.getElementById('close-article-modal');

        document.querySelectorAll('.read-more-btn').forEach(button => {
            button.addEventListener('click', function () {
                const articleId = this.getAttribute('data-article-id');
                fetch(`/api/articles/${articleId}`)
                    .then(response => response.json())
                    .then data => {
                        modalTitle.textContent = data.judul;
                        modalContent.innerHTML = data.konten;
                        modal.classList.remove('hidden');
                    })
                    .catch(error => {
                        alert('Gagal memuat artikel.');
                        console.error(error);
                    });
            });
        });

        closeBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            modalTitle.textContent = '';
            modalContent.innerHTML = '';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                closeBtn.click();
            }
        });
    });
    </script>

    <!-- Ekstrakurikuler Section -->
    <section id="ekstrakurikuler" class="py-12 md:py-16 bg-gradient-to-b from-blue-50 to-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Ekstrakurikuler</h2>
                <div class="w-24 h-1 mx-auto" style="background-color:#0f8941;"></div>
                <p class="mt-4 text-gray-600">Mengembangkan Bakat dan Minat Siswa</p>
            </div>
            @if($ekstrakurikulers->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach($ekstrakurikulers as $ekstra)
                <div class="bg-white rounded-xl shadow-lg p-6 transform transition duration-300 hover:-translate-y-2">
                    @if($ekstra->foto)
                        <img src="{{ asset('storage/' . $ekstra->foto) }}" alt="{{ $ekstra->nama }}" class="w-20 h-20 object-cover rounded-full mx-auto mb-4">
                    @else
                        <div class="rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4" style="background-color:#b6e2c7;">
                            <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                    @endif
                    <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">{{ $ekstra->nama }}</h3>
                    <p class="text-gray-600 text-sm text-center">{{ $ekstra->deskripsi }}</p>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-12 md:py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 md:mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-3">Hubungi Kami</h2>
                <div class="w-24 h-1 mx-auto" style="background-color:#0f8941;"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-12">
                <!-- Map -->
                <div class="rounded-lg overflow-hidden shadow-lg h-[300px] md:h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2306.8857643466904!2d110.8962832638998!3d-7.561073815783938!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a1779179248bd%3A0xa5087ca2d66bcc55!2sSDIT%20Semesta%20Cendekia!5e0!3m2!1sid!2sid!4v1754366776896!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        class="rounded-lg"
                    ></iframe>
                </div>

                <!-- Contact Info -->
                <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 hover-card">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Informasi Kontak</h3>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="rounded-full p-3 mr-4" style="background-color:#0f8941;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">Alamat</h4>
                                <p class="text-gray-600">Jetis Kulon, Jetis, Kec. Jaten<br>Kabupaten Karanganyar, Jawa Tengah 57731</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="rounded-full p-3 mr-4" style="background-color:#0f8941;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600">semestacendekia.sdit@gmail.com</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="rounded-full p-3 mr-4" style="background-color:#0f8941;">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">Telepon</h4>
                                <a href="https://wa.me/+6282242714248"><p class="text-gray-600">082242714248</p></a>
                                <a href="https://wa.me/+6285791760118"><p class="text-gray-600">085791760118</p></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 h-[300px] md:h-[400px] flex flex-col justify-between">
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-6">Kotak Saran</h3>
                    <form action="{{ route('kotak-saran.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700 font-medium mb-2">Nama (opsional)</label>
                            <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Saran / Pesan</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent" required></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="px-6 py-3 font-semibold rounded-lg transition duration-300" style="background-color:#0f8941;color:#fff;">Kirim</button>
                        </div>
                    </form>

                    <!-- Saran terbaru dihapus dari halaman home -->
                </div>
            </div>
        </div>
    </section>

    @include('partial.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert untuk notifikasi kotak saran
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Terima kasih!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#0f8941',
            });
        @endif

        // Poster pop-up logic
        document.addEventListener('DOMContentLoaded', function() {
            var popup = document.getElementById('popup-poster');
            var closeBtn = document.getElementById('close-poster');
            // Show poster only on first load
            if (!sessionStorage.getItem('posterClosed')) {
                popup.style.display = 'flex';
            }
            closeBtn.addEventListener('click', function() {
                popup.style.display = 'none';
                sessionStorage.setItem('posterClosed', '1');
            });

            // Intersection Observer for fade-in-up animation
            const fadeElements = document.querySelectorAll('.fade-in-up');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationDelay = '0.2s';
                        entry.target.style.opacity = '1';
                    }
                });
            }, {
                threshold: 0.1
            });
            fadeElements.forEach(element => {
                observer.observe(element);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            if (!sessionStorage.getItem('homePosterClosed')) {
                document.getElementById('home-poster-modal').style.display = 'flex';
            }
            document.getElementById('close-home-poster').addEventListener('click', function () {
                document.getElementById('home-poster-modal').style.display = 'none';
                sessionStorage.setItem('homePosterClosed', '1');
            });
        });

        function toggleSambutan() {
            const sambutanFull = document.getElementById('sambutan-full');
            const readMoreBtn = document.getElementById('read-more');
            if (sambutanFull.classList.contains('hidden')) {
                sambutanFull.classList.remove('hidden');
                readMoreBtn.textContent = '← Tutup';
            } else {
                sambutanFull.classList.add('hidden');
                readMoreBtn.textContent = 'Baca selengkapnya →';
            }
        }
    </script>
</body>
</html>