@extends('layouts.app')
@section('title', 'Mes Inspections')
@section('page-title', 'Mes Inspections')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
    <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900">
        <h3 class="font-semibold text-gray-800 dark:text-white">Historique de mes inspections</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-orange-50 dark:bg-orange-900/20 text-left">
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Matériel</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Date</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Statut</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Observations</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($inspections as $inspection)
                <tr class="hover:bg-orange-50/40 dark:hover:bg-orange-900/10 transition">
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-gray-200">{{ $inspection->materiel->nom ?? 'N/A' }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $inspection->date_inspection->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $inspection->statut === 'conforme' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                               ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                                'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                            {{ ucfirst(str_replace('_', ' ', $inspection->statut)) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-500 dark:text-gray-400 max-w-xs truncate">{{ $inspection->observations ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-6 py-12 text-center text-gray-400 text-sm">Aucune inspection enregistrée</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inspections->hasPages())
    <div class="px-6 py-4 border-t border-orange-100 dark:border-orange-900">{{ $inspections->links() }}</div>
    @endif
</div>
@endsection
