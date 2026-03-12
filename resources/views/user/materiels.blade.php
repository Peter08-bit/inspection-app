@extends('layouts.app')
@section('title', 'Matériels')
@section('page-title', 'Catalogue des Matériels')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
    <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900">
        <h3 class="font-semibold text-gray-800 dark:text-white">Liste de tous les matériels</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-orange-50 dark:bg-orange-900/20 text-left">
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Nom</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">N° Série</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Catégorie</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Localisation</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">État</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($materiels as $materiel)
                <tr class="hover:bg-orange-50/40 dark:hover:bg-orange-900/10 transition">
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-gray-200">{{ $materiel->nom }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400 font-mono text-xs">{{ $materiel->numero_serie }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $materiel->categorie }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $materiel->localisation ?? '—' }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $materiel->etat === 'bon' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                               ($materiel->etat === 'defectueux' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                                'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                            {{ ucfirst($materiel->etat) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">Aucun matériel disponible</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($materiels->hasPages())
    <div class="px-6 py-4 border-t border-orange-100 dark:border-orange-900">{{ $materiels->links() }}</div>
    @endif
</div>
@endsection
