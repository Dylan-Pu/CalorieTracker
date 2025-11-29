<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalorieTracker – Ta sèche sur mesure</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900">

<div class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="max-w-7xl w-full grid lg:grid-cols-2 gap-12 items-center">

        <!-- GAUCHE : Texte -->
        <div class="text-white space-y-8">
            <h1 class="text-5xl md:text-7xl font-black leading-tight">
                Prends le contrôle<br>de ta sèche
            </h1>
            <p class="text-xl md:text-2xl text-white/90">
                Calcul précis · Macros automatiques · Suivi illimité
            </p>
            <div class="space-y-4 text-lg text-white/80">
                 <p>• Tous les calculs sont trouvables aisements sur internet</p>
                
            </div>
        </div>

        <!-- DROITE : Portail de connexion -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-2xl p-10">

            @auth
                <div class="text-center">
                    <a href="{{ route('calculator') }}" class="block w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold text-xl py-6 rounded-2xl hover:scale-105 transition">
                        Aller au calculateur
                    </a>
                </div>
            @else
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Pseudo (utilise name) -->
                    <div>
                        <input type="text" name="name" placeholder="Ton pseudo" required autofocus autocomplete="username"
                               class="w-full px-6 py-5 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 text-lg">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Mot de passe + œil -->
                    <div class="relative">
                        <input type="password" name="password" id="login-pwd" required autocomplete="current-password"
                               placeholder="Ton mot de passe"
                               class="w-full px-6 py-5 pr-16 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-indigo-500/50 text-lg">

                        <button type="button" onclick="togglePwd('login-pwd')"
                                class="absolute inset-y-0 right-4 flex items-center text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path class="eye-closed" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <path class="eye-closed" d="M15 9l-6 6M9 9l6 6"/>
                                <path class="eye-open hidden" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle class="eye-open hidden" cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                        @error('password') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-xl py-5 rounded-2xl transition transform hover:scale-105 shadow-lg">
                        Se connecter
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-600 dark:text-gray-400">Pas de compte ?</p>
                    <a href="{{ route('register') }}" class="block mt-4 w-full border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 dark:border-indigo-500 hover:bg-indigo-600 hover:text-white font-bold py-4 rounded-2xl transition">
                        Créer un compte gratuit
                    </a>
                </div>
            @endauth

            @if(session('status'))
                <p class="mt-6 text-center text-green-600 font-bold">{{ session('status') }}</p>
            @endif
        </div>
    </div>
</div>

<script>
function togglePwd(id) {
    const input = document.getElementById(id);
    const svg = input.parentElement.querySelector('svg');
    const closed = svg.querySelectorAll('.eye-closed');
    const open = svg.querySelectorAll('.eye-open');

    if (input.type === 'password') {
        input.type = 'text';
        closed.forEach(el => el.classList.add('hidden'));
        open.forEach(el => el.classList.remove('hidden'));
    } else {
        input.type = 'password';
        closed.forEach(el => el.classList.remove('hidden'));
        open.forEach(el => el.classList.add('hidden'));
    }
}
</script>

</body>
</html>
