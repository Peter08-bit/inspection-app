@extends('layouts.app')
@section('title', isset($inspection) ? 'Modifier Inspection' : 'Nouvelle Inspection')
@section('page-title', isset($inspection) ? 'Modifier Inspection' : 'Nouvelle Inspection')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl border-2 border-orange-200 dark:border-orange-800 shadow-sm">
        <div class="px-6 py-4 border-b border-orange-100 dark:border-orange-900">
            <h3 class="font-semibold text-gray-800 dark:text-white">
                {{ isset($inspection) ? 'Modifier l\'inspection' : 'Enregistrer une nouvelle inspection' }}
            </h3>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-xl text-red-600 dark:text-red-400 text-sm space-y-1">
                @foreach($errors->all() as $error)<p>• {{ $error }}</p>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ isset($inspection) ? route('admin.inspections.update', $inspection) : route('admin.inspections.store') }}" class="space-y-5">
                @csrf
                @if(isset($inspection)) @method('PUT') @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Matériel *</label>
                        <select name="materiel_id" required class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                            <option value="">— Sélectionner un matériel —</option>
                            @foreach($materiels as $materiel)
                                <option value="{{ $materiel->id }}" {{ old('materiel_id', $inspection->materiel_id ?? '') == $materiel->id ? 'selected' : '' }}>
                                    {{ $materiel->nom }} ({{ $materiel->numero_serie }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Inspecteur *</label>
                        <select name="user_id" required class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                            <option value="">— Sélectionner un inspecteur —</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $inspection->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Date d'inspection *</label>
                        <input type="date" name="date_inspection" value="{{ old('date_inspection', isset($inspection) ? $inspection->date_inspection->format('Y-m-d') : date('Y-m-d')) }}" required
                            class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Statut *</label>
                        <select name="statut" required class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition">
                            <option value="en_attente" {{ old('statut', $inspection->statut ?? '') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="conforme" {{ old('statut', $inspection->statut ?? '') == 'conforme' ? 'selected' : '' }}>Conforme</option>
                            <option value="non_conforme" {{ old('statut', $inspection->statut ?? '') == 'non_conforme' ? 'selected' : '' }}>Non conforme</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Observations / Remarques</label>
                    <textarea name="observations" rows="4"
                        class="w-full px-4 py-2.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-orange-400 focus:border-orange-400 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 outline-none transition resize-none"
                        placeholder="Décrivez les observations lors de l'inspection...">{{ old('observations', $inspection->observations ?? '') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-md shadow-orange-200 dark:shadow-none flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ isset($inspection) ? 'Mettre à jour' : 'Enregistrer' }}
                    </button>
                    <a href="{{ route('admin.inspections.index') }}" class="py-2.5 px-6 border-2 border-gray-200 dark:border-gray-600 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
