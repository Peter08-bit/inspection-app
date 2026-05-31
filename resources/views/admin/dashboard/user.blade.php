@extends('layouts.app')
@section('title', 'Mon Espace')
@section('page-title', 'Mon Espace')

@section('content')
<!-- Welcome Banner - Compact -->
<div class="relative overflow-hidden bg-gradient-to-br from-slate-800 via-slate-700 to-slate-800 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 rounded-xl shadow-lg mb-5">
    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-indigo-500/10 to-transparent rounded-full"></div>
    <div class="relative px-5 py-4 md:px-6 md:py-5">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl blur-md opacity-40"></div>
                <div class="relative w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-md">
                    <span class="text-xl md:text-2xl font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                </div>
            </div>
            <div class="flex-1">
                <h2 class="text-lg md:text-xl font-bold text-white">Bonjour, {{ auth()->user()->name }} 👋</h2>
                <p class="text-indigo-200 text-xs md:text-sm">Gestion d'inspections</p>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 bg-white/10 rounded-full text-[10px] text-indigo-100">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ now()->format('d/m/Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards - Compact -->
<div class="grid grid-cols-3 gap-3 mb-5">
    <!-- Total Inspections -->
    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
        <div class="flex items-center justify-between mb-2">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-[9px] font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 px-1.5 py-0.5 rounded-full">Total</span>
        </div>
        <div class="text-xl font-bold text-slate-800 dark:text-white">{{ $myInspections }}</div>
        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">Inspections</p>
    </div>

    <!-- Conformes -->
    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
        <div class="flex items-center justify-between mb-2">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <span class="text-[9px] font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 px-1.5 py-0.5 rounded-full">OK</span>
        </div>
        <div class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $conformes }}</div>
        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">Conformes</p>
    </div>

    <!-- Non Conformes -->
    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
        <div class="flex items-center justify-between mb-2">
            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <span class="text-[9px] font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 px-1.5 py-0.5 rounded-full">Alert</span>
        </div>
        <div class="text-xl font-bold text-red-600 dark:text-red-400">{{ $nonConformes }}</div>
        <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">Non conformes</p>
    </div>
</div>

<!-- Taux de conformité mini bar -->
<div class="bg-white dark:bg-slate-800 rounded-xl p-3 mb-5 shadow-sm">
    <div class="flex justify-between items-center mb-1.5">
        <span class="text-[10px] font-medium text-slate-600 dark:text-slate-300">Taux de conformité</span>
        <span class="text-[10px] font-bold text-emerald-600">{{ $myInspections > 0 ? round(($conformes / $myInspections) * 100) : 0 }}%</span>
    </div>
    <div class="w-full bg-emerald-100 dark:bg-emerald-900/30 rounded-full h-1.5">
        <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-500" style="width: {{ $myInspections > 0 ? round(($conformes / $myInspections) * 100) : 0 }}%"></div>
    </div>
</div>

<!-- Recent Inspections Section - Compact -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
    <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h3 class="font-semibold text-sm text-slate-800 dark:text-white">Dernières inspections</h3>
        </div>
        <a href="{{ route('user.inspections') }}" class="text-[10px] font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 transition">Voir tout →</a>
    </div>
    <div class="divide-y divide-slate-100 dark:divide-slate-700">
        @forelse($recentInspections->take(4) as $inspection)
        <div class="px-4 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all duration-150">
            <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-2 flex-1 min-w-0">
                    <div class="w-1.5 h-1.5 rounded-full flex-shrink-0 
                        {{ $inspection->statut === 'conforme' ? 'bg-emerald-500' : ($inspection->statut === 'non_conforme' ? 'bg-red-500' : 'bg-amber-500') }}">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-700 dark:text-slate-200 truncate">
                            {{ $inspection->materiel->nom ?? 'N/A' }}
                        </p>
                        <p class="text-[10px] text-slate-400">{{ $inspection->date_inspection->format('d/m/Y') }} · {{ $inspection->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <span class="px-1.5 py-0.5 rounded-full text-[9px] font-semibold whitespace-nowrap
                        {{ $inspection->statut === 'conforme' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 
                           ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 
                            'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                        {{ $inspection->statut === 'conforme' ? 'Conforme' : ($inspection->statut === 'non_conforme' ? 'Non conforme' : 'Attente') }}
                    </span>
                    <a href="{{ route('user.inspections') }}" class="p-1 rounded text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @if($inspection->observations)
            <p class="text-[9px] text-slate-400 mt-1 ml-3.5 truncate">{{ Str::limit($inspection->observations, 60) }}</p>
            @endif
        </div>
        @empty
        <div class="px-4 py-6 text-center">
            <div class="w-10 h-10 mx-auto mb-2 bg-slate-100 dark:bg-slate-700/50 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-xs text-slate-500 dark:text-slate-400">Aucune inspection</p>
            <a href="{{ route('user.materiels') }}" class="inline-flex items-center gap-1 mt-2 px-2.5 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-medium rounded-lg transition">
                Commencer
            </a>
        </div>
        @endforelse
    </div>
</div>

<!-- Quick Actions - Compact -->
<div class="grid grid-cols-2 gap-3 mt-5">
    <a href="{{ route('user.materiels') }}" class="group bg-gradient-to-br from-indigo-50 to-indigo-100/50 dark:from-indigo-950/30 dark:to-indigo-900/20 rounded-xl p-3 border border-indigo-200/50 dark:border-indigo-800/30 hover:shadow-md transition-all duration-200">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">Matériels</p>
                <p class="text-[9px] text-slate-400">Consulter la liste</p>
            </div>
            <svg class="w-3 h-3 text-indigo-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </div>
    </a>

    <a href="{{ route('user.inspections') }}" class="group bg-gradient-to-br from-emerald-50 to-emerald-100/50 dark:from-emerald-950/30 dark:to-emerald-900/20 rounded-xl p-3 border border-emerald-200/50 dark:border-emerald-800/30 hover:shadow-md transition-all duration-200">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-emerald-600 flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-xs font-semibold text-slate-700 dark:text-slate-200">Rapports</p>
                <p class="text-[9px] text-slate-400">Voir statistiques</p>
            </div>
            <svg class="w-3 h-3 text-emerald-400 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </div>
    </a>
</div>
@endsection