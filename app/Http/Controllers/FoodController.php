<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    // Page principale : liste + formulaire ajout/édition sur la même page
    public function index()
    {
        $foods = auth()->user()->foods()->orderBy('name')->get();

        // Si on arrive avec ?edit=5 → on charge l'aliment à éditer
        $editingFood = null;
        if (request()->has('edit')) {
            $editingFood = auth()->user()->foods()->findOrFail(request('edit'));
        }

        return view('foods.index', compact('foods', 'editingFood'));
    }

    // Ajouter un nouvel aliment
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'proteins' => 'required|numeric|min:0',
            'fats'     => 'required|numeric|min:0',
            'carbs'    => 'required|numeric|min:0',
        ]);

        // user_id est ajouté automatiquement grâce au fillable + relation
        auth()->user()->foods()->create($data);

        return back()->with('success', 'Aliment ajouté avec succès !');
    }

    // Mettre à jour un aliment existant
    public function update(Request $request, Food $food)
    {
        // Sécurité
        if ($food->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'proteins' => 'required|numeric|min:0',
            'fats'     => 'required|numeric|min:0',
            'carbs'    => 'required|numeric|min:0',
        ]);

        $food->update($data);

        // On revient sur la page index SANS le paramètre ?edit
        return redirect()->route('foods.index')->with('success', 'Aliment mis à jour !');
    }

    // Supprimer un aliment
    public function destroy(Food $food)
    {
        if ($food->user_id !== auth()->id()) {
            abort(403);
        }

        $food->delete();

        return back()->with('success', 'Aliment supprimé.');
    }
}