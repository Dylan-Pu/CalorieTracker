{{-- resources/views/components/meal-table.blade.php --}}
@props(['mealNumber', 'foods', 'items' => collect()])

@php
    $totalCarbs = $items->sum(fn($i) => $i['qty'] * $i['carbs'] / 100);
    $totalProt  = $items->sum(fn($i) => $i['qty'] * $i['proteins'] / 100);
    $totalFats  = $items->sum(fn($i) => $i['qty'] * $i['fats'] / 100);
    $totalKcal  = $totalProt * 4 + $totalCarbs * 4 + $totalFats * 9;
@endphp

<div class="text-base md:text-lg">
    <table class="w-full text-white table-fixed">
        <thead>
            <tr class="bg-white/10">
                <th class="px-4 py-4 text-left w-5/12">Aliment</th>
                <th class="px-4 py-4 w-1/12">Qté</th>
                <th class="px-4 py-4 w-1/12">G</th>
                <th class="px-4 py-4 w-1/12">P</th>
                <th class="px-4 py-4 w-1/12">L</th>
                <th class="px-4 py-4 w-1/12">Kcal</th>
                <th class="px-4 py-4 w-1/12"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $item)
                <tr class="border-t border-white/10 hover:bg-white/5">
                    <td class="px-4 py-4 truncate">{{ $item['name'] }}</td>
                    <td class="px-4 py-4 text-center font-semibold">{{ $item['qty'] }}</td>
                    <td class="px-4 py-4 text-center" style="color: #fde047;">{{ round($item['qty'] * $item['carbs'] / 100, 1) }}</td>
                    <td class="px-4 py-4 text-center" style="color: #86efac;">{{ round($item['qty'] * $item['proteins'] / 100, 1) }}</td>
                    <td class="px-4 py-4 text-center" style="color: #fca5a5;">{{ round($item['qty'] * $item['fats'] / 100, 1) }}</td>
                    <td class="px-4 py-4 text-center font-bold text-xl">{{ round($item['qty'] * ($item['proteins']*4 + $item['carbs']*4 + $item['fats']*9) / 100) }}</td>
                    <td class="px-4 py-4 text-center">
                        <button type="button" onclick="this.closest('tr').remove()"
                                class="text-2xl text-red-400 hover:text-red-300">✕</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-12 text-white/50 text-lg">
                        Aucun aliment ajouté
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-white/10 text-lg md:text-xl font-black">
            <tr>
                <td colspan="2" class="px-4 py-5 text-right">Total Repas {{ $mealNumber }}</td>
                <td class="text-center" style="color: #fde047;">{{ round($totalCarbs, 1) }}</td>
                <td class="text-center" style="color: #86efac;">{{ round($totalProt, 1) }}</td>
                <td class="text-center" style="color: #fca5a5;">{{ round($totalFats, 1) }}</td>
                <td class="text-center text-2xl">{{ round($totalKcal) }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- Ajout rapide – plus large aussi -->
    <div class="flex flex-wrap gap-4 mt-6 justify-center items-center">
        <select name="meals[{{ $mealNumber }}][food_id]" 
                class="px-6 py-4 rounded-xl bg-white/20 border border-white/30 text-white text-lg min-w-64" required>
            <option value="">Choisir un aliment...</option>
            @foreach($foods as $food)
                <option value="{{ $food->id }}">
                    {{ $food->name }} ({{ $food->carbs }}g G • {{ $food->proteins }}g P • {{ $food->fats }}g L)
                </option>
            @endforeach
        </select>
        <input type="number" name="meals[{{ $mealNumber }}][quantity]" placeholder="Quantité en g" min="1"
               class="w-32 px-6 py-4 rounded-xl bg-white/20 border border-white/30 text-white text-center text-xl" required>
        <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-black py-4 px-10 rounded-xl text-xl transition transform hover:scale-105">
            + Ajouter
        </button>
    </div>
</div>