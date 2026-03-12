@extends('layouts.app')
@section('title', 'Matériels')
@section('page-title', 'Gestion des Matériels')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <h3 class="font-semibold text-gray-800 dark:text-white">Liste des matériels</h3>
        <div class="flex items-center gap-3">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." 
                    class="px-3 py-2 text-sm border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition w-48">
                <button type="submit" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-xl hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
            <a href="{{ route('admin.materiels.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-xl transition duration-200 shadow-md shadow-orange-200 dark:shadow-none flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Nouveau Matériel
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-orange-50 dark:bg-orange-900/20 text-left">
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Nom</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">N° Série</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Catégorie</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Localisation</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">État</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Date Achat</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($materiels as $materiel)
                <tr class="hover:bg-orange-50/40 dark:hover:bg-orange-900/10 transition">
                    <td class="px-6 py-3 text-gray-400">{{ $materiel->id }}</td>
                    <td class="px-6 py-3 font-medium text-gray-800 dark:text-gray-200">{{ $materiel->nom }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400 font-mono text-xs">{{ $materiel->numero_serie }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $materiel->categorie }}</td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $materiel->localisation }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $materiel->etat === 'bon' ? 'bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400' : 
                               ($materiel->etat === 'defectueux' ? 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-400' : 
                                'bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-400') }}">
                            {{ ucfirst($materiel->etat) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $materiel->date_achat ? $materiel->date_achat->format('d/m/Y') : '—' }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.materiels.show', $materiel) }}" class="p-1.5 rounded-lg bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-100 transition" title="Voir">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.materiels.edit', $materiel) }}" class="p-1.5 rounded-lg bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 hover:bg-orange-100 transition" title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.materiels.destroy', $materiel) }}" onsubmit="return confirm('Supprimer ce matériel ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 transition" title="Supprimer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        <p>Aucun matériel trouvé</p>
                        <a href="{{ route('admin.materiels.create') }}" class="mt-3 inline-block text-orange-500 hover:text-orange-600 font-medium text-sm">+ Ajouter le premier matériel</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($materiels->hasPages())
    <div class="px-6 py-4 border-t border-orange-100 dark:border-orange-900">
        {{ $materiels->links() }}
    </div>
    @endif
</div>
@endsection
