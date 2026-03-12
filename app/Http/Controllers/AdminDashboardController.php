<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use App\Models\Materiel;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalMateriels'    => Materiel::count(),
            'totalInspections'  => Inspection::count(),
            'materielsDefectueux' => Materiel::where('etat', 'defectueux')->count(),
            'totalUsers'        => User::where('role', 'user')->count(),
            'recentInspections' => Inspection::with(['materiel', 'user'])->latest()->take(5)->get(),
            'recentMateriels'   => Materiel::latest()->take(5)->get(),
        ]);
    }
}
