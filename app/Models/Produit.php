<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'reference',
        'titre',
        'description',
        'image1',
        'Qte',
        'marque_id',
        'categorie_id',
        'status',
        'nouveau',
        'viewer',
        'status'
    ];

   

}
