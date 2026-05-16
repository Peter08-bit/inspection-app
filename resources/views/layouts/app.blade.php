<!DOCTYPE html>
<html lang="fr" class="h-full" x-data>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inspection Matériels') — GIM Pro</title>
    <script>
        if (localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc',
                            400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca',
                            800: '#3730a3', 900: '#312e81',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', system-ui, sans-serif; -webkit-font-smoothing: antialiased; }
        
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        
        .sidebar-link {
            display: flex !important;
            align-items: center !important;
            gap: 0.75rem !important;
            width: 100% !important;
        }
        
        .sidebar-link svg {
            flex-shrink: 0 !important;
        }
        
        .sidebar-link span {
            flex: 1 !important;
            text-align: left !important;
            white-space: nowrap !important;
        }
        
        /* Modal overlay */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .modal-container {
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        
        .modal-overlay.active .modal-container {
            transform: scale(1);
        }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-gradient-to-br from-slate-50 via-slate-50 to-slate-100 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 text-slate-800 dark:text-slate-100 transition-colors duration-300">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Compact -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-56 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 shadow-xl lg:shadow-none transform -translate-x-full lg:translate-x-0 transition-all duration-300 flex flex-col">
            <!-- Logo Section Compact -->
            <div class="px-4 py-4 border-b border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-sm">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-sm tracking-tight bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent">GIM Pro</h1>
                        <p class="text-[9px] text-slate-400">Inspection</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Compacte -->
            <nav class="flex-1 px-3 py-4 space-y-4 overflow-y-auto">
                @if(auth()->user()->role === 'admin')
                <div class="space-y-1">
                    <p class="text-[9px] font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">Administration</p>
                    
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        <span class="text-xs font-medium">Tableau de bord</span>
                    </a>
                    
                    <a href="{{ route('admin.materiels.index') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.materiels.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        <span class="text-xs font-medium">Matériels</span>
                    </a>
                    
                    <a href="{{ route('admin.inspections.index') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.inspections.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs font-medium">Inspections</span>
                    </a>
                    
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span class="text-xs font-medium">Utilisateurs</span>
                    </a>
                </div>
                @else
                <div class="space-y-1">
                    <p class="text-[9px] font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">Menu principal</p>
                    
                    <a href="{{ route('user.dashboard') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                        <span class="text-xs font-medium">Tableau de bord</span>
                    </a>
                    
                    <a href="{{ route('user.materiels') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.materiels') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        <span class="text-xs font-medium">Matériels</span>
                    </a>
                    
                    <a href="{{ route('user.inspections') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.inspections') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs font-medium">Mes Inspections</span>
                    </a>
                </div>
                @endif
            </nav>

            <!-- User Info Compact -->
            <div class="px-3 py-3 mt-auto border-t border-slate-100 dark:border-slate-700">
                <div class="flex items-center gap-2 p-1.5 rounded-lg bg-slate-50 dark:bg-slate-700/50">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center shadow-sm">
                        <span class="text-[10px] font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-slate-700 dark:text-slate-200 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] text-primary-600 dark:text-primary-400 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-56 overflow-hidden">
            <!-- Top Navbar Compact -->
            <header class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm sticky top-0 z-40 px-4 py-2 flex items-center justify-between border-b border-slate-200 dark:border-slate-700 shadow-sm">
                <button id="sidebar-toggle" class="lg:hidden p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex-1 lg:flex-none">
                    <h2 class="text-base font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-slate-100 dark:to-slate-300 bg-clip-text text-transparent">@yield('page-title', 'Dashboard')</h2>
                </div>
                <div class="flex items-center gap-2">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                        <svg id="icon-sun" class="w-3.5 h-3.5 text-amber-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg id="icon-moon" class="w-3.5 h-3.5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <!-- Logout avec confirmation -->
                    <button type="button" id="logout-btn" class="flex items-center gap-1 px-2.5 py-1 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all text-xs font-medium border border-red-200 dark:border-red-800/30">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="hidden sm:inline">Quitter</span>
                    </button>
                    
                    <!-- Formulaire de déconnexion caché -->
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-5">
                @if(session('success'))
                <div class="alert-auto-close mb-4 p-3 bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 rounded-r-lg text-emerald-700 dark:text-emerald-300 flex items-center gap-2 text-sm">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert-auto-close mb-4 p-3 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-lg text-red-700 dark:text-red-300 flex items-center gap-2 text-sm">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Modal de confirmation de déconnexion -->
    <div id="logout-modal" class="modal-overlay">
        <div class="modal-container bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
            <!-- Header modal -->
            <div class="relative bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-12 -mt-12"></div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-white">Déconnexion</h3>
                        <p class="text-red-200 text-xs mt-0.5">Confirmation requise</p>
                    </div>
                </div>
            </div>
            
            <!-- Corps modal -->
            <div class="p-6">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                            Êtes-vous sûr de vouloir vous déconnecter ?
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                            Vous devrez vous reconnecter pour accéder à votre compte.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Footer modal -->
            <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 flex flex-col sm:flex-row gap-3 justify-end">
                <button id="modal-cancel" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all text-sm font-medium">
                    Annuler
                </button>
                <button id="modal-confirm" class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold transition-all shadow-md shadow-red-200 dark:shadow-none flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Se déconnecter
                </button>
            </div>
        </div>
    </div>

    <script>
    const themeToggle = document.getElementById('theme-toggle');
    const htmlEl = document.documentElement;
    
    function updateIcons() {
        const isDark = htmlEl.classList.contains('dark');
        const sunIcon = document.getElementById('icon-sun');
        const moonIcon = document.getElementById('icon-moon');
        if (sunIcon && moonIcon) {
            sunIcon.classList.toggle('hidden', !isDark);
            moonIcon.classList.toggle('hidden', isDark);
        }
    }
    
    updateIcons();
    
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            htmlEl.classList.toggle('dark');
            localStorage.setItem('theme', htmlEl.classList.contains('dark') ? 'dark' : 'light');
            updateIcons();
        });
    }
    
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    }
    
    document.addEventListener('click', function(event) {
        if (window.innerWidth < 1024 && sidebar && !sidebar.classList.contains('-translate-x-full')) {
            if (!sidebar.contains(event.target) && !sidebarToggle?.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
    
    // Gestion de la modal de déconnexion
    const logoutBtn = document.getElementById('logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const modalCancel = document.getElementById('modal-cancel');
    const modalConfirm = document.getElementById('modal-confirm');
    const logoutForm = document.getElementById('logout-form');
    
    function openModal() {
        logoutModal.classList.add('active');
        // Empêcher le scroll de la page
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        logoutModal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    function confirmLogout() {
        logoutForm.submit();
    }
    
    if (logoutBtn) {
        logoutBtn.addEventListener('click', openModal);
    }
    
    if (modalCancel) {
        modalCancel.addEventListener('click', closeModal);
    }
    
    if (modalConfirm) {
        modalConfirm.addEventListener('click', confirmLogout);
    }
    
    // Fermer la modal en cliquant à l'extérieur
    logoutModal.addEventListener('click', function(event) {
        if (event.target === logoutModal) {
            closeModal();
        }
    });
    
    // Fermer la modal avec la touche Echap
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && logoutModal.classList.contains('active')) {
            closeModal();
        }
    });
    
    setTimeout(() => {
        document.querySelectorAll('.alert-auto-close').forEach(el => {
            el.style.transition = 'opacity 0.3s ease-out';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 300);
        });
    }, 4000);
    </script>
    @stack('scripts')
</body>
</html>