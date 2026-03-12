<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Materiel;
use App\Models\User;
use Illuminate\Http\Request;

class InspectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Inspection::with(['materiel', 'user']);

        if ($statut = $request->get('statut')) {
            $query->where('statut', $statut);
        }

        $inspections = $query->latest('date_inspection')->paginate(15);
        return view('admin.inspections.index', compact('inspections'));
    }

    public function create()
    {
        $materiels = Materiel::orderBy('nom')->get();
        $users = User::orderBy('name')->get();
        return view('admin.inspections.form', compact('materiels', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'materiel_id'     => 'required|exists:materiels,id',
            'user_id'         => 'required|exists:users,id',
            'date_inspection' => 'required|date',
            'statut'          => 'required|in:conforme,non_conforme,en_attente',
            'observations'    => 'nullable|string',
        ]);

        Inspection::create($data);
        return redirect()->route('admin.inspections.index')->with('success', 'Inspection enregistrée avec succès !');
    }

    public function edit(Inspection $inspection)
    {
        $materiels = Materiel::orderBy('nom')->get();
        $users = User::orderBy('name')->get();
        return view('admin.inspections.form', compact('inspection', 'materiels', 'users'));
    }

    public function update(Request $request, Inspection $inspection)
    {
        $data = $request->validate([
            'materiel_id'     => 'required|exists:materiels,id',
            'user_id'         => 'required|exists:users,id',
            'date_inspection' => 'required|date',
            'statut'          => 'required|in:conforme,non_conforme,en_attente',
            'observations'    => 'nullable|string',
        ]);

        $inspection->update($data);
        return redirect()->route('admin.inspections.index')->with('success', 'Inspection mise à jour avec succès !');
    }

    public function destroy(Inspection $inspection)
    {
        $inspection->delete();
        return redirect()->route('admin.inspections.index')->with('success', 'Inspection supprimée avec succès !');
    }
}
