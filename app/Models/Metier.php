<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
