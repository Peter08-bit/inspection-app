@extends('layouts.app')
@section('title', isset($user) ? 'Modifier Utilisateur' : 'Nouvel Utilisateur')
@section('page-title', isset($user) ? 'Modifier Utilisateur' : 'Nouvel Utilisateur')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900">
            <h3 class="font-semibold text-gray-800 dark:text-white">
                {{ isset($user) ? 'Modifier l\'utilisateur' : 'Créer un utilisateur' }}
            </h3>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl text-red-600 dark:text-red-400 text-sm space-y-1">
                @foreach($errors->all() as $error)<p>• {{ $error }}</p>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" class="space-y-5">
                @csrf
                @if(isset($user)) @method('PUT') @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required
                        class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                        placeholder="Prénom Nom">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Adresse e-mail *</label>
                    <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                        class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                        placeholder="email@exemple.com">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">
                        Mot de passe {{ isset($user) ? '(laisser vide pour conserver)' : '*' }}
                    </label>
                    <input type="password" name="password" {{ isset($user) ? '' : 'required' }}
                        class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                        placeholder="{{ isset($user) ? 'Nouveau mot de passe (optionnel)' : 'Minimum 8 caractères' }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Rôle *</label>
                    <select name="role" required class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    </select>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-md shadow-orange-200 dark:shadow-none flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ isset($user) ? 'Mettre à jour' : 'Créer l\'utilisateur' }}
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="py-2.5 px-6 border-2 border-gray-200 dark:border-gray-600 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
