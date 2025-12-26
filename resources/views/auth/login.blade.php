<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - boysonthewheels</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Chakra+Petch:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        sport: ['"Chakra Petch"', 'sans-serif'],
                    },
                    colors: {
                        botw: {
                            blue: '#004e92',
                            red: '#d92027',
                            dark: '#1a1a1a',
                            darker: '#121212',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-botw-dark text-gray-200 min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-botw-blue via-botw-red to-botw-blue"></div>
    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-botw-blue/20 rounded-full blur-3xl"></div>
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-botw-red/10 rounded-full blur-3xl"></div>

    <div class="w-full max-w-md px-6 z-10">

        <div class="text-center mb-8">
            <a href="/" class="inline-block group">
                <img src="{{ asset('assets/logo.png') }}" alt="BOTW Logo" class="h-20 mx-auto drop-shadow-2xl group-hover:scale-105 transition duration-300">
            </a>
            <h2 class="mt-4 text-2xl font-bold font-sport text-white tracking-wider">ADMIN ACCESS</h2>
            <p class="text-sm text-gray-500">Masuk untuk mengelola katalog mobil.</p>
        </div>

        <div class="bg-gray-800/80 backdrop-blur-lg border border-gray-700 p-8 rounded-2xl shadow-2xl relative">

            @if ($errors->any())
            <div class="mb-4 p-3 bg-red-900/30 border border-red-500/50 rounded text-red-300 text-sm flex items-start gap-2">
                <i class="fas fa-exclamation-circle mt-0.5"></i>
                <div>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-5">
                    <label for="email" class="block text-xs font-bold text-gray-400 uppercase mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full bg-gray-900 border border-gray-600 text-white rounded-lg py-3 pl-10 focus:border-botw-red focus:ring-1 focus:ring-botw-red focus:outline-none transition placeholder-gray-600"
                            placeholder="admin@boysonthewheels.com">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-xs font-bold text-gray-400 uppercase mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input id="password" type="password" name="password" required
                            class="w-full bg-gray-900 border border-gray-600 text-white rounded-lg py-3 pl-10 focus:border-botw-red focus:ring-1 focus:ring-botw-red focus:outline-none transition placeholder-gray-600"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between mb-6 text-sm">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-600 bg-gray-900 text-botw-red shadow-sm focus:ring-botw-red focus:ring-offset-gray-800">
                        <span class="ml-2 text-gray-400 hover:text-gray-300">Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-botw-red text-white font-bold font-sport tracking-wide py-3.5 rounded-lg shadow-lg shadow-red-900/50 hover:bg-red-700 transition transform hover:-translate-y-1">
                    LOGIN <i class="fas fa-sign-in-alt ml-2"></i>
                </button>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-xs text-gray-600 hover:text-gray-400 flex items-center justify-center gap-2 transition">
                <i class="fas fa-long-arrow-alt-left"></i> Kembali ke Website
            </a>
        </div>
    </div>
</body>

</html>