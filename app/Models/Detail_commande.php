<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Commande;
class Detail_commande extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['ref_commande',
    'id_produit',
    'prix',
    'qte',
  
];
public function commande() {
    return $this->belongsTo(Commande::class, 'ref_commande', 'ref_commande');
}

}
