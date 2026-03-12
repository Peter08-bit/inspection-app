@extends('layouts.app')
@section('title', 'Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
    <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900 flex items-center justify-between">
        <h3 class="font-semibold text-gray-800 dark:text-white">Liste des utilisateurs</h3>
        <a href="{{ route('admin.users.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-xl transition shadow-md shadow-orange-200 dark:shadow-none flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouvel Utilisateur
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-orange-50 dark:bg-orange-900/20 text-left">
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Nom</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Email</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Rôle</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300">Inscrit le</th>
                    <th class="px-6 py-3 font-semibold text-gray-600 dark:text-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($users as $user)
                <tr class="hover:bg-orange-50/40 dark:hover:bg-orange-900/10 transition">
                    <td class="px-6 py-3 text-gray-400">{{ $user->id }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-orange-100 dark:bg-orange-900/50 flex items-center justify-center text-orange-600 dark:text-orange-400 font-bold text-xs">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                    <td class="px-6 py-3">
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-orange-100 dark:bg-orange-900/40 text-orange-700 dark:text-orange-400' : 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-400' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-1.5 rounded-lg bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 hover:bg-orange-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-1.5 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-gray-400 text-sm">Aucun utilisateur trouvé</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
