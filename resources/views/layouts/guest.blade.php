<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CalorieTracker – @yield('title')</title>
    <meta name="description" content="Calculateur de calories précis et suivi nutritionnel avancé">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full min-h-screen bg-gradient-to-br from-indigo-950 via-purple-950 to-pink-950 text-white antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center px-6 py-12">
        
        <!-- Logo -->
        <div class="mb-12 text-center">
            <h1 class="text-6xl font-black tracking-tighter bg-gradient-to-r from-pink-500 to-purple-500 bg-clip-text text-transparent">
                CalorieTracker
            </h1>
            <p class="mt-4 text-white/60 text-lg">Maîtrise ta nutrition. Atteins tes objectifs.</p>
        </div>

        <!-- Card principale (login / register) -->
        <div class="w-full max-w-md">
            <div class="bg-black/40 backdrop-blur-2xl rounded-3xl border border-white/20 shadow-2xl p-8">
                @yield('content')
            </div>

            <!-- Petit lien discret en bas -->
            <div class="mt-8 text-center text