@extends('layouts.app')
@section('title', isset($inspection) ? 'Modifier Inspection' : 'Nouvelle Inspection')
@section('page-title', isset($inspection) ? 'Modifier Inspection' : 'Nouvelle Inspection')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Formulaire moderne -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-xl overflow-hidden">
        <!-- Header avec gradient -->
        <div class="relative bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white">
                        {{ isset($inspection) ? 'Modifier l\'inspection' : 'Nouvelle inspection' }}
                    </h3>
                    <p class="text-indigo-200 text-xs mt-0.5">
                        {{ isset($inspection) ? 'Mettez à jour les informations de l\'inspection' : 'Renseignez les détails de l\'inspection' }}
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
                        @foreach($errors->all() as $error)<p class="text-xs">• {{ $error }}</p>@endforeach
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ isset($inspection) ? route('admin.inspections.update', $inspection) : route('admin.inspections.store') }}" class="space-y-6">
                @csrf
                @if(isset($inspection)) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Matériel -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Matériel <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="materiel_id" required 
                                class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition appearance-none">
                                <option value="">— Sélectionner un matériel —</option>
                                @foreach($materiels as $materiel)
                                    <option value="{{ $materiel->id }}" {{ old('materiel_id', $inspection->materiel_id ?? '') == $materiel->id ? 'selected' : '' }}>
                                        {{ $materiel->nom }} ({{ $materiel->numero_serie }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Inspecteur -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Inspecteur <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="user_id" required 
                                class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition appearance-none">
                                <option value="">— Sélectionner un inspecteur —</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $inspection->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Date d'inspection -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Date d'inspection <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" name="date_inspection" 
                                value="{{ old('date_inspection', isset($inspection) ? $inspection->date_inspection->format('Y-m-d') : date('Y-m-d')) }}" 
                                required
                                class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition">
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Statut -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Statut <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="statut" required 
                                class="w-full px-4 py-2.5 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition appearance-none">
                                <option value="en_attente" {{ old('statut', $inspection->statut ?? '') == 'en_attente' ? 'selected' : '' }}>
                                    ⏳ En attente
                                </option>
                                <option value="conforme" {{ old('statut', $inspection->statut ?? '') == 'conforme' ? 'selected' : '' }}>
                                    ✅ Conforme
                                </option>
                                <option value="non_conforme" {{ old('statut', $inspection->statut ?? '') == 'non_conforme' ? 'selected' : '' }}>
                                    ❌ Non conforme
                                </option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Observations -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                        Observations / Remarques
                    </label>
                    <textarea name="observations" rows="4"
                        class="w-full px-4 py-3 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 outline-none transition resize-none"
                        placeholder="Décrivez les observations lors de l'inspection...">{{ old('observations', $inspection->observations ?? '') }}</textarea>
                    <p class="text-xs text-slate-400 mt-1.5 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informations complémentaires sur l'état du matériel
                    </p>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row items-center gap-3 pt-4 border-t border-slate-100 dark:border-slate-700">
                    <button type="submit" 
                        class="w-full sm:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white font-semibold py-2.5 px-8 rounded-xl transition-all duration-200 shadow-md shadow-indigo-200 dark:shadow-none flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ isset($inspection) ? 'Mettre à jour' : 'Enregistrer l\'inspection' }}
                    </button>
                    <a href="{{ route('admin.inspections.index') }}" 
                        class="w-full sm:w-auto py-2.5 px-8 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 font-medium transition-all duration-200 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Information card (optionnel) -->
    @if(!isset($inspection))
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
                    Les inspections permettent de suivre l'état des matériels et d'identifier les éventuelles non-conformités.
                </p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection