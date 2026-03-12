@extends('layouts.auth')
@section('title', 'Connexion')
@section('content')
<h2 class="text-xl font-bold text-gray-800 dark:text-white mb-1">Bienvenue !</h2>
<p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Connectez-vous à votre compte</p>

@if($errors->any())
<div class="mb-4 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-lg text-red-600 dark:text-red-400 text-sm">
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Adresse e-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus
            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition outline-none"
            placeholder="vous@exemple.com">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Mot de passe</label>
        <input type="password" name="password" required
            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 transition outline-none"
            placeholder="••••••••">
    </div>
    <div class="flex items-center justify-between">
        <label class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 cursor-pointer">
            <input type="checkbox" name="remember" class="rounded border-gray-300 text-orange-500 focus:ring-orange-400">
            Se souvenir de moi
        </label>
    </div>
    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 px-4 rounded-xl transition duration-200 shadow-md shadow-orange-200 dark:shadow-none flex items-center justify-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
        Se connecter
    </button>
</form>

<div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700 text-center text-xs text-gray-400">
    <p class="font-medium text-gray-500 dark:text-gray-400 mb-1">Comptes de démo :</p>
    <p>Admin : <span class="text-orange-500">admin@gim.com</span> / <span class="text-orange-500">password</span></p>
    <p>User : <span class="text-orange-500">user@gim.com</span> / <span class="text-orange-500">password</span></p>
</div>
@endsection
