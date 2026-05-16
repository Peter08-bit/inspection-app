@extends('layouts.app')
@section('title', isset($materiel) ? 'Modifier Matériel' : 'Nouveau Matériel')
@section('page-title', isset($materiel) ? 'Modifier le Matériel' : 'Nouveau Matériel')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Formulaire moderne -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <!-- Header avec gradient -->
        <div class="relative bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">
                        {{ isset($materiel) ? 'Modifier le matériel' : 'Ajouter un nouveau matériel' }}
                    </h3>
                    <p class="text-indigo-200 text-xs mt-0.5">
                        {{ isset($materiel) ? 'Mettez à jour les informations du matériel' : 'Renseignez les détails du matériel' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8">
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-r-xl text-red-700 dark:text-red-300 text-sm">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="space-y-1">
                        <p class="font-medium">Veuillez corriger les erreurs suivantes :</p>
                        @foreach($errors->all() as $error)
                            <p class="text-xs">• {{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ isset($materiel) ? route('admin.materiels.update', $materiel) : route('admin.materiels.store') }}" class="space-y-6">
                @csrf
                @if(isset($materiel)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom du matériel -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Nom du matériel <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="nom" value="{{ old('nom', $materiel->nom ?? '') }}" required
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                                placeholder="Ex: Ordinateur portable">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Numéro de série -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Numéro de série <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" name="numero_serie" value="{{ old('numero_serie', $materiel->numero_serie ?? '') }}" required
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                                placeholder="Ex: SN-2024-0001">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20h10M5 8h14M5 4h14M5 12h14M5 16h10"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Catégorie -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Catégorie <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="categorie" required 
                                class="w-full pl-10 pr-8 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition appearance-none cursor-pointer">
                                <option value="">— Sélectionner —</option>
                                @foreach(['Informatique', 'Électronique', 'Mécanique', 'Mobilier', 'Véhicule', 'Outillage', 'Autre'] as $cat)
                                    <option value="{{ $cat }}" {{ old('categorie', $materiel->categorie ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Localisation
                        </label>
                        <div class="relative">
                            <input type="text" name="localisation" value="{{ old('localisation', $materiel->localisation ?? '') }}"
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                                placeholder="Ex: Bureau 3, Salle A">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- État -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            État <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="etat" required 
                                class="w-full pl-10 pr-8 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition appearance-none cursor-pointer">
                                <option value="bon" {{ old('etat', $materiel->etat ?? '') == 'bon' ? 'selected' : '' }}>✅ Bon état</option>
                                <option value="a_verifier" {{ old('etat', $materiel->etat ?? '') == 'a_verifier' ? 'selected' : '' }}>🔍 À vérifier</option>
                                <option value="defectueux" {{ old('etat', $materiel->etat ?? '') == 'defectueux' ? 'selected' : '' }}>⚠️ Défectueux</option>
                            </select>
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Date d'achat -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Date d'achat
                        </label>
                        <div class="relative">
                            <input type="date" name="date_achat" value="{{ old('date_achat', isset($materiel) ? $materiel->date_achat?->format('Y-m-d') : '') }}"
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Marque -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Marque / Fabricant
                        </label>
                        <div class="relative">
                            <input type="text" name="marque" value="{{ old('marque', $materiel->marque ?? '') }}"
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                                placeholder="Ex: Dell, Bosch...">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Responsable -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Responsable
                        </label>
                        <div class="relative">
                            <input type="text" name="responsable" value="{{ old('responsable', $materiel->responsable ?? '') }}"
                                class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition"
                                placeholder="Nom du responsable">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Description / Observations
                    </label>
                    <div class="relative">
                        <textarea name="description" rows="3"
                            class="w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition resize-none"
                            placeholder="Informations complémentaires...">{{ old('description', $materiel->description ?? '') }}</textarea>
                        <div class="absolute top-3 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 mt-1.5 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informations supplémentaires sur le matériel
                    </p>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit" 
                        class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-2.5 px-8 rounded-xl transition-all duration-200 shadow-md shadow-indigo-200 dark:shadow-none flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ isset($materiel) ? 'Mettre à jour' : 'Enregistrer le matériel' }}
                    </button>
                    <a href="{{ route('admin.materiels.index') }}" 
                        class="w-full sm:w-auto py-2.5 px-8 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 font-medium transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Information card -->
    @if(!isset($materiel))
    <div class="mt-4 p-4 bg-indigo-50 dark:bg-indigo-950/20 rounded-xl border border-indigo-100 dark:border-indigo-800/30">
        <div class="flex items-start gap-3">
            <div class="w-6 h-6 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center flex-shrink-0">
                <svg class="w-3.5 h-3.5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-indigo-700 dark:text-indigo-300 font-medium">Bon à savoir</p>
                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-0.5">
                    Les champs marqués d'un <span class="text-red-500">*</span> sont obligatoires. Le numéro de série doit être unique.
                </p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection