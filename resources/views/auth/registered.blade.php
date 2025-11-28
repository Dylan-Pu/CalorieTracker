<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Compte créé ! – CalorieTracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900">

<div class="min-h-screen flex items-center justify-center px-6 py-12">
    <div class="max-w-md w-full text-center">
        <div class="mb-12">
            <div class="w-32 h-32 mx-auto mb-8 bg-green-500/20 rounded-full flex items-center justify-center">
                <svg class="w-20 h-20 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl font-black text-white mb-4">
                Bravo {{ auth()->user()->name }} !
            </h1>
            <p class="text-2xl text-white/90">
                Ton compte est prêt
            </p>
        </div>

        <div class="bg-white/10 backdrop-blur-2xl rounded-3xl shadow-2xl p-10 border border-white/20 space-y-8">
            <p class="text-xl text-white/90">
                Tu peux maintenant calculer tes calories et macros de départ.
            </p>

            <a href="{{ route('calculator') }}"
               class="block w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-2xl py-7 rounded-2xl transition transform hover:scale-105 shadow-lg">
                Aller au calculateur
            </a>

            <p class="text-white/70">
                Ou retourne à la <a href="/" class="underline hover:text-white">page d’accueil</a>
            </p>
        </div>
    </div>
</div>

</body>
</html>