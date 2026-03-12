<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'materiel_id',
        'user_id',
        'date_inspection',
        'statut',
        'observations',
    ];

    protected $casts = [
        'date_inspection' => 'date',
    ];

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
