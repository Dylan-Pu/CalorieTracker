<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Calculation;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MealController;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('calculator')
        : view('welcome');
})->name('home');

// ==================================================
// AUTHENTIFICATION + INSCRIPTION
// ==================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
});

Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');

// ==================== ALIMENTS ====================
Route::middleware('auth')->group(function () {
    Route::get('/foods', [FoodController::class, 'index'])->name('foods.index');
    Route::post('/foods', [FoodController::class, 'store'])->name('foods.store');
    Route::put('/foods/{food}', [FoodController::class, 'update'])->name('foods.update');
    Route::delete('/foods/{food}', [FoodController::class, 'destroy'])->name('foods.destroy');
});

// ==================== REPAS ====================
Route::middleware('auth')->group(function () {
    Route::get('/meals', [MealController::class, 'index'])->name('meals.index');
    Route::post('/meals', [MealController::class, 'add'])->name('meals.add');
    Route::post('/meals/remove', [MealController::class, 'remove'])->name('meals.remove');
});

// ==================================================
// ZONE PROTÉGÉE
// ==================================================
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==================== CALCULATEUR ====================

    // 1. Page principale → toujours le formulaire (vide ou pas)
    Route::get('/calculator', function () {
        $lastCalculation = auth()->user()->calculations()->latest()->first();
        if (request()->has('reset')) {
            return view('calculator.calculator');
        }

        if ($lastCalculation) {
            return view('calculator.result', ['result' => $lastCalculation]);
        }

        return view('calculator.calculator');
    })->name('calculator');
    // 2. Soumission du formulaire
    Route::post('/calculator', function (Request $request) {
        $data = $request->validate([
            'weight' => 'required|numeric|min:30|max:200',
            'bodyfat' => 'required|numeric|min:5|max:50',
            'activity' => 'required|numeric|in:1.2,1.375,1.55,1.725,1.9',
            'deficit' => 'required|numeric|min:5|max:25',
        ]);

        $lbm = $data['weight'] * (1 - $data['bodyfat'] / 100);
        $bmr = 370 + (21.6 * $lbm);
        $tdee = $bmr * $data['activity'];
        $calories = round($tdee * (1 - $data['deficit'] / 100));

        $proteins = round(($calories * 0.35) / 4);
        $fats = round(($calories * 0.25) / 9);
        $carbs = round(($calories * 0.40) / 4);

        $calculation = auth()->user()->calculations()->create($data + [
            'calories' => $calories,
            'proteins' => $proteins,
            'fats' => $fats,
            'carbs' => $carbs,
        ]);

        return redirect()->route('calculator.result', $calculation);
    })->name('calculator.store'); // ← C'EST TOUT !

    // 3. Affichage du résultat
    Route::get('/calculator/result/{calculation}', function (Calculation $calculation) {
        if ($calculation->user_id !== auth()->id()) {
            return redirect()->route('calculator');
        }
        return view('calculator.result', ['result' => $calculation]);
    })->name('calculator.result');

});