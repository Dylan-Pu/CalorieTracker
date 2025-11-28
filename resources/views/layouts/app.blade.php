<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') – CalorieTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full min-h-screen text-white antialiased">

    <!-- FOND GRADIENT INFINI (fixe, derrière tout) -->
    <div class="fixed inset-0 bg-gradient-to-br from-indigo-950 via-purple-950 to-pink-950 z-[-2]"></div>
    
    <!-- Fade doux en bas pour éviter la coupure brutale -->
    <div class="fixed inset-x-0 bottom-0 h-screen bg-gradient-to-t from-purple-950 via-purple-950/90 to-transparent pointer-events-none z-[-1]"></div>

    @auth
        <!-- Navbar fixe -->
        <nav class="fixed top-0 left-0 right-0 z-50 bg-black/40 backdrop-blur-2xl border-b border-white/10">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
                <div class="flex items-center space-x-10">
                    <a href="{{ route('calculator') }}" class="text-3xl font-black tracking-tighter bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
                        CalorieTracker
                    </a>
                    <div class="hidden md:flex items-center space-x-2">
                        <a href="{{ route('calculator') }}" class="px-6 py-3 rounded-2xl text-sm font-medium transition {{ request()->routeIs('calculator*') ? 'bg-white/20 text-white shadow-lg' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                            Calculateur
                        </a>
                        <a href="{{ route('meals.index') }}" class="px-6 py-3 rounded-2xl text-sm font-medium transition {{ request()->routeIs('meals.index*') ? 'bg-white/20 text-white shadow-lg' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                            Repas
                        </a>
                        <a href="{{ route('foods.index') }}" class="px-6 py-3 rounded-2xl text-sm font-medium transition {{ request()->routeIs('foods.index*') ? 'bg-white/20 text-white shadow-lg' : 'text-white/70 hover:text-white hover:bg-white/10' }}">
                            Aliment
                        </a>    
                    </div>
                </div>
                <div class="relative group">
                    <button class="flex items-center space-x-3 px-4 py-2 rounded-xl hover:bg-white/10 transition">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center font-bold text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span class="hidden lg:block font-medium">{{ auth()->user()->name }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-3 w-56 bg-black/60 backdrop-blur-2xl rounded-2xl border border-white/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 shadow-2xl">
                        <div class="py-2">
                            <form method="POST" action="{{ route('logout') }}" class="p-2">
                                @csrf
                                <button type="submit" class="w-full text-left px-6 py-4 text-red-400 hover:text-red-300 hover:bg-white/10 rounded-xl transition font-medium">
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenu principal (au-dessus du fond) -->
        <div class="pt-28 pb-10 relative z-10">
            @yield('content')
        </div>
    @else
        <div class="min-h-screen flex items-center justify-center relative z-10">
            @yield('content')
        </div>
    @endauth

    @livewireScripts
</body>
</html>