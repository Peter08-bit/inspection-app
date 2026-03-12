@extends('layouts.app')
@section('title', isset($materiel) ? 'Modifier Matériel' : 'Nouveau Matériel')
@section('page-title', isset($materiel) ? 'Modifier le Matériel' : 'Nouveau Matériel')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900">
            <h3 class="font-semibold text-gray-800 dark:text-white">
                {{ isset($materiel) ? 'Modifier le matériel' : 'Ajouter un nouveau matériel' }}
            </h3>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl text-red-600 dark:text-red-400 text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ isset($materiel) ? route('admin.materiels.update', $materiel) : route('admin.materiels.store') }}" class="space-y-5">
                @csrf
                @if(isset($materiel)) @method('PUT') @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nom du matériel *</label>
                        <input type="text" name="nom" value="{{ old('nom', $materiel->nom ?? '') }}" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                            placeholder="Ex: Ordinateur portable">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Numéro de série *</label>
                        <input type="text" name="numero_serie" value="{{ old('numero_serie', $materiel->numero_serie ?? '') }}" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                            placeholder="Ex: SN-2024-0001">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Catégorie *</label>
                        <select name="categorie" required class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                            <option value="">— Sélectionner —</option>
                            @foreach(['Informatique', 'Électronique', 'Mécanique', 'Mobilier', 'Véhicule', 'Outillage', 'Autre'] as $cat)
                                <option value="{{ $cat }}" {{ old('categorie', $materiel->categorie ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Localisation</label>
                        <input type="text" name="localisation" value="{{ old('localisation', $materiel->localisation ?? '') }}"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                            placeholder="Ex: Bureau 3, Salle A">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">État *</label>
                        <select name="etat" required class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                            <option value="bon" {{ old('etat', $materiel->etat ?? '') == 'bon' ? 'selected' : '' }}>Bon</option>
                            <option value="a_verifier" {{ old('etat', $materiel->etat ?? '') == 'a_verifier' ? 'selected' : '' }}>À vérifier</option>
                            <option value="defectueux" {{ old('etat', $materiel->etat ?? '') == 'defectueux' ? 'selected' : '' }}>Défectueux</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Date d'achat</label>
                        <input type="date" name="date_achat" value="{{ old('date_achat', isset($materiel) ? $materiel->date_achat?->format('Y-m-d') : '') }}"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Marque / Fabricant</label>
                        <input type="text" name="marque" value="{{ old('marque', $materiel->marque ?? '') }}"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                            placeholder="Ex: Dell, Bosch...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Responsable</label>
                        <input type="text" name="responsable" value="{{ old('responsable', $materiel->responsable ?? '') }}"
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition"
                            placeholder="Nom du responsable">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Description / Observations</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition resize-none"
                        placeholder="Informations complémentaires...">{{ old('description', $materiel->description ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 px-6 rounded-xl transition duration-200 shadow-md shadow-orange-200 dark:shadow-none flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ isset($materiel) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                    <a href="{{ route('admin.materiels.index') }}" class="py-2.5 px-6 border-2 border-gray-200 dark:border-gray-600 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
