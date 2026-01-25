<style>
    .navbar {
        position: fixed;
        width: 100%;
        z-index: 80;
        transition: all 0.4s ease;
    }

    .navbar-transparent {
        background-color: transparent;
        box-shadow: none;
    }

    .navbar-solid {
        background-color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Mobile Menu Styles */
    #mobileMenu {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background-color: white;
        border-top: 1px solid #e5e7eb;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transform: translateY(-10px);
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        z-index: 40;
    }

    #mobileMenu.show {
        transform: translateY(0);
        opacity: 1;
        visibility: visible;
    }

    /* Dropdown Styles */
    .dropdown-content {
        display: none;
        position: absolute;
        left: 0;
        top: 100%;
        min-width: 220px;
        z-index: 50;
        background-color: #ffffff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
    }

    .group:hover .dropdown-content {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-item {
        display: block;
        padding: 0.75rem 1.25rem;
        color: #1f2937;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f3f4f6;
        color: #2563eb;
        padding-left: 1.5rem;
    }

    /* Navbar Text Colors */
    .navbar-transparent .nav-text {
        color: #fffcfcff;
    }
    .navbar-transparent a:hover {
        color: rgba(17, 206, 58, 0.73);
    }
    .navbar-transparent .nav-text-secondary {
        color: rgba(255, 255, 255, 0.9);
    }

    .navbar-solid .nav-text {
        color: #1f2937;
    }
    .navbar-solid a:hover {
        color: #198802ff;
    }

    .navbar-solid .nav-text-secondary {
        color: #4b5563;
    }

    /* Mobile submenu animation */
    .mobile-submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .mobile-submenu.open {
        max-height: 200px;
    }
    .navbar .nav-text.bg-blue-500 {
        background-color: #0f8941;
        color: #fff;
        border: none;
        box-shadow: 0 2px 8px rgba(15,137,65,0.15);
    }
.navbar .nav-text.bg-blue-500:hover {
    background-color: #0c6c33;
}
.navbar .nav-text.bg-yellow-400 {
    background-color: #facc15;
    color: #1f2937;
    border: none;
    box-shadow: 0 2px 8px rgba(250,204,21,0.15);
}
.navbar .nav-text.bg-yellow-400:hover {
    background-color: #fde047;
}
@media (max-width: 1023px) {
    .navbar .md\\:flex.absolute.right-0 {
        position: static;
        transform: none;
        margin-right: 0;
    }
}
</style>

<nav class="navbar {{ Request::is('/') || Request::is('struktur-organisasi') ? 'navbar-transparent' : 'navbar-solid' }}">
    <div class="container mx-auto px-4">
        <div class="relative flex justify-between items-center h-16 md:h-20">
            <div class="flex items-center space-x-4 py-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-12 md:h-14 md:w-14 object-contain">
                <div class="flex flex-col">
                    <span class="text-lg md:text-xl font-bold nav-text leading-tight">SDIT SEMESTA CENDEKIA</span>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button type="button" id="mobileMenuBtn" class="block md:hidden p-2 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}" class="nav-text hover:text-blue-500 transition-colors duration-200">Beranda</a>
                <a href="{{ url('/pendaftaran') }}" class="nav-text hover:text-blue-500 transition-colors duration-200">Pendaftaran</a>
                <a href="{{ url('/hasil-seleksi') }}" class="nav-text hover:text-blue-500 transition-colors duration-200">Hasil Seleksi</a>
                <a href="{{ route('berita.index') }}" class="nav-text hover:text-blue-500 transition-colors duration-200">Berita</a>
                <a href="{{ url('/galeri') }}" class="nav-text hover:text-blue-500 transition-colors duration-200">Galeri Sekolah</a>
                <a href="{{ url('/') }}#ekstrakurikuler" class="nav-text hover:text-blue-500 transition-colors duration-200">Ekstrakurikuler</a>
                <a href="{{ url('/') }}#contact" class="nav-text hover:text-blue-500 transition-colors duration-200">Kontak</a>
            </div>
            
        </div>
        <!-- Tombol Pendaftaran & Hasil Seleksi di pojok kanan
        <div class="hidden md:flex items-center space-x-2 absolute right-0 top-1/2 transform -translate-y-1/2 mr-4">
            <a href="{{ url('/pendaftaran') }}" class="nav-text px-4 py-2 rounded-lg font-semibold" style="background-color:#0f8941;color:#fff;box-shadow:0 2px 8px rgba(15,137,65,0.15);">Pendaftaran</a>
            <a href="{{ url('/hasil-seleksi') }}" class="nav-text px-4 py-2 rounded-lg font-semibold bg-yellow-400 text-gray-900 hover:bg-yellow-500 transition-colors duration-200 shadow-md ml-2">Hasil Seleksi</a>
        </div>  -->
        <div id="mobileMenu" class="md:hidden">
            <div class="py-3 space-y-1">
                <a href="{{ url('/') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-500 transition-colors duration-200">
                    Beranda
                </a>
                <a href="{{ url('/pendaftaran') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-500 transition-colors duration-200">
                    Pendaftaran
                </a>
                <a href="{{ url('/hasil-seleksi') }}" class="block px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-yellow-700 font-semibold transition-colors duration-200">
                    Hasil Seleksi
                </a>
                <a href="{{ route('berita.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-500 transition-colors duration-200">
                    Berita
                </a>
                <a href="{{ url('/galeri') }}" class="block px-4 py-3 text-gray-700 hover:bg-yellow-100 hover:text-yellow-700 font-semibold transition-colors duration-200">
                    Galeri Sekolah
                </a>
                <a href="{{ url('/') }}#ekstrakurikuler" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-500 transition-colors duration-200">
                    Ekstrakurikuler
                </a>
                
                <a href="{{ url('/') }}#contact" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-blue-500 transition-colors duration-200">
                    Kontak
                </a>
            </div>
        </div>
    </div>
</nav>

@include('partial.chat')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    // Handle navbar transparency on scroll
    function handleScroll() {
        try {
            const carousel = document.querySelector('.carousel');
            const hasCarousel = carousel !== null;
            
            if (!hasCarousel) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-solid');
                return;
            }

            if (window.scrollY > 50) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-solid');
            } else {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('navbar-solid');
            }
        } catch (error) {
            // If any error occurs, ensure navbar is solid
            navbar.classList.remove('navbar-transparent');
            navbar.classList.add('navbar-solid');
        }
    }

    // Initial scroll check and event listener
    handleScroll();
    window.addEventListener('scroll', handleScroll);

    // Mobile menu toggle with animation
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('show');
            try {
                const carousel = document.querySelector('.carousel');
                const hasCarousel = carousel !== null;
                
                if (mobileMenu.classList.contains('show')) {
                    navbar.classList.remove('navbar-transparent');
                    navbar.classList.add('navbar-solid');
                } else if (window.scrollY <= 50 && hasCarousel) {
                    navbar.classList.add('navbar-transparent');
                    navbar.classList.remove('navbar-solid');
                }
            } catch (error) {

                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-solid');
            }
        });
    }

    window.toggleMobileSubmenu = function(id) {
        const submenu = document.getElementById(id);
        const button = event.currentTarget;
        const icon = button.querySelector('svg');
        
        if (submenu) {
            submenu.classList.toggle('open');
            icon.style.transform = submenu.classList.contains('open') ? 'rotate(180deg)' : '';
        }
    };

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
            mobileMenu.classList.remove('show');
            if (window.scrollY <= 50) {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('navbar-solid');
            }
        }
    });
});
</script>
