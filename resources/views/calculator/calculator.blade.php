@extends('layouts.app')

@section('title', 'Calculateur')

@section('content')
<div class="py-16 min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
        <h1 class="text-5xl md:text-7xl font-black text-center mb-16 text-white leading-tight">
            Calcule tes calories<br>et macronutriments de départ
        </h1>

        @if(session('error'))
            <p class="text-red-500 text-center mb-8 font-bold">{{ session('error') }}</p>
        @endif

        <form method="POST" action="{{ route('calculator.store') }}" class="space-y-10 bg-white/10 backdrop-blur-2xl rounded-3xl p-10 border border-white/20">
            @csrf

            <!-- Poids + % Graisse -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-2xl font-bold text-white mb-3">Ton poids (kg)</label>
                    <input type="number" name="weight" value="{{ old('weight') }}" required step="0.1"
                           class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-xl placeholder-white/60 focus:outline-none focus:border-white transition">
                    @error('weight') <p class="text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-2xl font-bold text-white mb-3">% de graisse corporelle</label>
                    <input type="number" name="bodyfat" value="{{ old('bodyfat') }}" required step="0.1"
                           class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-xl placeholder-white/60 focus:outline-none focus:border-white transition">
                    @error('bodyfat') <p class="text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Activité -->
            <div>
                <label class="block text-2xl font-bold text-white mb-6">Niveau d’activité</label>
                <div class="space-y-4">
                    @foreach([
                        ['value' => 1.2,   'label' => 'Sédentaire (bureau, peu de sport)'],
                        ['value' => 1.375, 'label' => 'Légère (1-3 séances/semaine)'],
                        ['value' => 1.55,  'label' => 'Modérée (3-5 séances/semaine)'],
                        ['value' => 1.725, 'label' => 'Élevée (6-7 séances + cardio)'],
                        ['value' => 1.9,   'label' => 'Très élevée (athlète pro)'],
                    ] as $activity)
                        <label class="flex items-center space-x-4 text-xl text-white/90 cursor-pointer">
                            <input type="radio" name="activity" value="{{ $activity['value'] }}"
                                   {{ old('activity') == $activity['value'] ? 'checked' : '' }} required
                                   class="w-6 h-6 text-indigo-400">
                            <span>{{ $activity['label'] }}</span>
                        </label>
                    @endforeach
                    @error('activity') <p class="text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <!-- Déficit -->
            <div>
                <label class="block text-2xl font-bold text-white mb-3">Déficit calorique (%)</label>
                <input type="number" name="deficit" value="{{ old('deficit', 20) }}" min="5" max="25" required
                       class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-3xl text-center focus:outline-none focus:border-white transition">
                <p class="text-white/70 text-center mt-3">Entre 5 % et 25 % (20 % recommandé)</p>
                @error('deficit') <p class="text-red-500 mt-2">{{ $message }}</p> @enderror
            </div>

            <div class="text-center pt-6">
                <button type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-3xl py-8 px-20 rounded-3xl transition transform hover:scale-105 shadow-2xl">
                    CALCULER MES MACROS
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
                        