<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ParcoursEtude extends Model
{
    use HasFactory;

    protected $table = 'parcours_etudes';

    protected $fillable = [
        'nom',
        'niveau',
        'description',
    ];

    public function metiers(): BelongsToMany
    {
        return $this->belongsToMany(Metier::class, 'metier_parcours_etude');
    }
}
