{{-- resources/views/components/meal-table-only-body.blade.php --}}
@props(['mealNumber', 'items' => collect()])

<div class="w-full">
    <table class="w-full text-white table-fixed">
        <thead>
            <tr class="bg-white/10 text-sm md:text-base">
                <th class="px-4 py-3 text-left w-5/12">Aliment</th>
                <th class="px-4 py-3 w-1/12">Qté</th>
                <th class="px-4 py-3 w-1/12">G</th>
                <th class="px-4 py-3 w-1/12">P</th>
                <th class="px-4 py-3 w-1/12">L</th>
                <th class="px-4 py-3 w-1/12">Kcal</th>
                <th class="px-4 py-3 w-1/12"></th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($items as $index => $item)
                <tr class="border-t border-white/10 hover:bg-white/5">
                    <td class="px-4 py-3 truncate">{{ $item['name'] }}</td>
                    <td class="px-4 py-3 text-center font-semibold">{{ $item['qty'] }}</td>
                    <td class="px-4 py-3 text-center" style="color: #fde047;">{{ round($item['qty'] * $item['carbs'] / 100, 1) }}</td>
                    <td class="px-4 py-3 text-center" style="color: #86efac;">{{ round($item['qty'] * $item['proteins'] / 100, 1) }}</td>
                    <td class="px-4 py-3 text-center" style="color: #fca5a5;">{{ round($item['qty'] * $item['fats'] / 100, 1) }}</td>
                    <td class="px-4 py-3 text-center font-bold">{{ round($item['qty'] * ($item['proteins']*4 + $item['carbs']*4 + $item['fats']*9) / 100) }}</td>
                    <td class="px-4 py-3 text-center">
                        <form action="{{ route('meals.remove') }}" method="POST" style="display:inline">
                            @csrf
                            <input type="hidden" name="meal_number" value="{{ $mealNumber }}">
                            <input type="hidden" name="index" value="{{ $loop->index }}">
                            <button type="submit" class="text-red-400 hover:text-red-300 text-2xl">✕</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-12 text-white/50">Aucun aliment ajouté</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>