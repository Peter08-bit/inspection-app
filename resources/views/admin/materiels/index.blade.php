@extends('layouts.app')
@section('title', 'Matériels')
@section('page-title', 'Gestion des Matériels')

@section('content')
<div class="space-y-4">
    <!-- Filtres et actions - Compact -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <div class="relative">
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Rechercher un matériel..." 
                            class="pl-9 pr-4 py-1.5 text-xs border border-slate-200 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 outline-none transition w-52">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" 
                        class="px-3 py-1.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-all duration-200 flex items-center gap-1.5 text-xs font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        Filtrer
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.materiels.index') }}" 
                            class="px-2 py-1.5 text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <a href="{{ route('admin.materiels.create') }}" 
            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-medium rounded-lg transition-all duration-200 shadow-sm text-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau matériel
        </a>
    </div>

    <!-- Tableau des matériels -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <!-- Header compact -->
        <div class="px-4 py-2.5 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm text-slate-800 dark:text-white">Liste des matériels</h3>
                    <p class="text-[10px] text-slate-400">{{ $materiels->total() }} matériel(s) trouvé(s)</p>
                </div>
            </div>
        </div>

        <!-- Table responsive compact -->
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700">
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">ID</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Matériel</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden md:table-cell">N° Série</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Catégorie</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden lg:table-cell">Localisation</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">État</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden xl:table-cell">Achat</th>
                        <th class="px-4 py-2 text-center font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @forelse($materiels as $materiel)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all duration-150 group">
                        <td class="px-4 py-2">
                            <span class="text-[10px] font-mono text-slate-400">#{{ $materiel->id }}</span>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-1.5">
                                <div class="w-5 h-5 rounded bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-2.5 h-2.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-700 dark:text-slate-200 truncate max-w-[120px]">{{ Str::limit($materiel->nom, 25) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2 hidden md:table-cell">
                            <span class="text-[10px] font-mono text-slate-500 dark:text-slate-400">{{ $materiel->numero_serie }}</span>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[9px] font-medium bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                {{ $materiel->categorie }}
                            </span>
                        </td>
                        <td class="px-4 py-2 hidden lg:table-cell">
                            @if($materiel->localisation)
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 truncate max-w-[100px]">{{ Str::limit($materiel->localisation, 20) }}</span>
                                </div>
                            @else
                                <span class="text-[10px] text-slate-400 italic">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[9px] font-semibold
                                {{ $materiel->etat === 'bon' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 
                                   ($materiel->etat === 'defectueux' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 
                                    'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                                <span class="w-1 h-1 rounded-full 
                                    {{ $materiel->etat === 'bon' ? 'bg-emerald-500' : 
                                       ($materiel->etat === 'defectueux' ? 'bg-red-500' : 'bg-amber-500') }}"></span>
                                {{ $materiel->etat === 'bon' ? 'Bon' : ($materiel->etat === 'defectueux' ? 'Défectueux' : 'À vérifier') }}
                            </span>
                        </td>
                        <td class="px-4 py-2 hidden xl:table-cell">
                            @if($materiel->date_achat)
                                <div class="flex items-center gap-1">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400">{{ $materiel->date_achat->format('d/m/Y') }}</span>
                                </div>
                            @else
                                <span class="text-[10px] text-slate-400 italic">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.materiels.show', $materiel) }}" 
                                    class="p-1 rounded text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition"
                                    title="Voir">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.materiels.edit', $materiel) }}" 
                                    class="p-1 rounded text-slate-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/30 transition"
                                    title="Modifier">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.materiels.destroy', $materiel) }}" 
                                    onsubmit="return confirm('Supprimer ce matériel ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                        class="p-1 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 transition"
                                        title="Supprimer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-700/50 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Aucun matériel trouvé</p>
                                <a href="{{ route('admin.materiels.create') }}" 
                                    class="mt-1 inline-flex items-center gap-1 px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-medium rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Ajouter un matériel
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination compacte -->
        @if($materiels->hasPages())
        <div class="px-4 py-2 border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/30">
            {{ $materiels->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

    <!-- Mini stats compactes -->
    @if($materiels->count() > 0)
    <div class="grid grid-cols-3 gap-2">
        <div class="bg-emerald-50 dark:bg-emerald-950/20 rounded-lg p-2 text-center border border-emerald-100 dark:border-emerald-800/30">
                            <div class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                                {{ $materiels->where('etat', 'bon')->count() }}
                            </div>
                            <div class="text-[9px] font-medium text-emerald-600 dark:text-emerald-400">Bon état</div>
                        </div>
                        <div class="bg-amber-50 dark:bg-amber-950/20 rounded-lg p-2 text-center border border-amber-100 dark:border-amber-800/30">
                            <div class="text-sm font-bold text-amber-600 dark:text-amber-400">
                                {{ $materiels->where('etat', 'a_verifier')->count() }}
                            </div>
                            <div class="text-[9px] font-medium text-amber-600 dark:text-amber-400">À vérifier</div>
                        </div>
                        <div class="bg-red-50 dark:bg-red-950/20 rounded-lg p-2 text-center border border-red-100 dark:border-red-800/30">
                            <div class="text-sm font-bold text-red-600 dark:text-red-400">
                                {{ $materiels->where('etat', 'defectueux')->count() }}
                            </div>
                            <div class="text-[9px] font-medium text-red-600 dark:text-red-400">Défectueux</div>
                        </div>
                    </div>
                    @endif
                </div>
                @endsection