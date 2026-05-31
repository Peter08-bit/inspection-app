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
                    fontFamily: { 'sans': ['Inter', 'system-ui', '-apple-system', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <style>
        * { font-family: 'Inter', system-ui, sans-serif; -webkit-font-smoothing: antialiased; }
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .dark ::-webkit-scrollbar-thumb { background: #475569; }
        .sidebar-link { display: flex !important; align-items: center !important; gap: 0.75rem !important; width: 100% !important; }
        .sidebar-link svg { flex-shrink: 0 !important; }
        .sidebar-link span { flex: 1 !important; text-align: left !important; white-space: nowrap !important; }
        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0,0,0,0.5); backdrop-filter: blur(4px);
            z-index: 1000; display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        .modal-overlay.active { opacity: 1; visibility: visible; }
        .modal-container { transform: scale(0.95); transition: transform 0.3s ease; }
        .modal-overlay.active .modal-container { transform: scale(1); }
        #chat-drawer { transition: transform 0.3s cubic-bezier(0.4,0,0.2,1); transform: translateX(100%); }
        #chat-drawer.open { transform: translateX(0); }
        #chat-fab-btn { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        #chat-fab-btn:hover { transform: scale(1.08); }
        .chat-msg-bubble { max-width: 75%; word-break: break-word; }
        .chat-input-area { border-top: 0.5px solid #e2e8f0; }
        .dark .chat-input-area { border-top-color: #334155; }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-gradient-to-br from-slate-50 via-slate-50 to-slate-100 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 text-slate-800 dark:text-slate-100 transition-colors duration-300">
<div class="flex h-screen overflow-hidden">

    <!-- ===== SIDEBAR ===== -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-56 bg-white dark:bg-slate-800 border-r border-slate-200 dark:border-slate-700 shadow-xl lg:shadow-none transform -translate-x-full lg:translate-x-0 transition-all duration-300 flex flex-col">
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

        <nav class="flex-1 px-3 py-4 space-y-4 overflow-y-auto">
            @if(auth()->user()->role === 'admin')
            <div class="space-y-1">
                <p class="text-[9px] font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">Administration</p>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    <span class="text-xs font-medium">Tableau de bord</span>
                </a>
                <a href="{{ route('admin.materiels.index') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.materiels.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    <span class="text-xs font-medium">Matériels</span>
                </a>
                <a href="{{ route('admin.inspections.index') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.inspections.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-xs font-medium">Inspections</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="text-xs font-medium">Utilisateurs</span>
                </a>
            </div>
            @else
            <div class="space-y-1">
                <p class="text-[9px] font-semibold text-slate-400 uppercase tracking-wider px-2 mb-2">Menu principal</p>
                <a href="{{ route('user.dashboard') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    <span class="text-xs font-medium">Tableau de bord</span>
                </a>
                <a href="{{ route('user.materiels') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.materiels') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    <span class="text-xs font-medium">Matériels</span>
                </a>
                <a href="{{ route('user.inspections') }}" class="sidebar-link group px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.inspections') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:text-primary-600' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-xs font-medium">Mes Inspections</span>
                </a>
            </div>
            @endif
        </nav>

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

    <!-- ===== MAIN CONTENT ===== -->
    <div class="flex-1 flex flex-col lg:ml-56 overflow-hidden">
        <header class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm sticky top-0 z-40 px-4 py-2 flex items-center justify-between border-b border-slate-200 dark:border-slate-700 shadow-sm">
            <button id="sidebar-toggle" class="lg:hidden p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <div class="flex-1 lg:flex-none">
                <h2 class="text-base font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-slate-100 dark:to-slate-300 bg-clip-text text-transparent">@yield('page-title', 'Dashboard')</h2>
            </div>
            <div class="flex items-center gap-2">
                <button id="theme-toggle" class="p-1.5 rounded-lg bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <svg id="icon-sun" class="w-3.5 h-3.5 text-amber-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg id="icon-moon" class="w-3.5 h-3.5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
                <button type="button" id="logout-btn" class="flex items-center gap-1 px-2.5 py-1 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/30 transition-all text-xs font-medium border border-red-200 dark:border-red-800/30">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span class="hidden sm:inline">Quitter</span>
                </button>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 lg:p-5">
            @if(session('success'))
            <div class="alert-auto-close mb-4 p-3 bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 rounded-r-lg text-emerald-700 dark:text-emerald-300 flex items-center gap-2 text-sm">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert-auto-close mb-4 p-3 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-lg text-red-700 dark:text-red-300 flex items-center gap-2 text-sm">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<!-- ===================================================== -->
<!-- CHAT FLOTTANT                                         -->
<!-- ===================================================== -->

<!-- Bouton FAB -->
<button id="chat-fab-btn" onclick="toggleDrawer()" aria-label="Messages"
    style="position:fixed;bottom:24px;right:24px;z-index:9999;width:54px;height:54px;border-radius:50%;background:#6366f1;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(99,102,241,0.5);">
    <i class="ti ti-message-circle" style="font-size:26px;color:white;" aria-hidden="true"></i>
    <span id="fab-badge" style="display:none;position:absolute;top:-3px;right:-3px;min-width:20px;height:20px;background:#ef4444;border-radius:10px;font-size:11px;font-weight:500;color:white;border:2px solid white;align-items:center;justify-content:center;padding:0 4px;">0</span>
</button>

<!-- Drawer -->
<div id="chat-drawer"
    style="position:fixed;top:0;right:0;bottom:0;width:360px;z-index:9998;display:flex;flex-direction:column;overflow:hidden;transform:translateX(100%);transition:transform 0.3s cubic-bezier(0.4,0,0.2,1);box-shadow:-4px 0 24px rgba(0,0,0,0.15);">

    <!-- VUE 1 : Liste des utilisateurs -->
    <div id="view-users" style="display:flex;flex-direction:column;height:100%;">
        <!-- Header -->
        <div id="dh-users" style="padding:14px 16px;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;border-bottom:0.5px solid #e2e8f0;">
            <div>
                <p style="font-size:15px;font-weight:500;margin:0;">Messages</p>
                <p id="drawer-unread-text" style="font-size:11px;margin:0;color:#64748b;"></p>
            </div>
            <button onclick="toggleDrawer()" style="background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;">
                <i class="ti ti-x" style="font-size:18px;color:#64748b;" aria-hidden="true"></i>
            </button>
        </div>

        <!-- Recherche -->
        <div style="padding:10px 12px;flex-shrink:0;border-bottom:0.5px solid #f1f5f9;">
            <div style="position:relative;">
                <i class="ti ti-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);font-size:14px;color:#94a3b8;" aria-hidden="true"></i>
                <input type="text" id="user-search" placeholder="Rechercher un utilisateur..." oninput="filterUsers(this.value)"
                    style="width:100%;padding:7px 10px 7px 32px;border:0.5px solid #e2e8f0;border-radius:8px;font-size:13px;background:#f8fafc;outline:none;box-sizing:border-box;">
            </div>
        </div>

        <!-- Liste -->
        <div id="users-list" style="flex:1;overflow-y:auto;padding:8px;"></div>

        <!-- Chat Général -->
        <div style="padding:10px 12px;flex-shrink:0;border-top:0.5px solid #e2e8f0;">
            <button onclick="openGroupChat()"
                style="width:100%;background:#6366f1;border:none;border-radius:8px;padding:10px 14px;display:flex;align-items:center;gap:8px;cursor:pointer;">
                <i class="ti ti-users" style="font-size:16px;color:white;" aria-hidden="true"></i>
                <span style="font-size:13px;color:white;font-weight:500;">Chat Général</span>
                <span id="group-badge" style="display:none;margin-left:auto;background:#ef4444;border-radius:8px;padding:1px 6px;font-size:11px;color:white;font-weight:500;">0</span>
            </button>
        </div>
    </div>

    <!-- VUE 2 : Chat (privé ou groupe) -->
    <div id="view-chat" style="display:none;flex-direction:column;height:100%;">
        <!-- Header chat -->
        <div id="dh-chat" style="padding:12px 14px;display:flex;align-items:center;gap:10px;flex-shrink:0;border-bottom:0.5px solid #e2e8f0;">
            <button onclick="backToUsers()" style="background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;">
                <i class="ti ti-arrow-left" style="font-size:18px;color:#64748b;" aria-hidden="true"></i>
            </button>
            <div id="chat-avatar" style="width:34px;height:34px;border-radius:50%;background:#e0e7ff;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:#4338ca;flex-shrink:0;"></div>
            <div style="flex:1;min-width:0;">
                <p id="chat-name" style="font-size:14px;font-weight:500;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"></p>
                <p id="chat-status" style="font-size:11px;margin:0;color:#64748b;"></p>
            </div>
            <button onclick="toggleDrawer()" style="background:none;border:none;cursor:pointer;padding:4px;display:flex;align-items:center;">
                <i class="ti ti-x" style="font-size:18px;color:#64748b;" aria-hidden="true"></i>
            </button>
        </div>

        <!-- Messages -->
        <div id="chat-messages" style="flex:1;overflow-y:auto;padding:12px;display:flex;flex-direction:column;gap:8px;"></div>

        <!-- Input -->
        <div style="padding:10px 12px;flex-shrink:0;border-top:0.5px solid #e2e8f0;">
            <div style="display:flex;gap:8px;align-items:center;">
                <input type="text" id="chat-input" placeholder="Écrire un message..."
                    style="flex:1;padding:8px 12px;border:0.5px solid #e2e8f0;border-radius:20px;font-size:13px;background:#f8fafc;outline:none;"
                    onkeypress="if(event.key==='Enter') sendChatMessage()">
                <button onclick="sendChatMessage()"
                    style="width:36px;height:36px;border-radius:50%;background:#6366f1;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="ti ti-send" style="font-size:16px;color:white;" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Overlay -->
<div id="drawer-overlay" onclick="toggleDrawer()"
    style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.25);z-index:9997;backdrop-filter:blur(2px);"></div>

<!-- ===================================================== -->
<!-- MODAL DÉCONNEXION                                     -->
<!-- ===================================================== -->
<div id="logout-modal" class="modal-overlay">
    <div class="modal-container bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
        <div class="relative bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-12 -mt-12"></div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">Déconnexion</h3>
                    <p class="text-red-200 text-xs mt-0.5">Confirmation requise</p>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-700 dark:text-slate-200">Êtes-vous sûr de vouloir vous déconnecter ?</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Vous devrez vous reconnecter pour accéder à votre compte.</p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-900/50 flex gap-3 justify-end">
            <button id="modal-cancel" class="px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all text-sm font-medium">Annuler</button>
            <button id="modal-confirm" class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold transition-all flex items-center gap-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Se déconnecter
            </button>
        </div>
    </div>
</div>

<script>
const CURRENT_USER_ID = {{ auth()->id() }};
const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

/* ---- THEME ---- */
const htmlEl = document.documentElement;
function updateIcons() {
    const isDark = htmlEl.classList.contains('dark');
    document.getElementById('icon-sun')?.classList.toggle('hidden', !isDark);
    document.getElementById('icon-moon')?.classList.toggle('hidden', isDark);
    applyDrawerTheme();
}
updateIcons();
document.getElementById('theme-toggle')?.addEventListener('click', () => {
    htmlEl.classList.toggle('dark');
    localStorage.setItem('theme', htmlEl.classList.contains('dark') ? 'dark' : 'light');
    updateIcons();
});

/* ---- SIDEBAR ---- */
const sidebarToggle = document.getElementById('sidebar-toggle');
const sidebar = document.getElementById('sidebar');
sidebarToggle?.addEventListener('click', () => sidebar.classList.toggle('-translate-x-full'));
document.addEventListener('click', e => {
    if (window.innerWidth < 1024 && sidebar && !sidebar.classList.contains('-translate-x-full')) {
        if (!sidebar.contains(e.target) && !sidebarToggle?.contains(e.target)) sidebar.classList.add('-translate-x-full');
    }
});

/* ---- LOGOUT ---- */
const logoutModal = document.getElementById('logout-modal');
const logoutForm = document.getElementById('logout-form');
function openModal() { logoutModal.classList.add('active'); document.body.style.overflow = 'hidden'; }
function closeModal() { logoutModal.classList.remove('active'); document.body.style.overflow = ''; }
document.getElementById('logout-btn')?.addEventListener('click', openModal);
document.getElementById('modal-cancel')?.addEventListener('click', closeModal);
document.getElementById('modal-confirm')?.addEventListener('click', () => logoutForm.submit());
logoutModal?.addEventListener('click', e => { if (e.target === logoutModal) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeModal(); closeDrawer(); } });

/* ---- ALERTS ---- */
setTimeout(() => {
    document.querySelectorAll('.alert-auto-close').forEach(el => {
        el.style.transition = 'opacity 0.3s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 300);
    });
}, 4000);

/* ================================================================ */
/* CHAT SYSTEM                                                       */
/* ================================================================ */
let drawerOpen = false;
let currentChatType = null; // 'private' | 'group'
let currentReceiverId = null;
let currentConversationId = null;
let allUsers = [];

function applyDrawerTheme() {
    const isDark = htmlEl.classList.contains('dark');
    const drawer = document.getElementById('chat-drawer');
    drawer.style.background = isDark ? '#1e293b' : 'white';
    drawer.style.color = isDark ? '#f1f5f9' : '#1e293b';
    const borders = drawer.querySelectorAll('[data-border]');
    borders.forEach(el => el.style.borderColor = isDark ? '#334155' : '#e2e8f0');
}

function toggleDrawer() { drawerOpen ? closeDrawer() : openDrawer(); }

function openDrawer() {
    drawerOpen = true;
    const drawer = document.getElementById('chat-drawer');
    drawer.style.transform = 'translateX(0)';
    document.getElementById('drawer-overlay').style.display = 'block';
    applyDrawerTheme();
    showUsersView();
    loadUsers();
}

function closeDrawer() {
    drawerOpen = false;
    document.getElementById('chat-drawer').style.transform = 'translateX(100%)';
    document.getElementById('drawer-overlay').style.display = 'none';
}

function showUsersView() {
    document.getElementById('view-users').style.display = 'flex';
    document.getElementById('view-chat').style.display = 'none';
}

function showChatView() {
    document.getElementById('view-users').style.display = 'none';
    document.getElementById('view-chat').style.display = 'flex';
}

function backToUsers() {
    currentChatType = null;
    currentReceiverId = null;
    showUsersView();
    loadUsers();
}

/* ---- Ouvrir chat privé ---- */
function openPrivateChat(userId, userName, userOnline) {
    currentChatType = 'private';
    currentReceiverId = userId;

    const initials = userName.substring(0, 2).toUpperCase();
    document.getElementById('chat-avatar').textContent = initials;
    document.getElementById('chat-name').textContent = userName;
    document.getElementById('chat-status').textContent = userOnline ? '● En ligne' : 'Hors ligne';
    document.getElementById('chat-status').style.color = userOnline ? '#22c55e' : '#94a3b8';

    showChatView();
    loadPrivateMessages(userId);
    markAsRead(userId);
}

/* ---- Ouvrir chat général ---- */
function openGroupChat() {
    currentChatType = 'group';
    currentReceiverId = null;

    document.getElementById('chat-avatar').textContent = '💬';
    document.getElementById('chat-avatar').style.background = '#e0e7ff';
    document.getElementById('chat-name').textContent = 'Chat Général';
    document.getElementById('chat-status').textContent = 'Tous les membres';
    document.getElementById('chat-status').style.color = '#6366f1';

    showChatView();
    loadGroupMessages();
}

/* ---- Charger messages privés ---- */
function loadPrivateMessages(userId) {
    const container = document.getElementById('chat-messages');
    container.innerHTML = '<div style="text-align:center;color:#94a3b8;font-size:12px;padding:20px;">Chargement...</div>';

    fetch(`/chat/messages/prive/${userId}`)
        .then(r => r.json())
        .then(data => {
            renderMessages(data.messages || []);
        })
        .catch(() => {
            container.innerHTML = '<div style="text-align:center;color:#ef4444;font-size:12px;padding:20px;">Erreur de chargement</div>';
        });
}

/* ---- Charger messages groupe ---- */
function loadGroupMessages() {
    const container = document.getElementById('chat-messages');
    container.innerHTML = '<div style="text-align:center;color:#94a3b8;font-size:12px;padding:20px;">Chargement...</div>';

    fetch('/chat/messages/groupe')
        .then(r => r.json())
        .then(data => {
            renderMessages(data.messages || []);
        })
        .catch(() => {
            container.innerHTML = '<div style="text-align:center;color:#ef4444;font-size:12px;padding:20px;">Erreur de chargement</div>';
        });
}

/* ---- Render messages ---- */
function renderMessages(messages) {
    const container = document.getElementById('chat-messages');
    const isDark = htmlEl.classList.contains('dark');

    if (!messages.length) {
        container.innerHTML = '<div style="text-align:center;color:#94a3b8;font-size:12px;padding:20px;">Aucun message. Commencez la conversation !</div>';
        return;
    }

    container.innerHTML = messages.map(msg => {
        const isMine = msg.sender_id === CURRENT_USER_ID;
        const bubbleBg = isMine ? '#6366f1' : (isDark ? '#334155' : '#f1f5f9');
        const bubbleColor = isMine ? 'white' : (isDark ? '#f1f5f9' : '#1e293b');
        const align = isMine ? 'flex-end' : 'flex-start';

        return `
        <div style="display:flex;flex-direction:column;align-items:${align};gap:2px;">
            ${!isMine && currentChatType === 'group' ? `<span style="font-size:10px;color:#94a3b8;margin-left:4px;">${msg.sender_name || ''}</span>` : ''}
            <div style="max-width:75%;background:${bubbleBg};color:${bubbleColor};padding:8px 12px;border-radius:${isMine ? '16px 16px 4px 16px' : '16px 16px 16px 4px'};font-size:13px;line-height:1.4;word-break:break-word;">
                ${msg.content}
            </div>
            <span style="font-size:10px;color:#94a3b8;">${msg.created_at}</span>
        </div>`;
    }).join('');

    container.scrollTop = container.scrollHeight;
}

/* ---- Ajouter un message localement ---- */
function appendMessage(content, isMine, senderName) {
    const container = document.getElementById('chat-messages');
    const isDark = htmlEl.classList.contains('dark');
    const bubbleBg = isMine ? '#6366f1' : (isDark ? '#334155' : '#f1f5f9');
    const bubbleColor = isMine ? 'white' : (isDark ? '#f1f5f9' : '#1e293b');
    const align = isMine ? 'flex-end' : 'flex-start';
    const now = new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });

    const div = document.createElement('div');
    div.style.cssText = `display:flex;flex-direction:column;align-items:${align};gap:2px;`;
    div.innerHTML = `
        ${!isMine && currentChatType === 'group' && senderName ? `<span style="font-size:10px;color:#94a3b8;margin-left:4px;">${senderName}</span>` : ''}
        <div style="max-width:75%;background:${bubbleBg};color:${bubbleColor};padding:8px 12px;border-radius:${isMine ? '16px 16px 4px 16px' : '16px 16px 16px 4px'};font-size:13px;line-height:1.4;word-break:break-word;">
            ${content}
        </div>
        <span style="font-size:10px;color:#94a3b8;">${now}</span>`;

    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
}

