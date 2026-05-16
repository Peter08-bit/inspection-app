@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Tableau de bord')

@section('content')
<!-- Stats Cards - Compact mais élégant -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 mb-6">
    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 md:p-4 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-2">
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-full">Total</span>
        </div>
        <h3 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white">{{ number_format($totalMateriels) }}</h3>
        <p class="text-[11px] md:text-xs text-slate-500 dark:text-slate-400 mt-0.5">Matériels</p>
        <div class="mt-2 flex items-center gap-1 text-[10px] md:text-xs text-emerald-600">
            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <span>+12%</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 md:p-4 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-2">
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 px-2 py-0.5 rounded-full">Total</span>
        </div>
        <h3 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white">{{ number_format($totalInspections) }}</h3>
        <p class="text-[11px] md:text-xs text-slate-500 dark:text-slate-400 mt-0.5">Inspections</p>
        <div class="mt-2 flex items-center gap-1 text-[10px] md:text-xs text-blue-600">
            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            <span>+8%</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 md:p-4 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-2">
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 px-2 py-0.5 rounded-full">Urgent</span>
        </div>
        <h3 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white">{{ number_format($materielsDefectueux) }}</h3>
        <p class="text-[11px] md:text-xs text-slate-500 dark:text-slate-400 mt-0.5">Défectueux</p>
        <div class="mt-2 flex items-center gap-1 text-[10px] md:text-xs text-red-600">
            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Attention</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl p-3 md:p-4 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="flex items-center justify-between mb-2">
            <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-sm">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <span class="text-[10px] md:text-xs font-semibold text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/30 px-2 py-0.5 rounded-full">Actifs</span>
        </div>
        <h3 class="text-xl md:text-2xl font-bold text-slate-800 dark:text-white">{{ number_format($totalUsers) }}</h3>
        <p class="text-[11px] md:text-xs text-slate-500 dark:text-slate-400 mt-0.5">Utilisateurs</p>
        <div class="mt-2 flex items-center gap-1 text-[10px] md:text-xs text-purple-600">
            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span>+3</span>
        </div>
    </div>
</div>

<!-- Graphiques Section - Compact -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6 mb-6">
    <!-- Évolution des inspections -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="px-4 md:px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                        Évolution des inspections
                    </h3>
                </div>
                <span class="text-[10px] text-slate-400">Derniers 6 mois</span>
            </div>
        </div>
        <div class="p-4">
            <canvas id="inspectionsChart" height="200" style="max-height: 200px;"></canvas>
        </div>
    </div>

    <!-- Répartition par catégorie -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="px-4 md:px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Répartition par état
                    </h3>
                </div>
            </div>
        </div>
        <div class="p-4">
            <canvas id="categoryChart" height="200" style="max-height: 200px;"></canvas>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6">
    <!-- Taux de conformité -->
    <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="px-4 md:px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <h3 class="font-semibold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Taux de conformité
            </h3>
        </div>
        <div class="p-4">
            <canvas id="conformityChart" height="180" style="max-height: 180px;"></canvas>
        </div>
    </div>

    <!-- Activité récente - Compact -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
        <div class="px-4 md:px-5 py-3 border-b border-slate-100 dark:border-slate-700">
            <h3 class="font-semibold text-sm text-slate-800 dark:text-white flex items-center gap-2">
                <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Activité récente
            </h3>
        </div>
        <div class="divide-y divide-slate-100 dark:divide-slate-700 max-h-64 overflow-y-auto">
            @forelse($recentInspections->take(4) as $inspection)
            <div class="px-4 py-2.5 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full 
                        {{ $inspection->statut === 'conforme' ? 'bg-green-500' : ($inspection->statut === 'non_conforme' ? 'bg-red-500' : 'bg-yellow-500') }}">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-slate-700 dark:text-slate-300 truncate">{{ $inspection->materiel->nom ?? 'N/A' }}</p>
                        <p class="text-[10px] text-slate-400">{{ $inspection->user->name ?? 'N/A' }} · {{ $inspection->date_inspection->diffForHumans() }}</p>
                    </div>
                    <span class="text-[10px] px-1.5 py-0.5 rounded-full whitespace-nowrap
                        {{ $inspection->statut === 'conforme' ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 
                           ($inspection->statut === 'non_conforme' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 
                            'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400') }}">
                        {{ ucfirst(str_replace('_', ' ', $inspection->statut)) }}
                    </span>
                </div>
            </div>
            @empty
            <div class="px-4 py-6 text-center text-slate-400">
                <p class="text-xs">Aucune inspection récente</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Matériels récents - Compact -->
<div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm overflow-hidden">
    <div class="px-4 md:px-5 py-3 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
        <h3 class="font-semibold text-sm text-slate-800 dark:text-white flex items-center gap-2">
            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
            </svg>
            Matériels récents
        </h3>
        <a href="{{ route('admin.materiels.index') }}" class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 font-medium transition">Voir tout →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 dark:bg-slate-900/50 text-xs">
                <tr>
                    <th class="px-4 py-2 text-left font-medium text-slate-500">Matériel</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-500">N° Série</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-500 hidden md:table-cell">Catégorie</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-500">État</th>
                    <th class="px-4 py-2 text-left font-medium text-slate-500 hidden lg:table-cell">Ajouté</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                @forelse($recentMateriels->take(5) as $materiel)
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition text-xs">
                    <td class="px-4 py-2.5 font-medium text-slate-700 dark:text-slate-300">{{ Str::limit($materiel->nom, 20) }}</td>
                    <td class="px-4 py-2.5 text-slate-500 dark:text-slate-400">{{ $materiel->numero_serie }}</td>
                    <td class="px-4 py-2.5 text-slate-500 dark:text-slate-400 hidden md:table-cell">{{ $materiel->categorie }}</td>
                    <td class="px-4 py-2.5">
                        <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold
                            {{ $materiel->etat === 'bon' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : 
                               ($materiel->etat === 'defectueux' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : 
                                'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400') }}">
                            {{ ucfirst($materiel->etat) }}
                        </span>
                    </td>
                    <td class="px-4 py-2.5 text-slate-500 dark:text-slate-400 hidden lg:table-cell">{{ $materiel->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-slate-400 text-xs">Aucun matériel enregistré</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @php
            $inspectionsData = isset($inspectionsParMois) ? $inspectionsParMois : [12, 19, 15, 22, 34, 28];
            $categoriesData = isset($materielsParCategorie) ? $materielsParCategorie : [42, 28, 18, 12];
            $conformityData = isset($tauxConformite) ? $tauxConformite : [85, 92, 78, 65, 88];
        @endphp
        
        const inspectionsData = @json($inspectionsData);
        const categoriesData = @json($categoriesData);
        const conformityData = @json($conformityData);
        
        // Graphique des inspections
        const ctx1 = document.getElementById('inspectionsChart')?.getContext('2d');
        if(ctx1) {
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        data: inspectionsData,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.05)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 1.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { display: false }, tooltip: { mode: 'index' } },
                    scales: { y: { beginAtZero: true, grid: { color: '#e2e8f0' }, ticks: { stepSize: 10 } }, x: { grid: { display: false } } }
                }
            });
        }
        
        // Graphique camembert
        const ctx2 = document.getElementById('categoryChart')?.getContext('2d');
        if(ctx2) {
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Bon état', 'À réviser', 'Défectueux', 'Hors service'],
                    datasets: [{ data: categoriesData, backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#6b7280'], borderWidth: 0, hoverOffset: 6 }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 8, font: { size: 10 } } } },
                    cutout: '65%'
                }
            });
        }
        
        // Graphique conformité
        const ctx3 = document.getElementById('conformityChart')?.getContext('2d');
        if(ctx3) {
            new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: ['A', 'B', 'C', 'D', 'E'],
                    datasets: [{ label: 'Conformité (%)', data: conformityData, backgroundColor: 'rgba(14, 165, 233, 0.7)', borderRadius: 6, barPercentage: 0.65 }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { tooltip: { callbacks: { label: (ctx) => ctx.raw + '%' } } },
                    scales: { y: { max: 100, grid: { color: '#e2e8f0' }, ticks: { callback: (v) => v + '%' } }, x: { grid: { display: false } } }
                }
            });
        }
    });
</script>
@endpush