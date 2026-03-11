<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ecole extends Model
{
    use HasFactory;

    protected $table = 'ecoles';

    protected $fillable = [
        'nom',
        'ville',
        'site_web',
    ];

    public function metiers(): BelongsToMany
    {
        return $this->belongsToMany(Metier::class, 'ecole_metier');
    }
}
