@extends('layouts.app')
@section('title', 'Détail Matériel')
@section('page-title', 'Détail du Matériel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex items-center justify-between">
            <h3 class="font-semibold text-gray-800 dark:text-white">{{ $materiel->nom }}</h3>
            <div class="flex gap-2">
                <a href="{{ route('admin.materiels.edit', $materiel) }}" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold py-2 px-4 rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Modifier
                </a>
                <a href="{{ route('admin.materiels.index') }}" class="text-sm font-medium py-2 px-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Retour
                </a>
            </div>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
            @foreach([
                ['Nom', $materiel->nom],
                ['Numéro de série', $materiel->numero_serie],
                ['Catégorie', $materiel->categorie],
                ['Localisation', $materiel->localisation ?? '—'],
                ['Marque', $materiel->marque ?? '—'],
                ['Responsable', $materiel->responsable ?? '—'],
                ['Date d\'achat', $materiel->date_achat?->format('d/m/Y') ?? '—'],
            ] as [$label, $value])
            <div class="bg-orange-50/50 dark:bg-orange-900/10 rounded-xl p-4 border border-orange-100 dark:border-orange-900">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">{{ $label }}</p>
                <p class="font-medium text-gray-800 dark:text-gray-200">{{ $value }}</p>
            </div>
            @endforeach
            <div class="bg-orange-50/50 dark:bg-orange-900/10 rounded-xl p-4 border border-orange-100 dark:border-orange-900">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">État</p>
                <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                    {{ $materiel->etat === 'bon' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                       ($materiel->etat === 'defectueux' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                        'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                    {{ ucfirst($materiel->etat) }}
                </span>
            </div>
        </div>
        @if($materiel->description)
        <div class="px-6 pb-6">
            <div class="bg-orange-50/50 dark:bg-orange-900/10 rounded-xl p-4 border border-orange-100 dark:border-orange-900">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Description</p>
                <p class="text-gray-800 dark:text-gray-200">{{ $materiel->description }}</p>
            </div>
        </div>
        @endif
    </div>

    <!-- Inspections History -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900">
            <h3 class="font-semibold text-gray-800 dark:text-white">Historique des inspections</h3>
        </div>
        <div class="divide-y divide-gray-50 dark:divide-gray-700">
            @forelse($materiel->inspections as $inspection)
            <div class="px-6 py-4 flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-1">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                            {{ $inspection->statut === 'conforme' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                               ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                                'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                            {{ ucfirst(str_replace('_', ' ', $inspection->statut)) }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">par {{ $inspection->user->name ?? 'N/A' }}</span>
                    </div>
                    @if($inspection->observations)
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $inspection->observations }}</p>
                    @endif
                </div>
                <span class="text-xs text-gray-400 whitespace-nowrap">{{ $inspection->date_inspection->format('d/m/Y') }}</span>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">Aucune inspection enregistrée</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
