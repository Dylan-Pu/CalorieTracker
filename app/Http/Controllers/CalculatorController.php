<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    // Page du formulaire
    public function index()
    {
        return view('calculator.index');
    }

    // Traitement du calcul
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric|min:30|max:300',
            'bodyfat' => 'required|numeric|min:5|max:50',
            'activity' => 'required|numeric',
            'deficit' => 'required|numeric|min:5|max:30',
        ]);

        $weight = $request->weight;
        $bodyfat = $request->bodyfat;
        $activity = $request->activity;
        $deficit = $request->deficit / 100;

        // Formule Katch-McArdle
        $leanMass = $weight * (1 - $bodyfat / 100);
        $bmr = 370 + (21.6 * $leanMass);
        $tdee = $bmr * $activity;
        $calories = round($tdee * (1 - $deficit));

        // Répartition classique (tu peux ajuster comme tu veux)
        $proteins = round($leanMass * 2.2); // 2.2g par kg de masse maigre
        $fats = round($leanMass * 1);       // 1g par kg de masse maigre
        $carbs = round(($calories - ($proteins * 4 + $fats * 9)) / 4);

        $result = [
            'calories' => $calories,
            'proteins' => $proteins,
            'fats' => $fats,
            'carbs' => $carbs,
            'created_at' => now(),
        ];

        // On garde en session pour l'affichage
        session(['last_result' => $result]);

        return redirect()->route('calculator.result');
    }

    // Page résultat
    public function result()
{
    $result = session('last_result');

    // Si pas de résultat → on va direct au formulaire SANS boucle
    if (!$result) {
        return redirect()->route('calculator');
    }

    // On garde le résultat pour l’affichage
    return view('calculator.result', compact('result'));
}

    // Reset complet (vide le résultat et retourne au formulaire)
    public function reset()
    {
        session()->forget('last_result');
        return redirect()->route('calculator');
    }
}