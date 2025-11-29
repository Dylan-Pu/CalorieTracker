{{-- resources/views/calculator/result.blade.php --}}
@extends('layouts.app')

@section('title', 'Tes Macros • Résultat')

{{-- On désactive le padding top du layout uniquement sur cette page --}}
@push('extra-css')
    <style>
        .pt-28 {
            padding-top: 0 !important;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto px-6 pt-20 pb-10">

            <!-- Titre principal -->
            <div class="text-center mb-16">
                <h1 class="text-7xl md:text-9xl font-black tracking-tighter">
                    <span class="bg-gradient-to-r from-pink-500 via-purple-500 to-indigo-500 bg-clip-text text-transparent">
                        TES MACROS
                    </span>
                </h1>
                <p class="text-2xl text-white/70 mt-4">
                    Calculé avec la formule Katch-McArdle • {{ $result->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>

            <!-- 4 gros cercles de progression -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                <!-- Calories -->
                <div class="relative">
                    <svg class="w-64 h-64 mx-auto transform -rotate-90">
                        <circle cx="128" cy="128" r="120" stroke="rgba(255,255,255,0.1)" stroke-width="16" fill="none" />
                        <circle cx="128" cy="128" r="120" stroke="url(#grad1)" stroke-width="16" fill="none"
                            stroke-dasharray="754" stroke-dashoffset="0" class="transition-all duration-1000" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <p class="text-white/70 text-lg">Calories</p>
                        <p class="text-6xl font-black text-white">{{ $result->calories }}</p>
                    </div>
                </div>

                <!-- Protéines -->
                <div class="relative">
                    <svg class="w-64 h-64 mx-auto transform -rotate-90">
                        <circle cx="128" cy="128" r="120" stroke="rgba(255,255,255,0.1)" stroke-width="16" fill="none" />
                        <circle cx="128" cy="128" r="120" stroke="url(#grad2)" stroke-width="16" fill="none"
                            stroke-dasharray="754" stroke-dashoffset="{{ 754 - (754 * $result->proteins / 300) }}" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <p class="text-white/70 text-lg">Protéines</p>
                        <p class="text-6xl font-black text-white">{{ $result->proteins }}g</p>
                    </div>
                </div>

                <!-- Lipides -->
                <div class="relative">
                    <svg class="w-64 h-64 mx-auto transform -rotate-90">
                        <circle cx="128" cy="128" r="120" stroke="rgba(255,255,255,0.1)" stroke-width="16" fill="none" />
                        <circle cx="128" cy="128" r="120" stroke="url(#grad3)" stroke-width="16" fill="none"
                            stroke-dasharray="754" stroke-dashoffset="{{ 754 - (754 * $result->fats / 100) }}" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <p class="text-white/70 text-lg">Lipides</p>
                        <p class="text-6xl font-black text-white">{{ $result->fats }}g</p>
                    </div>
                </div>

                <!-- Glucides -->
                <div class="relative">
                    <svg class="w-64 h-64 mx-auto transform -rotate-90">
                        <circle cx="128" cy="128" r="120" stroke="rgba(255,255,255,0.1)" stroke-width="16" fill="none" />
                        <circle cx="128" cy="128" r="120" stroke="url(#grad4)" stroke-width="16" fill="none"
                            stroke-dasharray="754" stroke-dashoffset="{{ 754 - (754 * $result->carbs / 400) }}" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <p class="text-white/70 text-lg">Glucides</p>
                        <p class="text-6xl font-black text-white">{{ $result->carbs }}g</p>
                    </div>
                </div>
            </div>

            <!-- Bouton Refaire un calcul bien visible -->
            <div class="text-center mt-20">
                <a href="{{ route('calculator', ['reset' => true]) }}"
                    class="inline-block px-12 py-6 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-black text-2xl rounded-2xl hover:scale-105 transition shadow-2xl">
                    Refaire un calcul
                </a>
            </div>
        </div>
    </div>
    </div>
@endsection