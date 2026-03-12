<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metier extends Model
{
    use HasFactory;

    protected $table = 'metiers';

    protected $fillable = [
        'nom',
        'description',
        'salaire_min',
        'salaire_moyen',
        'salaire_max',
        'duree_estimee',
    ];

    public function competences(): BelongsToMany
    {
        return $this->belongsToMany(Competence::class);
    }

    public function parcoursEtudes(): BelongsToMany
    {
        return $this->belongsToMany(ParcoursEtude::class, 'metier_parcours_etude');
    }

    public function ecoles(): BelongsToMany
    {
        return $this->belongsToMany(Ecole::class);
    }

    public function roadmapEtapes(): HasMany
    {
        return $this->hasMany(RoadmapEtape::class)->orderBy('ordre');
    }
}
