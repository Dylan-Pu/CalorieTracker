{{-- resources/views/components/meal-add-line.blade.php --}}
@props(['mealNumber', 'foods'])

<div class="flex flex-wrap gap-3 justify-center items-center">
    <!-- Select avec flèche blanche personnalisée -->
    <div class="relative">
        <select name="meals[{{ $mealNumber }}][food_id]" 
                class="px-6 py-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-purple-400 transition min-w-72 text-lg appearance-none pr-12"
                required>
            <option value="" class="bg-gray-900">Choisir un aliment...</option>
            @foreach($foods as $food)
                <option value="{{ $food->id }}" class="bg-gray-900">
                    {{ $food->name }} ({{ $food->carbs }}g G • {{ $food->proteins }}g P • {{ $food->fats }}g L)
                </option>
            @endforeach
        </select>
        
        <!-- Flèche blanche personnalisée -->
        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>

    <!-- Input quantité -->
    <input type="number" 
           name="meals[{{ $mealNumber }}][quantity]" 
           placeholder="Quantité (g)" 
           min="1" 
           class="w-32 px-6 py-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/20 text-white placeholder-white/50 text-center text-xl focus:outline-none focus:border-purple-400 transition"
           required>

    <!-- Bouton + Ajouter -->
    <button type="submit" 
            class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black py-4 px-10 rounded-2xl transition transform hover:scale-105 shadow-lg text-lg">
        + Ajouter
    </button>
</div>