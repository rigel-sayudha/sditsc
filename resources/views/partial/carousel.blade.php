 <!-- Hero Section -->
    <section id="home" class="relative min-h-screen">
        <div class="carousel relative w-full min-h-screen">
            <div class="carousel-items absolute inset-0">
            <div class="carousel-item active">
                <img src="{{ asset('images/scdepan.png') }}" class="w-full h-screen object-cover object-center" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/pram.jpeg') }}" class="w-full h-screen object-cover object-center" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/upc.jpeg') }}" class="w-full h-screen object-cover object-center" alt="Slide 3">
            </div>
            </div>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <!-- Content -->
            <div class="container mx-auto px-4 relative z-10 h-full flex items-center justify-center">
                <div class="w-full flex flex-col items-center text-center">
                    <div class="w-full md:w-1/2 text-white mt-32">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">Selamat Datang di SDIT SEMESTA CENDEKIA</h1>
                        <p class="text-lg md:text-xl mb-8">Membentuk Generasi Unggul dengan Pendidikan Berkualitas</p>
                        <a href="{{ url('/pendaftaran') }}" class="inline-block bg-yellow-500 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-yellow-600 transition duration-300">
                            Gabung Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control prev absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-30 rounded-full p-2 hover:bg-opacity-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="carousel-control next absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-30 rounded-full p-2 hover:bg-opacity-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            <div class="carousel-indicators absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 active"></button>
                <button class="w-3 h-3 rounded-full bg-white bg-opacity-50"></button>
                <button class="w-3 h-3 rounded-full bg-white bg-opacity-50"></button>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.carousel');
        const items = carousel.querySelectorAll('.carousel-item');
        const indicators = carousel.querySelectorAll('.carousel-indicators button');
        let currentIndex = 0;

        function showSlide(index) {
            items.forEach(item => item.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            items[index].classList.add('active');
            indicators[index].classList.add('active');
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % items.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + items.length) % items.length;
            showSlide(currentIndex);
        }

        carousel.querySelector('.next').addEventListener('click', nextSlide);
        carousel.querySelector('.prev').addEventListener('click', prevSlide);

        setInterval(nextSlide, 5000);
    });
    </script>

    <style>
    .carousel-item {
        display: none;
        transition: opacity 0.5s ease-in-out;
    }

    .carousel-item.active {
        display: block;
    }

    .carousel-control {
        transition: background-color 0.3s ease;
    }

    .carousel-indicators button.active {
        background-opacity: 1;
    }
    </style>