{{-- resources/views/meals/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Mes Repas')

@section('content')
<div class="py-16 min-h-screen">
    <div class="w-full px-4">

        <!-- Titre + phrase -->
        <div class="text-center mb-20">
            <h1 class="text-5xl md:text-7xl font-black text-white leading-tight mb-6">
                Mes Repas du Jour
            </h1>
            <div class="text-white/70 text-xl">
                Tes repas sont conservés tant que l’onglet reste ouvert<br>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-600/30 border border-green-500 text-green-300 px-8 py-4 rounded-2xl mb-8 text-center text-xl backdrop-blur-xl mx-auto max-w-4xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- LIGNE 1 : REPAS 1 + REPAS 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-32">
            <!-- REPAS 1 -->
            <div class="w-full">
                <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 flex flex-col h-[620px] overflow-hidden">
                    <h2 class="text-4xl font-black text-white p-6 text-center bg-white/5 flex-shrink-0">Repas 1</h2>
                    
                    <form method="POST" action="{{ route('meals.add') }}" class="p-5 bg-white/5 border-b border-white/10 flex-shrink-0">
                        @csrf
                        <input type="hidden" name="meal_number" value="1">
                        <x-meal-add-line meal-number="1" :foods="$foods" />
                    </form>
                    
                    <!-- Liste aliments scrollable -->
                    <div class="flex-1 overflow-y-auto">
                        <div class="px-6 pt-4">
                            <x-meal-table-only-body meal-number="1" :items="$meal1" />
                        </div>
                    </div>
                    
                    <!-- Total toujours visible -->
                    <div class="p-5 bg-white/10 border-t border-white/20 flex-shrink-0">
                        <x-meal-table-footer meal-number="1" :items="$meal1" />
                    </div>
                </div>
            </div>

            <!-- REPAS 2 -->
            <div class="w-full">
                <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 flex flex-col h-[620px] overflow-hidden">
                    <h2 class="text-4xl font-black text-white p-6 text-center bg-white/5 flex-shrink-0">Repas 2</h2>
                    <form method="POST" action="{{ route('meals.add') }}" class="p-5 bg-white/5 border-b border-white/10 flex-shrink-0">
                        @csrf
                        <input type="hidden" name="meal_number" value="2">
                        <x-meal-add-line meal-number="2" :foods="$foods" />
                    </form>
                    <div class="flex-1 overflow-y-auto">
                        <div class="px-6 pt-4">
                            <x-meal-table-only-body meal-number="2" :items="$meal2" />
                        </div>
                    </div>
                    <div class="p-5 bg-white/10 border-t border-white/20 flex-shrink-0">
                        <x-meal-table-footer meal-number="2" :items="$meal2" />
                    </div>
                </div>
            </div>
        </div>

        <!-- LIGNE 2 : TOTAL + REPAS 3 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- TOTAL JOURNÉE -->
            <div class="w-full">
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-3xl shadow-2xl p-8 md:p-12">
                    <div class="grid grid-cols-4 gap-4 md:gap-8 text-center">
                        <div>
                            <div class="text-white/80 text-sm md:text-lg mb-1">Glucides</div>
                            <div class="text-5xl md:text-7xl font-black text-yellow-400">{{ round($totalCarbs, 1) }}g</div>
                        </div>
                        <div>
                            <div class="text-white/80 text-sm md:text-lg mb-1">Protéines</div>
                            <div class="text-5xl md:text-7xl font-black text-green-400">{{ round($totalProteins, 1) }}g</div>
                        </div>
                        <div>
                            <div class="text-white/80 text-sm md:text-lg mb-1">Lipides</div>
                            <div class="text-5xl md:text-7xl font-black text-red-400">{{ round($totalFats, 1) }}g</div>
                        </div>
                        <div>
                            <div class="text-white/80 text-sm md:text-lg mb-1">Calories</div>
                            <div class="text-6xl md:text-8xl font-black text-white">{{ round($totalCalories) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REPAS 3 -->
            <div class="w-full">
                <div class="bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/20 flex flex-col h-[620px] overflow-hidden">
                    <h2 class="text-4xl font-black text-white p-6 text-center bg-white/5 flex-shrink-0">Repas 3</h2>
                    <form method="POST" action="{{ route('meals.add') }}" class="p-5 bg-white/5 border-b border-white/10 flex-shrink-0">
                        @csrf
                        <input type="hidden" name="meal_number" value="3">
                        <x-meal-add-line meal-number="3" :foods="$foods" />
                    </form>
                    <div class="flex-1 overflow-y-auto">
                        <div class="px-6 pt-4">
                            <x-meal-table-only-body meal-number="3" :items="$meal3" />
                        </div>
                    </div>
                    <div class="p-5 bg-white/10 border-t border-white/20 flex-shrink-0">
                        <x-meal-table-footer meal-number="3" :items="$meal3" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection