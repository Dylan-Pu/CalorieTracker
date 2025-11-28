<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class MealController extends Controller
{
    public function index()
    {
        $foods = auth()->user()->foods()->orderBy('name')->get();

        // On récupère les repas depuis la session (ou vide si rien)
        $meals = session('meals', [
            1 => collect(),
            2 => collect(),
            3 => collect(),
        ]);

        $meal1 = $meals[1] ?? collect();
        $meal2 = $meals[2] ?? collect();
        $meal3 = $meals[3] ?? collect();

        // Calcul des totaux
        $totalProteins = $meal1->sum(fn($i) => $i['qty'] * $i['proteins'] / 100)
                        + $meal2->sum(fn($i) => $i['qty'] * $i['proteins'] / 100)
                        + $meal3->sum(fn($i) => $i['qty'] * $i['proteins'] / 100);

        $totalCarbs = $meal1->sum(fn($i) => $i['qty'] * $i['carbs'] / 100)
                    + $meal2->sum(fn($i) => $i['qty'] * $i['carbs'] / 100)
                    + $meal3->sum(fn($i) => $i['qty'] * $i['carbs'] / 100);

        $totalFats = $meal1->sum(fn($i) => $i['qty'] * $i['fats'] / 100)
                   + $meal2->sum(fn($i) => $i['qty'] * $i['fats'] / 100)
                   + $meal3->sum(fn($i) => $i['qty'] * $i['fats'] / 100);

        $totalCalories = round($totalProteins * 4 + $totalCarbs * 4 + $totalFats * 9);

        return view('meals.index', compact(
            'foods',
            'meal1',
            'meal2',
            'meal3',
            'totalProteins',
            'totalCarbs',
            'totalFats',
            'totalCalories'
        ));
    }

    public function remove(Request $request)
{
    $mealNumber = $request->meal_number;
    $index = $request->index;

    $meals = session('meals', [
        1 => collect(),
        2 => collect(),
        3 => collect(),
    ]);

    if (isset($meals[$mealNumber])) {
        $meals[$mealNumber]->splice($index, 1);
        session(['meals' => $meals]);
    }

    return back();
}

    public function add(Request $request)
    {
        $request->validate([
            'meal_number' => 'required|in:1,2,3',
            'meals.*.food_id' => 'required|exists:foods,id',
            'meals.*.quantity' => 'required|numeric|min:1',
        ]);

        $mealNumber = $request->meal_number;
        $foodId = $request->input("meals.{$mealNumber}.food_id");
        $quantity = $request->input("meals.{$mealNumber}.quantity");

        $food = Food::findOrFail($foodId);

        // On récupère les repas actuels en session
        $meals = session('meals', [
            1 => collect(),
            2 => collect(),
            3 => collect(),
        ]);

        // On ajoute l'aliment au bon repas
        $meals[$mealNumber]->push([
            'name' => $food->name,
            'qty' => $quantity,
            'proteins' => $food->proteins,
            'fats' => $food->fats,
            'carbs' => $food->carbs,
        ]);

        // On remet en session
        session(['meals' => $meals]);

        return back()->with('success', "Aliment ajouté au Repas {$mealNumber} !");
    }

    // Optionnel : vider les repas (utile plus tard)
    public function clear()
    {
        session()->forget('meals');
        return back()->with('success', 'Repas vidés !');
    }
}