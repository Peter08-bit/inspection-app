@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Tableau de bord')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
            </div>
            <span class="text-xs font-medium text-green-500 bg-green-50 dark:bg-green-900/30 px-2 py-1 rounded-full">Total</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalMateriels }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Matériels enregistrés</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-xs font-medium text-blue-500 bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded-full">Total</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalInspections }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Inspections effectuées</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-red-100 dark:bg-red-900/50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <span class="text-xs font-medium text-red-500 bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded-full">Urgents</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $materielsDefectueux }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Matériels défectueux</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 border-2 border-orange-200 dark:border-orange-800 shadow-sm hover:shadow-md transition">
        <div class="flex items-center justify-between mb-3">
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="text-xs font-medium text-purple-500 bg-purple-50 dark:bg-purple-900/30 px-2 py-1 rounded-full">Actifs</span>
        </div>
        <h3 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalUsers }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Utilisateurs actifs</p>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <!-- Recent Inspections -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Dernières Inspections
            </h3>
            <a href="{{ route('admin.inspections.index') }}" class="text-xs text-orange-500 hover:text-orange-600 font-medium">Voir tout →</a>
        </div>
        <div class="divide-y divide-gray-50 dark:divide-gray-700">
            @forelse($recentInspections as $inspection)
            <div class="px-6 py-3 flex items-center justify-between hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition">
                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $inspection->materiel->nom ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-400">{{ $inspection->user->name ?? 'N/A' }} · {{ $inspection->date_inspection->format('d/m/Y') }}</p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                    {{ $inspection->statut === 'conforme' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                       ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                        'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                    {{ ucfirst(str_replace('_', ' ', $inspection->statut)) }}
                </span>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400">
                <svg class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm">Aucune inspection pour l'instant</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Materiel Status -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800 dark:text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                Matériels Récents
            </h3>
            <a href="{{ route('admin.materiels.index') }}" class="text-xs text-orange-500 hover:text-orange-600 font-medium">Voir tout →</a>
        </div>
        <div class="divide-y divide-gray-50 dark:divide-gray-700">
            @forelse($recentMateriels as $materiel)
            <div class="px-6 py-3 flex items-center justify-between hover:bg-orange-50/50 dark:hover:bg-orange-900/10 transition">
                <div>
                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $materiel->nom }}</p>
                    <p class="text-xs text-gray-400">{{ $materiel->numero_serie }} · {{ $materiel->categorie }}</p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                    {{ $materiel->etat === 'bon' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                       ($materiel->etat === 'defectueux' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                        'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                    {{ ucfirst($materiel->etat) }}
                </span>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400">
                <p class="text-sm">Aucun matériel pour l'instant</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
