<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CalorieTracker – Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900">

<div class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="w-full max-w-lg">
        <div class="text-center mb-12">
            <h1 class="text-6xl md:text-7xl font-black text-white mb-4">
                CalorieTracker
            </h1>
            <p class="text-2xl text-white/90">Crée ton compte gratuit en 10 secondes</p>
        </div>

        <div class="bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl p-10 border border-white/20">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Pseudo -->
                <div class="mb-6">
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="username"
                           placeholder="Ton pseudo (ex: DylanFit)"
                           class="w-full px-8 py-6 rounded-2xl bg-white/20 border border-white/30 placeholder-white/70 text-white text-xl focus:outline-none focus:border-white transition">
                    @error('name') <p class="text-red-400 text-sm mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                <!-- Email (facultatif) -->
                <div class="mb-6">
                    <input type="email" name="email" value="{{ old('email') }}"
                           placeholder="Ton email (facultatif)"
                           class="w-full px-8 py-6 rounded-2xl bg-white/20 border border-white/30 placeholder-white/60 text-white text-xl focus:outline-none focus:border-white transition">
                    @error('email') <p class="text-red-400 text-sm mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                <!-- Mot de passe + œil PARFAIT -->
                <div class="mb-6 relative">
                    <input type="password" name="password" id="pwd1" required autocomplete="new-password"
                           placeholder="Mot de passe (8 caractères min)"
                           class="w-full px-8 py-6 pr-16 rounded-2xl bg-white/20 border border-white/30 placeholder-white/70 text-white text-xl focus:outline-none focus:border-white transition">

                    <button type="button" onclick="togglePwd('pwd1')"
                            class="absolute inset-y-0 right-5 flex items-center text-white/60 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <!-- Œil fermé (visible par défaut) -->
                            <path class="eye-closed" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <path class="eye-closed" d="M15 9l-6 6M9 9l6 6"/>
                            <!-- Œil ouvert (caché au début) -->
                            <path class="eye-open hidden" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle class="eye-open hidden" cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                    @error('password') <p class="text-red-400 text-sm mt-2 text-center">{{ $message }}</p> @enderror
                </div>

                <!-- Confirmation + œil PARFAIT -->
                <div class="mb-10 relative">
                    <input type="password" name="password_confirmation" id="pwd2" required
                           placeholder="Confirme ton mot de passe"
                           class="w-full px-8 py-6 pr-16 rounded-2xl bg-white/20 border border-white/30 placeholder-white/70 text-white text-xl focus:outline-none focus:border-white transition">

                    <button type="button" onclick="togglePwd('pwd2')"
                            class="absolute inset-y-0 right-5 flex items-center text-white/60 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path class="eye-closed" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <path class="eye-closed" d="M15 9l-6 6M9 9l6 6"/>
                            <path class="eye-open hidden" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle class="eye-open hidden" cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-2xl py-7 rounded-2xl transition transform hover:scale-105 shadow-lg">
                    Créer mon compte gratuit
                </button>
            </form>

            <p class="text-center mt-10 text-white/80 text-lg">
                Déjà un compte ?
                <a href="{{ route('home') }}" class="text-white font-bold hover:underline">Se connecter</a>
            </p>
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