<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();
        $myInspections = Inspection::where('user_id', $userId)->count();
        $conformes = Inspection::where('user_id', $userId)->where('statut', 'conforme')->count();
        $nonConformes = Inspection::where('user_id', $userId)->where('statut', 'non_conforme')->count();
        $recentInspections = Inspection::with('materiel')
            ->where('user_id', $userId)
            ->latest('date_inspection')
            ->take(5)
            ->get();

        return view('admin.dashboard.user', compact('myInspections', 'conformes', 'nonConformes', 'recentInspections'));
    }

    public function materiels()
    {
        $materiels = Materiel::latest()->paginate(15);
        return view('user.materiels', compact('materiels'));
    }

    public function inspections()
    {
        $inspections = Inspection::with('materiel')
            ->where('user_id', Auth::id())
            ->latest('date_inspection')
            ->paginate(15);
        return view('user.inspections', compact('inspections'));
    }
}