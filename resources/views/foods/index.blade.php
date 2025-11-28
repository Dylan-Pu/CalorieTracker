{{-- resources/views/foods/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Mes Aliments')

@section('content')
<div class="py-16 min-h-screen">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-black text-white leading-tight">
                Ajoute, édite et supprime tes aliments personnalisés
            </h1>
            <p class="text-white/70 text-xl mt-4">Par défaut les aliments seront mis au 100g </p>
        </div>

        @if(session('success'))
            <div class="bg-green-600/30 border border-green-500 text-green-300 px-8 py-4 rounded-2xl mb-8 text-center text-xl backdrop-blur-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bouton + Formulaire d'ajout/édition -->
        <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 p-10 mb-12">
            @if(!$editingFood)
                <div class="text-center">
                    <button onclick="document.getElementById('food-form').classList.remove('hidden')"
                            class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-2xl py-6 px-16 rounded-3xl transition transform hover:scale-105 shadow-2xl">
                        ➕ Ajouter un nouvel aliment
                    </button>
                </div>
            @endif

            <!-- Formulaire : ordre Glucides → Protéines → Lipides -->
            <div id="food-form" class="{{ $editingFood ? '' : 'hidden' }} mt-10">
                <h2 class="text-4xl font-black text-white text-center mb-8">
                    {{ $editingFood ? 'Éditer l\'aliment' : 'Nouvel aliment' }}
                </h2>

                <form action="{{ $editingFood ? route('foods.update', $editingFood) : route('foods.store') }}" method="POST" class="space-y-8">
                    @csrf
                    @if($editingFood) @method('PUT') @endif

                    <div>
                        <label class="block text-xl font-bold text-white mb-3">Nom de l'aliment</label>
                        <input type="text" name="name" value="{{ old('name', $editingFood?->name) }}" required
                               class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-xl focus:outline-none focus:border-white transition">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- 1. Glucides -->
                        <div>
                            <label class="block text-xl font-bold text-white mb-3">Glucides (g)</label>
                            <input type="number" step="0.1" name="carbs" value="{{ old('carbs', $editingFood?->carbs) }}" required
                                   class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-xl text-center focus:outline-none focus:border-white">
                        </div>
                        <!-- 2. Protéines -->
                        <div>
                            <label class="block text-xl font-bold text-white mb-3">Protéines (g)</label>
                            <input type="number" step="0.1" name="proteins" value="{{ old('proteins', $editingFood?->proteins) }}" required
                                   class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-xl text-center focus:outline-none focus:border-white">
                        </div>
                        <!-- 3. Lipides -->
                        <div>
                            <label class="block text-xl font-bold text-white mb-3">Lipides (g)</label>
                            <input type="number" step="0.1" name="fats" value="{{ old('fats', $editingFood?->fats) }}" required
                                   class="w-full px-6 py-5 rounded-2xl bg-white/20 border border-white/30 text-white text-xl text-center focus:outline-none focus:border-white">
                        </div>
                    </div>

                    <div class="flex justify-center gap-6">
                        <button type="submit"
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black text-2xl py-5 px-12 rounded-3xl transition transform hover:scale-105">
                            {{ $editingFood ? 'Mettre à jour' : 'Enregistrer' }}
                        </button>
                        <a href="{{ route('foods.index') }}"
                           class="bg-white/10 hover:bg-white/20 text-white font-bold text-2xl py-5 px-12 rounded-3xl transition">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau : même ordre Glucides → Protéines → Lipides -->
        @if($foods->isEmpty())
            <div class="text-center py-20 bg-white/5 rounded-3xl">
                <p class="text-white/60 text-3xl">Aucun aliment enregistré pour le moment</p>
                <p class="text-white/40 mt-4">Clique sur le bouton ci-dessus pour commencer !</p>
            </div>
        @else
            <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-white">
                        <thead>
                            <tr class="bg-white/5">
                                <th class="px-8 py-6 text-left text-xl font-bold">Aliment</th>
                                <th class="px-8 py-6 text-center text-xl font-bold">Glucides</th>
                                <th class="px-8 py-6 text-center text-xl font-bold">Protéines</th>
                                <th class="px-8 py-6 text-center text-xl font-bold">Lipides</th>
                                <th class="px-8 py-6 text-center text-xl font-bold">Kcal</th>
                                <th class="px-8 py-6 text-center text-xl font-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($foods as $food)
                                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                                    <td class="px-8 py-6 text-lg font-semibold">{{ $food->name }}</td>
                                    <td class="px-8 py-6 text-center">{{ $food->carbs }}</td>
                                    <td class="px-8 py-6 text-center">{{ $food->proteins }}</td>
                                    <td class="px-8 py-6 text-center">{{ $food->fats }}</td>
                                    <td class="px-8 py-6 text-center font-bold text-indigo-400">
                                        {{ $food->proteins * 4 + $food->fats * 9 + $food->carbs * 4 }}
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('foods.index') }}?edit={{ $food->id }}"
                                               class="bg-yellow-500/20 hover:bg-yellow-500/40 text-yellow-300 font-bold py-3 px-6 rounded-xl transition transform hover:scale-110">
                                                ✏️ Éditer
                                            </a>

                                            <form action="{{ route('foods.destroy', $food) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Supprimer {{ addslashes($food->name) }} définitivement ?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500/20 hover:bg-red-500/40 text-red-300 font-bold py-3 px-6 rounded-xl transition transform hover:scale-110">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    // Affiche automatiquement le formulaire en mode édition
    @if(request()->has('edit'))
        document.getElementById('food-form').classList.remove('hidden');
    @endif
</script>
@endsection
