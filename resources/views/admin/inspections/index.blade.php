@extends('layouts.app')
@section('title', 'Inspections')
@section('page-title', 'Gestion des Inspections')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
    <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h3 class="font-semibold text-gray-800 dark:text-white">Liste des inspections</h3>
        <div class="flex items-center gap-3">
            <form method="GET" class="flex gap-2">
                <select name="statut" class="px-3 py-2 text-sm border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                    <option value="">Tous statuts</option>
                    <option value="conforme" {{ request('statut') === 'conforme' ? 'selected' : '' }}>Conforme</option>
                    <option value="non_conforme" {{ request('statut') === 'non_conforme' ? 'selected' : '' }}>Non conforme</option>
                    <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
                </select>
                <button type="submit" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                </button>
            </form>
            <a href="{{ route('admin.inspections.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-xl transition shadow-md shadow-orange-200 dark:shadow-none flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nouvelle Inspection
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-orange-50 dark:bg-orange-900/20 text-left">
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Matériel</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Inspecteur</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Date</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Statut</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Observations</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($inspections as $inspection)
                <tr class="hover:bg-orange-50/40 dark:hover:bg-orange-900/10 transition">
                    <td class="px-6 py-3 text-gray-400">{{ $inspection->id }}</td>
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-gray-200">{{ $inspection->materiel->nom ?? 'N/A' }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $inspection->user->name ?? 'N/A' }}</td>
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
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.inspections.edit', $inspection) }}" class="p-1.5 rounded-lg bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 hover:bg-orange-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.inspections.destroy', $inspection) }}" onsubmit="return confirm('Supprimer cette inspection ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="px-6 py-12 text-center text-gray-400 text-sm">Aucune inspection trouvée</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($inspections->hasPages())
    <div class="px-6 py-4 border-t border-orange-100 dark:border-orange-900">{{ $inspections->links() }}</div>
    @endif
</div>
@endsection
