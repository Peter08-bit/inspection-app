<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    public function index(Request $request)
    {
        $query = Materiel::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('numero_serie', 'like', "%{$search}%")
                  ->orWhere('categorie', 'like', "%{$search}%")
                  ->orWhere('localisation', 'like', "%{$search}%");
            });
        }

        $materiels = $query->latest()->paginate(15);
        return view('admin.materiels.index', compact('materiels'));
    }

    public function create()
    {
        return view('admin.materiels.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'numero_serie' => 'required|string|max:100|unique:materiels',
            'categorie'    => 'required|string|max:100',
            'localisation' => 'nullable|string|max:255',
            'etat'         => 'required|in:bon,a_verifier,defectueux',
            'date_achat'   => 'nullable|date',
            'marque'       => 'nullable|string|max:100',
            'responsable'  => 'nullable|string|max:255',
            'description'  => 'nullable|string',
        ]);

        Materiel::create($data);
        return redirect()->route('admin.materiels.index')->with('success', 'Matériel ajouté avec succès !');
    }

    public function show(Materiel $materiel)
    {
        $materiel->load('inspections.user');
        return view('admin.materiels.show', compact('materiel'));
    }

    public function edit(Materiel $materiel)
    {
        return view('admin.materiels.form', compact('materiel'));
    }

    public function update(Request $request, Materiel $materiel)
    {
        $data = $request->validate([
            'nom'          => 'required|string|max:255',
            'numero_serie' => 'required|string|max:100|unique:materiels,numero_serie,' . $materiel->id,
            'categorie'    => 'required|string|max:100',
            'localisation' => 'nullable|string|max:255',
            'etat'         => 'required|in:bon,a_verifier,defectueux',
            'date_achat'   => 'nullable|date',
            'marque'       => 'nullable|string|max:100',
            'responsable'  => 'nullable|string|max:255',
            'description'  => 'nullable|string',
        ]);

        $materiel->update($data);
        return redirect()->route('admin.materiels.index')->with('success', 'Matériel mis à jour avec succès !');
    }

    public function destroy(Materiel $materiel)
    {
        $materiel->delete();
        return redirect()->route('admin.materiels.index')->with('success', 'Matériel supprimé avec succès !');
    }
}
