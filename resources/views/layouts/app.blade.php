<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'BoysOnTheWheels - Mobil Impian Anda'))</title>
    @yield('seo')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Chakra+Petch:wght@600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/logo.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        sport: ['"Chakra Petch"', 'sans-serif'], // Font khusus untuk judul/aksen
                    },
                    colors: {
                        // Palet warna diambil dari logo
                        botw: {
                            blue: '#004e92', // Biru tua dari "WHEELS" kiri
                            red: '#d92027', // Merah terang dari "WHEELS" kanan & "ON THE"
                            dark: '#1a1a1a', // Latar belakang utama (abu gelap)
                            darker: '#121212', // Latar belakang navbar/footer
                            accent: '#ffffff', // Putih untuk teks utama
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #1a1a1a;
            color: #f3f4f6;
        }

        h1,
        h2,
        h3,
        h4,
        .brand-font {
            font-family: 'Chakra Petch', sans-serif;
        }

        /* Custom scrollbar untuk tema gelap */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #121212;
        }

        ::-webkit-scrollbar-thumb {
            background: #d92027;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #004e92;
        }
    </style>
</head>

<body class="antialiased flex flex-col min-h-screen bg-botw-dark text-gray-100">

    <header x-data="{ mobileMenuOpen: false }" class="bg-botw-darker shadow-lg border-b border-gray-800 sticky top-0 z-40">
        <div class="bg-gradient-to-r from-botw-blue to-botw-darker text-white text-xs py-2">
            <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-2 md:gap-0">
                <span class="brand-font tracking-wider font-semibold"><i class="fas fa-star text-botw-red mr-1"></i> SPESIALIS MOBIL MEWAH</span>
                <span class="font-medium">Membantu Anda Mendapatkan Mobil Impian • Sell • Buy • Good Quality Used Car</span>
            </div>
        </div>

        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center group">
                    <img src="{{ asset('assets/logo.png') }}" alt="boysonthewheels Logo" class="h-12 md:h-14 w-auto object-contain transition transform group-hover:scale-105 duration-300">
                </a>

                <div class="hidden md:flex items-center gap-8 font-medium text-sm">
                    <a href="{{ url('/') }}" class="text-gray-300 hover:text-botw-red transition {{ request()->is('/') ? 'text-white font-bold' : '' }}">Katalog BoysOnTheWheels</a>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    @auth
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard.index') }}" class="text-sm font-bold text-botw-blue hover:text-white transition">
                            <i class="fas fa-user-shield mr-1"></i> Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-bold text-gray-400 hover:text-botw-red transition">
                                Logout <i class="fas fa-sign-out-alt ml-1"></i>
                            </button>
                        </form>
                    </div>
                    @else
                    @php
                    // Nomor Admin (Sesuai data sebelumnya)
                    $adminWa = '6281181252550';

                    // Pesan Profesional (Menggunakan \n untuk baris baru)
                    $message = "Halo Admin boysonthewheels,\n\nSaya berniat menawarkan unit mobil saya untuk dijual (Sell/Trade-in). Berikut detail singkatnya:\n\n• Merek & Tipe: \n• Tahun: \n• Transmisi: \n• Lokasi Unit: \n\nMohon info untuk prosedur inspeksi dan penawarannya. Terima kasih.";

                    // Encode pesan agar bisa dibaca browser
                    $waLink = "https://wa.me/{$adminWa}?text=" . urlencode($message);
                    @endphp

                    <a href="{{ $waLink }}" target="_blank" class="bg-botw-red text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-red-700 transition shadow-lg shadow-red-900/30 brand-font tracking-wider flex items-center gap-2">
                        <i class="fab fa-whatsapp text-lg"></i> JUAL MOBIL
                    </a>
                    @endauth
                </div>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-300 text-2xl focus:outline-none hover:text-botw-red transition">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden mt-4 border-t border-gray-800 pt-4 space-y-4 pb-4 bg-botw-darker px-2">
                <a href="{{ url('/') }}" class="block text-gray-200 hover:text-botw-red font-medium">Katalog BoysOnTheWheels</a>
                <div class="border-t border-gray-800 pt-4 flex flex-col gap-3">
                    <a href="" class="text-center w-full border border-botw-blue text-botw-blue py-2 rounded-lg font-bold hover:bg-botw-blue hover:text-white transition">Masuk</a>
                    <a href="" class="text-center w-full bg-botw-red text-white py-2 rounded-lg font-bold brand-font hover:bg-red-700 transition">Jual Mobil Anda</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow bg-botw-dark">
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="bg-botw-blue/90 backdrop-blur-sm text-white text-center py-3 px-4 relative border-b border-blue-400">
            <span class="font-medium brand-font tracking-wide"><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
            <button @click="show = false" class="absolute right-4 top-3 text-blue-200 hover:text-white"><i class="fas fa-times"></i></button>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-botw-darker text-gray-400 pt-16 pb-8 mt-12 border-t-4 border-botw-red relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-botw-blue via-botw-red to-botw-blue opacity-50"></div>

        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
            <div class="md:col-span-2">
                <h3 class="text-white text-3xl font-bold mb-4 brand-font italic">
                    <span class="text-white">BOYS</span><span class="text-botw-red mx-1 text-xl bg-white/10 px-1 rounded">ON THE</span><span class="text-botw-blue">WHEELS</span>
                </h3>
                <p class="text-lg text-gray-200 font-medium mb-2">“Membantu Anda Mendapatkan Mobil Impian”</p>
                <p class="text-sm leading-relaxed mb-6 text-gray-500">
                    Spesialis Mobil Mewah terpercaya di Jakarta Selatan. Kami melayani Jual, Beli, dan menyediakan Used Car berkualitas tinggi dengan standar inspeksi ketat.
                </p>
                <div class="flex gap-4">
                    <a href="https://instagram.com/boysonthewheels" target="_blank" class="group w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 transition duration-300">
                        <i class="fab fa-instagram text-white group-hover:scale-110 transition"></i>
                    </a>
                    <a href="https://instagram.com/boys.katalog" target="_blank" class="group flex items-center gap-2 px-4 h-10 rounded-lg bg-gray-800 hover:bg-botw-blue transition duration-300 text-sm font-bold text-white">
                        <i class="fab fa-instagram"></i> Katalog: @boys.katalog
                    </a>
                </div>
            </div>

            <div>
                <img src="{{ asset('assets/boys_auto_care.png') }}" alt="Boys Auto Care" class="w-32 mb-4 hover:opacity-90 transition">

                <h5 class="text-white font-bold text-sm mb-1 tracking-wide">
                    Detailing | Coating | Protection ✨
                </h5>
                <p class="text-xs text-gray-500 mb-5 leading-relaxed">
                    "Wherever you Go, Must Be Clean"<br>
                    📍 Bintaro, Jakarta Selatan
                </p>

                <div class="flex gap-3">
                    <a href="https://instagram.com/boysautocare" target="_blank" class="group w-10 h-10 rounded-lg bg-gray-800 flex items-center justify-center hover:bg-gradient-to-br hover:from-purple-600 hover:to-pink-500 transition duration-300">
                        <i class="fab fa-instagram text-white group-hover:scale-110 transition"></i>
                    </a>

                    @php
                    $bac_message = "Halo Boys Auto Care, saya lihat dari website BoysOnTheWheels. Mau tanya info detailing...";
                    $bac_link = "https://wa.me/628132105853?text=" . urlencode($bac_message);
                    @endphp

                    <a href="{{ $bac_link }}" target="_blank" class="flex-1 bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white w-50 h-10 px-4 rounded-lg flex items-center gap-3 transition shadow-lg hover:border-green-500 group">
                        <i class="fab fa-whatsapp text-xl text-green-500 group-hover:scale-110 transition"></i>
                        <span class="font-bold text-sm">Whatsapp</span>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-6 brand-font text-lg tracking-wider">HUBUNGI KAMI</h4>
                <ul class="space-y-4 text-sm">

                    <li class="flex items-start gap-4 group">
                        <a href="https://maps.app.goo.gl/vKgk8qYu8ZPPSQti7" target="_blank" class="bg-gray-800 p-2 rounded text-botw-red group-hover:bg-botw-red group-hover:text-white transition">
                            <i class="fas fa-map-marker-alt"></i>
                        </a>
                        <div>
                            <span class="block font-bold text-white">Lokasi Showroom</span>
                            <a href="https://maps.app.goo.gl/vKgk8qYu8ZPPSQti7" target="_blank" class="text-gray-500 hover:text-botw-red hover:underline transition">
                                South Jakarta (Jakarta Selatan)
                            </a>
                        </div>
                    </li>

                    <li class="flex items-center gap-4 group">
                        <div class="bg-gray-800 p-2 rounded text-botw-red group-hover:bg-botw-red group-hover:text-white transition">
                            <i class="fab fa-whatsapp font-bold"></i>
                        </div>
                        <div>
                            <span class="block font-bold text-white">WhatsApp Business</span>
                            <a href="https://wa.me/6281181252550" target="_blank" class="hover:text-botw-red transition font-medium">
                                +62 811-8125-2550
                            </a>
                        </div>
                    </li>

                    <li class="mt-6">
                        <a href="https://instagram.com/boys.katalog" target="_blank" class="flex items-center gap-4 group hover:text-botw-red transition">
                            <div class="bg-gray-800 p-2 rounded text-botw-red group-hover:bg-botw-red group-hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <span class="font-medium">@boys.katalog</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        @php
        // Mengambil data testimoni
        $testimonials = \App\Models\Testimonial::latest()->take(8)->get();
        @endphp

        @if($testimonials->count() > 0)
        <div class="border-t border-gray-800 bg-gray-900 pt-12 pb-20 overflow-hidden relative">
            <div class="container mx-auto px-4 mb-10 text-center">
                <span class="text-botw-red font-bold tracking-widest text-xs uppercase mb-2 block">Customer Stories</span>
                <h3 class="text-white font-bold brand-font text-2xl">Testimonial</h3>
            </div>

            <div class="absolute top-0 left-0 w-16 md:w-40 h-full bg-gradient-to-r from-gray-900 to-transparent z-20 pointer-events-none"></div>
            <div class="absolute top-0 right-0 w-16 md:w-40 h-full bg-gradient-to-l from-gray-900 to-transparent z-20 pointer-events-none"></div>

            <div class="slider-container flex w-full">
                <div class="slider-track flex items-start gap-6 pl-4 md:pl-20">

                    @for ($i = 0; $i < 2; $i++)
                        @foreach($testimonials as $testi)
                        <div class="w-[350px] flex-shrink-0 bg-gray-800 rounded-xl overflow-hidden border border-gray-700 relative group hover:border-botw-red transition duration-500 shadow-xl">

                        <div class="relative h-56 w-full overflow-hidden">
                            <img src="{{ asset('storage/' . $testi->image_path) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700 ease-in-out" alt="Testimoni {{ $testi->buyer_name }}">

                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent p-5 pt-10">
                                <h4 class="text-white font-bold text-xl leading-tight mb-1 brand-font">{{ $testi->buyer_name }}</h4>
                                <div class="flex items-center gap-2">
                                    <span class="bg-botw-red text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Purchased</span>
                                    <span class="text-gray-300 font-bold text-xs uppercase tracking-wide truncate">{{ $testi->car_purchased }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-5 relative bg-gray-800">
                            <div class="flex text-yellow-500 text-sm mb-3 gap-1">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>

                            <p class="text-gray-300 text-sm leading-relaxed italic relative z-10 line-clamp-3">
                                "{{ $testi->message }}"
                            </p>

                            <div class="absolute bottom-4 right-4 text-gray-700 opacity-20 group-hover:opacity-50 transition">
                                <i class="fas fa-quote-right text-3xl"></i>
                            </div>
                        </div>
                </div>
                @endforeach
                @endfor

            </div>
        </div>
        </div>

        <style>
            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            .slider-track {
                /* Durasi diperlambat jadi 60s agar gerakan lebih smooth untuk gambar besar */
                animation: scroll 60s linear infinite;
                width: max-content;
            }

            .slider-container:hover .slider-track {
                animation-play-state: paused;
            }

            /* Utility class untuk memotong teks panjang */
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
        @endif

        <div class="container mx-auto px-4 border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} <span class="brand-font text-gray-300">boysonthewheels</span>. Premium Luxury Cars. All rights reserved.</p>
            <div class="flex gap-4 mt-2 md:mt-0">
                <a href="#" class="hover:text-botw-red">Privacy Policy</a>
                <a href="#" class="hover:text-botw-red">Terms of Service</a>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6281181252550?text=Halo%20boysonthewheels%2C%20saya%20tertarik%20dengan%20mobil%20mewah%20Anda." target="_blank" class="fixed bottom-6 right-6 z-50 group">
        <div class="relative">
            <div class="absolute bottom-full right-0 mb-3 hidden group-hover:block w-48">
                <div class="bg-white text-botw-dark text-sm py-2 px-4 rounded-lg shadow-xl font-bold text-right relative">
                    Hubungi Spesialis Kami!
                    <div class="absolute bottom-0 right-6 transform translate-y-1/2 rotate-45 w-3 h-3 bg-white"></div>
                </div>
            </div>
            <div class="bg-botw-red text-white p-4 rounded-full shadow-lg shadow-red-600/40 hover:bg-red-600 hover:scale-110 transition duration-300 flex items-center justify-center w-16 h-16 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <i class="fab fa-whatsapp text-4xl"></i>
            </div>
        </div>
    </a>

    @stack('scripts')
</body>

</html>