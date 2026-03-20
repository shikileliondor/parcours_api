<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ecole extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
        'ville',
        'type',
        'logo_url',
    ];

    public function metiers(): BelongsToMany
    {
        return $this->belongsToMany(Metier::class);
    }

    public function domaines(): BelongsToMany
    {
        return $this->belongsToMany(Domaine::class);
    }

    public function filieres(): BelongsToMany
    {
        return $this->belongsToMany(Filiere::class);
    }
}
