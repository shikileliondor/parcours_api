<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
    ];

    public function metiers(): BelongsToMany
    {
        return $this->belongsToMany(Metier::class);
    }
}
