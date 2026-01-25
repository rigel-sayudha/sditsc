<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SDIT SEMESTA CENDEKIA</title>
    <link rel="icon" type="image/png" href="../../../images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @media (max-width: 768px) {
            .sidebar-open {
                transform: translateX(0) !important;
            }
        }
        .sidebar-admin {
            background: linear-gradient(135deg, #0f8941 60%, #0c6c33 100%);
            box-shadow: 0 4px 24px rgba(15,137,65,0.18);
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .sidebar-admin:hover {
            box-shadow: 0 8px 32px rgba(15,137,65,0.28);
            transform: scale(1.03);
        }
        .sidebar-nav-btn {
            background: linear-gradient(90deg, #0f8941 80%, #0c6c33 100%);
            color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(15,137,65,0.12);
            padding: 10px 18px;
            margin-bottom: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
        }
        .sidebar-nav-btn:hover, .sidebar-nav-btn.active {
            background: linear-gradient(90deg, #0c6c33 80%, #0f8941 100%);
            box-shadow: 0 6px 18px rgba(15,137,65,0.22);
            transform: scale(1.04);
            color: #fff;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div id="sidebarOverlay" class="fixed inset-0 bg-black opacity-50 z-20 hidden md:hidden" onclick="toggleSidebar()"></div>

    <div class="min-h-screen flex">

        <div id="sidebar" class="sidebar-admin w-64 fixed h-full z-30 transition-transform duration-300 ease-in-out transform -translate-x-full md:translate-x-0">
            <div class="flex items-center justify-between px-4 py-6 relative">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 mr-3">
                    <span class="text-white text-lg font-semibold">SDIT SEMESTA CENDEKIA</span>
                </div>
                <button onclick="toggleSidebar()" class="text-white md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <button id="minimizeSidebarBtn" onclick="minimizeSidebar()" class="absolute -right-4 top-1/2 transform -translate-y-1/2 text-white rounded-full shadow p-1 hidden md:inline-flex z-40 border" style="background-color:#0f8941;border-color:#0c6c33;" title="Minimize Sidebar" style="right:-20px;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
            </div>
            <nav class="mt-8 px-4 flex flex-col gap-2" id="sidebarMenu">
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.ekstrakurikuler.*') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Ekstrakurikuler</a>
                <!-- <a href="/organization" class="sidebar-nav-btn" onclick="closeSidebarOnMobile()">Struktur Organisasi</a> -->
                <!--<a href="/leaderboard" class="sidebar-nav-btn" onclick="closeSidebarOnMobile()">Pendaftaran Siswa Baru</a> -->
                <a href="{{ route('admin.organization') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.organization') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Struktur Organisasi</a>
                <a href="{{ route('admin.leaderboard') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.leaderboard') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Pendaftaran Siswa Baru</a>
                <a href="{{ route('admin.kotak-saran') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.kotak-saran') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Kotak Saran</a>
                <a href="{{ route('admin.poster.index') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.poster.*') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Banner Iklan</a> 
                <a href="{{ route('admin.articles.index') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.articles.*') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Berita Terkini</a>
                <!-- <a href="{{ route('admin.sambutan.index') }}" class="sidebar-nav-btn" onclick="closeSidebarOnMobile()">Sambutan</a> -->
                <a href="{{ route('admin.galeri.index') }}" class="sidebar-nav-btn{{ request()->routeIs('admin.galeri.*') ? ' active' : '' }}" onclick="closeSidebarOnMobile()">Galeri Sekolah</a>
            </nav>
        </div>

        <div id="mainContent" class="flex-1 md:ml-64 transition-all duration-300">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm sticky top-0 z-10">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-700 mr-4 md:hidden">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                            </button>
                            <h1 class="text-xl sm:text-2xl font-semibold text-gray-900">@yield('title')</h1>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Notifikasi Bell -->
                            <div class="relative">
                                <button id="notifBellBtn" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                    <span id="notifBadge" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full px-1.5 py-0.5 font-bold" style="display:none;">0</span>
                                </button>
                                <div id="notifDropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-[1002] opacity-0 pointer-events-none transition duration-200">
                                    <div class="px-4 py-2 font-semibold text-gray-800 border-b">Notifikasi Baru</div>
                                    <div id="notifList" class="max-h-64 overflow-y-auto">
                                        <!-- Notifikasi akan diisi via JS -->
                                    </div>
                                </div>
                            </div>
                            <div class="relative group" style="z-index:1000;">
                                <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none" id="adminDropdownBtn">
                                    <img src="{{ Auth::user() && Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('/images/avatar-placeholder.jpg') }}" alt="Admin" class="w-8 h-8 rounded-full object-cover">
                                    <span class="hidden sm:inline">{{ Auth::user() ? Auth::user()->name : 'Admin' }}</span>
                                    <svg class="w-4 h-4 ml-1 text-gray-500 group-hover:text-gray-700 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div id="adminDropdownMenu" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-[1001] opacity-0 pointer-events-none transition duration-200">
                                    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 transition">Edit Profil</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-700 transition">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden', !overlay.classList.contains('hidden'));
        }

        // Minimize sidebar (desktop)
        function minimizeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const sidebarMenu = document.getElementById('sidebarMenu');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('w-64');
            sidebar.classList.toggle('w-20');
            sidebarMenu.classList.toggle('text-[0px]');
            // Hide text, show only icons
            sidebar.querySelectorAll('span').forEach(span => {
                span.classList.toggle('hidden');
            });
            // Responsive main content margin
            mainContent.classList.toggle('md:ml-64');
            mainContent.classList.toggle('md:ml-20');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Dropdown menu admin navbar
        const dropdownBtn = document.getElementById('adminDropdownBtn');
        const dropdownMenu = document.getElementById('adminDropdownMenu');
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = dropdownMenu.classList.contains('opacity-100');
            if (isOpen) {
                dropdownMenu.classList.remove('opacity-100');
                dropdownMenu.classList.add('opacity-0');
                dropdownMenu.classList.add('pointer-events-none');
            } else {
                dropdownMenu.classList.remove('opacity-0');
                dropdownMenu.classList.remove('pointer-events-none');
                dropdownMenu.classList.add('opacity-100');
            }
        });
        document.addEventListener('click', function(e) {
            if (!dropdownBtn.contains(e.target)) {
                dropdownMenu.classList.remove('opacity-100');
                dropdownMenu.classList.add('opacity-0');
                dropdownMenu.classList.add('pointer-events-none');
            }
        });

        // Simulasi data notifikasi baru
        const notifications = [
            {id:1, title:'Pendaftaran Baru', desc:'Ada 2 pendaftar baru yang belum diverifikasi.', time:'1 menit lalu', seen:false},
            {id:2, title:'Artikel Baru', desc:'Artikel "Kegiatan Ramadhan" telah dipublikasikan.', time:'10 menit lalu', seen:false},
            {id:3, title:'Poster Pop-up', desc:'Poster pop-up baru telah diaktifkan.', time:'1 jam lalu', seen:true},
        ];

        function renderNotifications() {
            const notifList = document.getElementById('notifList');
            notifList.innerHTML = '';
            let newCount = 0;
            notifications.forEach(n => {
                if (!n.seen) newCount++;
                notifList.innerHTML += `<div class="px-4 py-3 border-b hover:bg-green-50 ${n.seen ? 'text-gray-500' : 'text-gray-800 font-bold'}">
                    <div class="flex justify-between items-center">
                        <span>${n.title}</span>
                        <span class="text-xs text-gray-400">${n.time}</span>
                    </div>
                    <div class="text-sm mt-1">${n.desc}</div>
                    ${!n.seen ? '<button class="mt-2 text-xs text-green-700 underline" onclick="markSeen('+n.id+')">Tandai sudah dibaca</button>' : ''}
                </div>`;
            });
            // Badge
            const notifBadge = document.getElementById('notifBadge');
            notifBadge.textContent = newCount;
            notifBadge.style.display = newCount > 0 ? 'block' : 'none';
        }
        function markSeen(id) {
            const notif = notifications.find(n => n.id === id);
            if (notif) notif.seen = true;
            renderNotifications();
        }
        // Dropdown bell
        const notifBellBtn = document.getElementById('notifBellBtn');
        const notifDropdown = document.getElementById('notifDropdown');
        notifBellBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = notifDropdown.classList.contains('opacity-100');
            if (isOpen) {
                notifDropdown.classList.remove('opacity-100');
                notifDropdown.classList.add('opacity-0');
                notifDropdown.classList.add('pointer-events-none');
            } else {
                notifDropdown.classList.remove('opacity-0');
                notifDropdown.classList.remove('pointer-events-none');
                notifDropdown.classList.add('opacity-100');
                renderNotifications();
            }
        });
        document.addEventListener('click', function(e) {
            if (!notifBellBtn.contains(e.target)) {
                notifDropdown.classList.remove('opacity-100');
                notifDropdown.classList.add('opacity-0');
                notifDropdown.classList.add('pointer-events-none');
            }
        });

        function closeSidebarOnMobile() {
            if(window.innerWidth < 768) {
                toggleSidebar();
            }
        }
    </script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#0f8941',
            });
        @endif
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
