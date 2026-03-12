<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'numero_serie',
        'categorie',
        'localisation',
        'etat',
        'date_achat',
        'marque',
        'responsable',
        'description',
    ];

    protected $casts = [
        'date_achat' => 'date',
    ];

    public function inspections()
    {
        return $this->hasMany(Inspection::class);
    }

    public function latestInspection()
    {
        return $this->hasOne(Inspection::class)->latestOfMany();
    }
}
