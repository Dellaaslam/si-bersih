<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-BERSIH</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Hamburger button */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 25px;
            height: 18px;
            cursor: pointer;
        }
        .hamburger span {
            display: block;
            height: 3px;
            width: 100%;
            background-color: #059669;
            border-radius: 2px;
            transition: 0.3s;
        }

        /* Mobile menu */
        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }
        .mobile-menu.show {
            display: flex;
        }

        /* Shake effect */
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
        .shake {
            animation: shake 0.3s;
        }

        /* Responsive navbar */
        @media (max-width: 768px) {
            .nav-links, .space-x-3 {
                display: none; /* hide desktop nav & buttons */
            }
            .hamburger {
                display: flex;
            }
        }

        /* Hero & grid responsiveness */
        @media (max-width: 768px) {
            .grid-cols-3 {
                grid-template-columns: 1fr;
            }
            .hero img {
                width: 80%;
                max-width: 300px;
                margin: auto;
            }
            .hero h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body class="bg-gray-100">

    {{-- NAVBAR --}}
    <nav class="w-full bg-white shadow-sm fixed top-0 left-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center gap-2">
                <img src="{{ asset('logo.png') }}" class="w-8" alt="Logo SI-BERSIH">
                <h1 class="text-2xl font-bold text-green-800">SI-BERSIH</h1>
            </div>

            <!-- Desktop Links -->
            <div class="nav-links flex gap-6 items-center">
                <a href="#hero">Beranda</a>
                <a href="#features">Fitur</a>
                <a href="#tentang">Tentang kami</a>
                <a href="#contact">Kontak</a>
            </div>

            <div class="space-x-3 flex">
                <a href="{{ route('login') }}" class="px-4 py-2 border border-green-700 text-green-700 rounded-lg hover:bg-green-700 hover:text-white transition duration-300">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition duration-300">Register</a>
            </div>

            <!-- Hamburger -->
            <div class="hamburger flex flex-col justify-between" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu max-w-7xl mx-auto px-6 flex flex-col" id="mobileMenu">
            <a href="#hero" class="py-2 border-b border-gray-200">Beranda</a>
            <a href="#features" class="py-2 border-b border-gray-200">Fitur</a>
            <a href="#contact" class="py-2 border-b border-gray-200">Kontak</a>
            <a href="{{ route('login') }}" class="py-2 border-b border-gray-200">Login</a>
            <a href="{{ route('register') }}" class="py-2">Register</a>
        </div>
    </nav>

    {{-- HERO / BERANDA --}}
    <section id="hero" class="pt-28 pb-20 bg-gray-50 hero">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center px-6">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-snug">
                    SELAMAT DATANG DI <br>
                    <span class="text-green-800">SI-BERSIH!</span>
                </h2>
                <p class="mt-4 text-gray-600">
                    <b>Ayo berkolaborasi menciptakan lingkungan bersih dan nyaman!</b><br>
                    Sibersih memudahkan Anda melaporkan tumpukan sampah, mengelola pembayaran, dan melihat jadwal angkut sampah.
                </p>
                <a href="{{ route('login') }}" class="inline-block mt-6 px-6 py-3 bg-green-700 text-white font-semibold rounded-lg hover:bg-green-800 transition">START</a>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('LandingPage.png') }}" alt="Hero Image" class="w-96 md:w-[420px]">
            </div>
        </div>
    </section>

    {{-- FEATURE SECTION --}}
    <section id="features" class="py-16 bg-white">
        <h3 class="text-center text-3xl font-bold text-gray-900 mb-12" data-aos="fade-up" data-aos-duration="1000">Fitur Kami</h3>
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-10 px-6">
            @foreach ([
                ['title'=>'SiBersih Report','desc'=>'Laporan sampah menumpuk dengan cepat, mudah dan langsung diterima pengurus RT.','img'=>'report.jpg'],
                ['title'=>'SiBersih Pay','desc'=>'Pembayaran iuran sampah secara online, aman, dan langsung terkonfirmasi.','img'=>'pembayaran.jpg'],
                ['title'=>'SiBersih Schedule','desc'=>'Lihat jadwal pengangkutan sampah dan rute langsung dari aplikasi.','img'=>'schedule.jpg'],
            ] as $feature)
            <div class="feature-card text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition duration-300" data-aos="zoom-in" data-aos-duration="1000">
                <img src="{{ asset($feature['img']) }}" class="w-40 md:w-44 mx-auto mb-4 rounded-lg">
                <h4 class="text-xl font-semibold text-green-800">{{ $feature['title'] }}</h4>
                <p class="mt-2 text-gray-600 text-sm">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </section>

    {{-- RT INFO SECTION --}}
    <section id="tentang" class="py-20 bg-gradient-to-b from-white to-green-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14" data-aos="fade-up" data-aos-duration="1000">
                <span class="inline-block px-4 py-1 bg-green-100 text-green-700 font-medium rounded-full text-sm mb-3">Informasi RT</span>
                <h2 class="text-4xl font-extrabold text-green-800 mb-4">RT 23 • Kelurahan Lubuk Sepuh</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Sistem ini digunakan khusus untuk mendukung layanan administrasi dan pengelolaan lingkungan 
                    di wilayah RT 23. Dibangun agar informasi lebih mudah diakses dan pelayanan lebih cepat.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach([
                    ['title'=>'Profil Wilayah','icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6','list'=>[['RT','23'],['Kelurahan/desa','Lubuk sepuh'],['Kecamatan','Pelawan'],['Kota/Kabupaten','Sarolangun']]],
                    ['title'=>'Kependudukan','icon'=>'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z','list'=>[['Ketua RT','Bapak Muhammad Nur'],['Jumlah Warga','149 Jiwa'],['Jumlah KK','28 KK']]],
                    ['title'=>'Sekretariat','icon'=>'M17 20h5V4H2v16h5m10 0V10l-4 4-4-4v10','list'=>[['Alamat','Jl. Melati No. 12'],['Jam Layanan','08.00 – 16.00'],['Kontak','0812-xxxx-xxxx']]],
                ] as $card)
                <div class="rt-card p-8 bg-white rounded-2xl shadow-lg hover:shadow-xl hover:scale-105 transition duration-300 border border-green-100" data-aos="fade-up" data-aos-duration="1000">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="{{ $card['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-green-800">{{ $card['title'] }}</h3>
                    </div>
                    <ul class="text-gray-700 space-y-1">
                        @foreach ($card['list'] as $li)
                            <li><strong>{{ $li[0] }}:</strong> {{ $li[1] }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-3xl font-bold text-gray-900 text-center mb-12" data-aos="fade-up">Kontak Kami</h3>
            <div class="max-w-2xl mx-auto text-center space-y-4">
                <p class="text-gray-700" data-aos="fade-up">Jl. Melati No. 12, Lubuk Sepuh, Sarolangun</p>
                <p class="text-gray-700" data-aos="fade-up">Telepon: 0812-xxxx-xxxx</p>
                <p class="text-gray-700" data-aos="fade-up">Email: info@sibersih.id</p>
            </div>
        </div>
        
            <div class="text-center text-gray-500 mt-8 text-sm">
                &copy; {{ date('Y') }} SI-BERSIH. All rights reserved.
            </div>
    </section>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ once: true, offset: 100 });

        // Hamburger toggle
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('show');
            hamburger.classList.toggle('active');
        });

        // Shake effect for feature & RT cards
        document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll(".feature-card, .rt-card");
            cards.forEach(card => {
                card.addEventListener("click", () => {
                    card.classList.add("shake");
                    setTimeout(() => card.classList.remove("shake"), 300);
                });
            });
        });
    </script>
</body>
</html>
