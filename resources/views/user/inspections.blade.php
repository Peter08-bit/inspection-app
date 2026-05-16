@extends('layouts.app')
@section('title', 'Mes Inspections')
@section('page-title', 'Mes Inspections')

@section('content')
<div class="space-y-4">
    <!-- Header avec statistiques -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-slate-700 dark:text-slate-200">{{ $inspections->total() }}</p>
                    <p class="text-[10px] text-slate-400">Total inspections</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-slate-800 rounded-xl p-3 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $inspections->where('statut', 'conforme')->count() }}</p>
                    <p class="text-[10px] text-slate-400">Conformes</p>
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
                    <p class="text-lg font-bold text-red-600 dark:text-red-400">{{ $inspections->where('statut', 'non_conforme')->count() }}</p>
                    <p class="text-[10px] text-slate-400">Non conformes</p>
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
                    <p class="text-lg font-bold text-amber-600 dark:text-amber-400">{{ $inspections->where('statut', 'en_attente')->count() }}</p>
                    <p class="text-[10px] text-slate-400">En attente</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des inspections modernisé -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm text-slate-800 dark:text-white">Historique des inspections</h3>
                    <p class="text-[10px] text-slate-400">Vos dernières interventions</p>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700">
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Matériel</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Date</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Statut</th>
                        <th class="px-4 py-2.5 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden md:table-cell">Observations</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @forelse($inspections as $inspection)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all duration-150 group">
                        <td class="px-4 py-2.5">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded bg-primary-100 dark:bg-primary-900/40 flex items-center justify-center">
                                    <svg class="w-3 h-3 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-slate-700 dark:text-slate-200">{{ Str::limit($inspection->materiel->nom ?? 'N/A', 30) }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2.5">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs text-slate-600 dark:text-slate-300">{{ $inspection->date_inspection->format('d/m/Y') }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2.5">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[9px] font-semibold
                                {{ $inspection->statut === 'conforme' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 
                                   ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 
                                    'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400') }}">
                                <span class="w-1 h-1 rounded-full 
                                    {{ $inspection->statut === 'conforme' ? 'bg-emerald-500' : 
                                       ($inspection->statut === 'non_conforme' ? 'bg-red-500' : 'bg-amber-500') }}"></span>
                                {{ $inspection->statut === 'conforme' ? 'Conforme' : ($inspection->statut === 'non_conforme' ? 'Non conforme' : 'En attente') }}
                            </span>
                        </td>
                        <td class="px-4 py-2.5 hidden md:table-cell">
                            @if($inspection->observations)
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3 h-3 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                    </svg>
                                    <span class="text-[10px] text-slate-500 dark:text-slate-400 truncate max-w-[200px]">{{ Str::limit($inspection->observations, 50) }}</span>
                                </div>
                            @else
                                <span class="text-[10px] text-slate-400 italic">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-700/50 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Aucune inspection trouvée</p>
                                <a href="{{ route('user.materiels') }}" class="mt-1 inline-flex items-center gap-1 px-3 py-1 bg-primary-600 hover:bg-primary-700 text-white text-[10px] font-medium rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Commencer une inspection
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($inspections->hasPages())
        <div class="px-4 py-2.5 border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/30">
            {{ $inspections->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection