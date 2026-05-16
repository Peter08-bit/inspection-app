@extends('layouts.auth')
@section('title', 'Connexion')
@section('content')
<div class="relative">
    <!-- Effet de fond décoratif -->
    <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-100 dark:bg-indigo-900/20 rounded-full blur-3xl opacity-40"></div>
    <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-emerald-100 dark:bg-emerald-900/20 rounded-full blur-3xl opacity-40"></div>
    
    <div class="relative">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-600 to-indigo-700 shadow-lg mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-1">Bienvenue</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">Connectez-vous à votre compte</p>
        </div>

        @if($errors->any())
        <div class="mb-5 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-xl text-red-700 dark:text-red-300 text-sm">
            <div class="flex items-start gap-2">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="space-y-1">
                    <p class="font-medium">Erreur d'authentification</p>
                    @foreach($errors->all() as $error)
                        <p class="text-xs">• {{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            
            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Adresse e-mail
                </label>
                <div class="relative">
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                        placeholder="vous@exemple.com">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Mot de passe -->
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                    Mot de passe
                </label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 pr-10 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                        placeholder="••••••••">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition">
                        <svg id="eyeIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 cursor-pointer group">
                    <input type="checkbox" name="remember" 
                        class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 cursor-pointer">
                    <span class="group-hover:text-slate-700 dark:group-hover:text-slate-300 transition">Se souvenir de moi</span>
                </label>
            </div>

            <!-- Bouton de connexion -->
            <button type="submit" 
                class="w-full bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-2.5 px-4 rounded-xl transition-all duration-200 shadow-md shadow-indigo-200 dark:shadow-none flex items-center justify-center gap-2 group">
                <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Se connecter
            </button>
        </form>

        <!-- Comptes de démo -->
        <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700">
            <div class="text-center">
                <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-3">
                    🔐 Comptes de démonstration
                </p>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-xs bg-slate-50 dark:bg-slate-800/50 rounded-lg p-2">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                                <span class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400">AD</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-slate-300">Administrateur</p>
                                <code class="text-[10px] text-slate-400">admin@gim.com</code>
                            </div>
                        </div>
                        <code class="text-[10px] text-slate-400 bg-white dark:bg-slate-700 px-2 py-0.5 rounded">password</code>
                    </div>
                    <div class="flex items-center justify-between text-xs bg-slate-50 dark:bg-slate-800/50 rounded-lg p-2">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                                <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">US</span>
                            </div>
                            <div>
                                <p class="font-medium text-slate-700 dark:text-slate-300">Utilisateur</p>
                                <code class="text-[10px] text-slate-400">user@gim.com</code>
                            </div>
                        </div>
                        <code class="text-[10px] text-slate-400 bg-white dark:bg-slate-700 px-2 py-0.5 rounded">password</code>
                    </div>
                </div>
                <p class="text-[10px] text-slate-400 mt-3">
                    Utilisez ces comptes pour tester l'application
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const eyeIcon = document.getElementById('eyeIcon');
            if (type === 'text') {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        });
    }
</script>
@endsection