/* ---- Envoyer message ---- */
function sendChatMessage() {
    const input = document.getElementById('chat-input');
    const content = input.value.trim();
    if (!content) return;

    input.value = '';
    appendMessage(content, true, null);

    const url = currentChatType === 'group'
        ? '/chat/groupe/envoyer'
        : `/chat/prive/${currentReceiverId}/envoyer`;

    fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
        body: JSON.stringify({ content }),
    }).catch(() => {});
}

/* ---- Marquer comme lu ---- */
function markAsRead(userId) {
    fetch(`/chat/marquer-lu/${userId}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
    }).catch(() => {});
}

/* ---- Filtrer utilisateurs ---- */
function filterUsers(query) {
    renderUsers(allUsers.filter(u => u.name.toLowerCase().includes(query.toLowerCase())));
}

/* ---- Render utilisateurs ---- */
function renderUsers(users) {
    const list = document.getElementById('users-list');
    const isDark = htmlEl.classList.contains('dark');

    if (!users.length) {
        list.innerHTML = '<div style="padding:20px;text-align:center;color:#94a3b8;font-size:13px;">Aucun utilisateur</div>';
        return;
    }

    list.innerHTML = users.map(user => `
        <div onclick="openPrivateChat(${user.id}, '${user.name.replace(/'/g, "\\'")}', ${user.online})"
            style="padding:10px 8px;border-radius:8px;display:flex;align-items:center;gap:10px;cursor:pointer;margin-bottom:2px;transition:background 0.15s;${user.unread > 0 ? 'background:' + (isDark ? '#1e3a5f' : '#f0f4ff') + ';' : ''}"
            onmouseover="this.style.background='${isDark ? '#1e3a5f' : '#f8fafc'}'"
            onmouseout="this.style.background='${user.unread > 0 ? (isDark ? '#1e3a5f' : '#f0f4ff') : 'transparent'}'">
            <div style="position:relative;flex-shrink:0;">
                <div style="width:38px;height:38px;border-radius:50%;background:#e0e7ff;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:500;color:#4338ca;">
                    ${user.initials}
                </div>
                ${user.online ? `<div style="position:absolute;bottom:0;right:0;width:10px;height:10px;background:#22c55e;border-radius:50%;border:2px solid ${isDark ? '#1e293b' : 'white'};"></div>` : ''}
            </div>
            <div style="flex:1;min-width:0;">
                <p style="font-size:13px;font-weight:${user.unread > 0 ? '500' : '400'};margin:0;color:${isDark ? '#f1f5f9' : '#1e293b'};white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${user.name}</p>
                <p style="font-size:11px;color:${user.online ? '#22c55e' : '#94a3b8'};margin:0;">${user.online ? '● En ligne' : 'Hors ligne'}</p>
            </div>
            ${user.unread > 0 ? `<div style="min-width:18px;height:18px;background:#ef4444;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:10px;color:white;font-weight:500;flex-shrink:0;padding:0 4px;">${user.unread > 99 ? '99+' : user.unread}</div>` : ''}
        </div>
    `).join('');
}

/* ---- Charger utilisateurs ---- */
function loadUsers() {
    fetch('/chat/users-statut')
        .then(r => r.json())
        .then(data => {
            allUsers = data.users || [];
            renderUsers(allUsers);
            const unreadText = document.getElementById('drawer-unread-text');
            if (unreadText) unreadText.textContent = data.total_unread > 0 ? data.total_unread + ' non lu(s)' : 'Tous lus';
        }).catch(() => {});
}

/* ---- Badge FAB ---- */
function updateFabBadge() {
    fetch('/chat/non-lus')
        .then(r => r.json())
        .then(data => {
            const badge = document.getElementById('fab-badge');
            if (data.count > 0) {
                badge.textContent = data.count > 99 ? '99+' : data.count;
                badge.style.display = 'flex';
            } else {
                badge.style.display = 'none';
            }
        }).catch(() => {});
}

updateFabBadge();
setInterval(updateFabBadge, 15000);
</script>
@stack('scripts')
</body>
</html>