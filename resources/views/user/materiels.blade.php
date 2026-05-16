@extends('layouts.app')
@section('title', 'Matériels')
@section('page-title', 'Catalogue des Matériels')

@section('content')
<div class="space-y-4">
    <!-- Barre de recherche et filtres -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <div class="relative">
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Rechercher un matériel..." 
                            class="pl-9 pr-4 py-1.5 text-xs border border-slate-200 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-primary-400 focus:border-primary-400 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-200 outline-none transition w-52">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2.5 pointer-events-none">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    <button type="submit" 
                        class="px-3 py-1.5 bg-primary-50 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/50 transition-all duration-200 flex items-center gap-1.5 text-xs font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        Filtrer
                    </button>
                    @if(request('search'))
                        <a href="{{ route('user.materiels') }}" class="px-2 py-1.5 text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
            
            <!-- Filtres rapides par état -->
            <div class="flex items-center gap-2">
                <span class="text-[10px] text-slate-400 hidden sm:inline">État :</span>
                <a href="{{ request()->fullUrlWithQuery(['etat' => 'bon']) }}" 
                    class="px-2 py-1 rounded-full text-[10px] font-medium {{ request('etat') == 'bon' ? 'bg-emerald-600 text-white' : 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100' }} transition">
                    Bon
                </a>
                <a href="{{ request()->fullUrlWithQuery(['etat' => 'a_verifier']) }}" 
                    class="px-2 py-1 rounded-full text-[10px] font-medium {{ request('etat') == 'a_verifier' ? 'bg-amber-600 text-white' : 'bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 hover:bg-amber-100' }} transition">
                    À vérifier
                </a>
                <a href="{{ request()->fullUrlWithQuery(['etat' => 'defectueux']) }}" 
                    class="px-2 py-1 rounded-full text-[10px] font-medium {{ request('etat') == 'defectueux' ? 'bg-red-600 text-white' : 'bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100' }} transition">
                    Défectueux
                </a>
                @if(request('etat'))
                    <a href="{{ route('user.materiels') }}" class="text-[10px] text-slate-400 hover:text-slate-600">× Effacer</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Cartes statistiques -->
    <div class="grid grid-cols-3 gap-3">
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $materiels->where('etat', 'bon')->count() }}</p>
                    <p class="text-[9px] text-slate-400">Bon état</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-amber-600 dark:text-amber-400">{{ $materiels->where('etat', 'a_verifier')->count() }}</p>
                    <p class="text-[9px] text-slate-400">À vérifier</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-red-600 dark:text-red-400">{{ $materiels->where('etat', 'defectueux')->count() }}</p>
                    <p class="text-[9px] text-slate-400">Défectueux</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des matériels modernisé -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm text-slate-800 dark:text-white">Catalogue des matériels</h3>
                    <p class="text-[10px] text-slate-400">{{ $materiels->total() }} matériel(s) disponible(s)</p>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700">
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Matériel</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden md:table-cell">N° Série</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Catégorie</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden lg:table-cell">Localisation</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">État</th>
                    <tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @forelse($materiels as $materiel)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all duration-150 group">
                        <td class="px-4 py-2.5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded bg-primary-100 dark:bg-primary-900/40 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-700 dark:text-slate-200">{{ Str::limit($materiel->nom, 25) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2.5 hidden md:table-cell">
                            <span class="text-[10px] font-mono text-slate-500 dark:text-slate-400">{{ $materiel->numero_serie }}</span>
                        </td>
                        <td class="px-4 py-2.5">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[9px] font-medium bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                {{ $materiel->categorie }}
                            </span>
                        </td>
                        <td class="px-4 py-2.5 hidden lg:table-cell">
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
                        <td class="px-4 py-2.5">
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
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-700/50 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Aucun matériel trouvé</p>
                                @if(request('search') || request('etat'))
                                    <a href="{{ route('user.materiels') }}" class="mt-1 text-[10px] text-primary-600 hover:text-primary-700">Voir tous les matériels</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($materiels->hasPages())
        <div class="px-4 py-2.5 border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/30">
            {{ $materiels->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection