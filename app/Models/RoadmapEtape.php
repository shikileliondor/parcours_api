<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoadmapEtape extends Model
{
    use HasFactory;

    protected $table = 'roadmap_etapes';

    protected $fillable = [
        'metier_id',
        'ordre',
        'titre',
        'description',
    ];

    public function metier(): BelongsTo
    {
        return $this->belongsTo(Metier::class);
    }
}
