@props(['mealNumber', 'items' => collect()])

@php
    $totalCarbs = $items->sum(fn($i) => $i['qty'] * $i['carbs'] / 100);
    $totalProt  = $items->sum(fn($i) => $i['qty'] * $i['proteins'] / 100);
    $totalFats  = $items->sum(fn($i) => $i['qty'] * $i['fats'] / 100);
    $totalKcal  = $totalProt * 4 + $totalCarbs * 4 + $totalFats * 9;
@endphp

<div class="text-center font-black text-lg md:text-xl">
    Total Repas {{ $mealNumber }} : 
    <span style="color: #fde047;">{{ round($totalCarbs, 1) }}g G</span> • 
    <span style="color: #86efac;">{{ round($totalProt, 1) }}g P</span> • 
    <span style="color: #fca5a5;">{{ round($totalFats, 1) }}g L</span> • 
    <span class="text-white">{{ round($totalKcal) }} kcal</span>
</div>