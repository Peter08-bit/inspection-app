@extends('layouts.app')
@section('title', 'Mon Espace')
@section('page-title', 'Mon Espace')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 mb-6 text-white shadow-lg">
    <div class="flex items-center gap-4">
        <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center font-bold text-2xl">
            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>
        <div>
            <h2 class="text-xl font-bold">Bonjour, {{ auth()->user()->name }} 👋</h2>
            <p class="text-orange-100 text-sm mt-0.5">Voici un résumé de votre activité d'inspection</p>
        </div>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="text-3xl font-bold text-gray-800 dark:text-white">{{ $myInspections }}</div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Mes inspections</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="text-3xl font-bold text-green-600">{{ $conformes }}</div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Conformes</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="text-3xl font-bold text-red-500">{{ $nonConformes }}</div>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Non conformes</p>
    </div>
</div>

<!-- Recent Inspections -->
<div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
    <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex items-center justify-between">
        <h3 class="font-semibold text-gray-800 dark:text-white">Mes dernières inspections</h3>
        <a href="{{ route('user.inspections') }}" class="text-xs text-orange-500 hover:text-orange-600 font-medium">Voir tout →</a>
    </div>
    <div class="divide-y divide-gray-50 dark:divide-gray-700">
        @forelse($recentInspections as $inspection)
        <div class="px-6 py-4 flex items-center justify-between hover:bg-orange-50/40 dark:hover:bg-orange-900/10 transition">
            <div>
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $inspection->materiel->nom ?? 'N/A' }}</p>
                <p class="text-xs text-gray-400 mt-0.5">{{ $inspection->date_inspection->format('d/m/Y') }}</p>
                @if($inspection->observations)
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 max-w-sm truncate">{{ $inspection->observations }}</p>
                @endif
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                {{ $inspection->statut === 'conforme' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                   ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                    'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                {{ ucfirst(str_replace('_', ' ', $inspection->statut)) }}
            </span>
        </div>
        @empty
        <div class="px-6 py-10 text-center text-gray-400">
            <svg class="w-10 h-10 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm">Vous n'avez aucune inspection pour l'instant</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
