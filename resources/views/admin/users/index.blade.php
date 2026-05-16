@extends('layouts.app')
@section('title', 'Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="space-y-4">
    <!-- Header avec actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-2">
            <div class="relative">
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Rechercher un utilisateur..." 
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
                        <a href="{{ route('admin.users.index') }}" 
                            class="px-2 py-1.5 text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 transition">
                            Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <a href="{{ route('admin.users.create') }}" 
            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-medium rounded-lg transition-all duration-200 shadow-sm text-xs">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvel utilisateur
        </a>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <!-- Header compact -->
        <div class="px-4 py-2.5 border-b border-slate-100 dark:border-slate-700">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-sm text-slate-800 dark:text-white">Liste des utilisateurs</h3>
                    <p class="text-[10px] text-slate-400">{{ $users->count() }} utilisateur(s) trouvé(s)</p>
                </div>
            </div>
        </div>

        <!-- Table responsive compact -->
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700">
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">ID</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Utilisateur</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden md:table-cell">Email</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Rôle</th>
                        <th class="px-4 py-2 text-left font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px] hidden lg:table-cell">Inscrit</th>
                        <th class="px-4 py-2 text-center font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-[10px]">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-all duration-150 group">
                        <td class="px-4 py-2">
                            <span class="text-[10px] font-mono text-slate-400">#{{ $user->id }}</span>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600 flex items-center justify-center shadow-sm flex-shrink-0">
                                    <span class="text-[10px] font-bold text-white">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-medium text-slate-700 dark:text-slate-200 truncate max-w-[120px]">{{ $user->name }}</p>
                                    <p class="text-[9px] text-slate-400 md:hidden truncate max-w-[100px]">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-2 hidden md:table-cell">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-xs text-slate-600 dark:text-slate-300">{{ $user->email }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full text-[9px] font-semibold
                                {{ $user->role === 'admin' ? 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400' : 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' }}">
                                <span class="w-1 h-1 rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-indigo-500' : 'bg-emerald-500' }}"></span>
                                {{ $user->role === 'admin' ? 'Administrateur' : 'Utilisateur' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 hidden lg:table-cell">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-[10px] text-slate-500 dark:text-slate-400">{{ $user->created_at->format('d/m/Y') }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.users.edit', $user) }}" 
                                    class="p-1 rounded text-slate-400 hover:text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/30 transition"
                                    title="Modifier">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                    onsubmit="return confirm('Supprimer cet utilisateur ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                        class="p-1 rounded text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 transition"
                                        title="Supprimer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-12 h-12 bg-slate-100 dark:bg-slate-700/50 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Aucun utilisateur trouvé</p>
                                <a href="{{ route('admin.users.create') }}" 
                                    class="mt-1 inline-flex items-center gap-1 px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-medium rounded-lg transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Ajouter un utilisateur
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mini stats compactes -->
    @if($users->count() > 0)
    <div class="grid grid-cols-2 gap-2">
        <div class="bg-indigo-50 dark:bg-indigo-950/20 rounded-lg p-2 text-center border border-indigo-100 dark:border-indigo-800/30">
            <div class="flex items-center justify-center gap-1.5">
                <div class="w-5 h-5 rounded-full bg-indigo-500 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-bold text-indigo-600 dark:text-indigo-400">
                        {{ $users->where('role', 'admin')->count() }}
                    </div>
                    <div class="text-[9px] font-medium text-indigo-600 dark:text-indigo-400">Administrateurs</div>
                </div>
            </div>
        </div>
        <div class="bg-emerald-50 dark:bg-emerald-950/20 rounded-lg p-2 text-center border border-emerald-100 dark:border-emerald-800/30">
            <div class="flex items-center justify-center gap-1.5">
                <div class="w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <div class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                        {{ $users->where('role', 'user')->count() }}
                    </div>
                    <div class="text-[9px] font-medium text-emerald-600 dark:text-emerald-400">Utilisateurs</div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection