<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion_pri extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
       
        'prix',
        'categorie_id',
        'produit_id',

    ];
}
