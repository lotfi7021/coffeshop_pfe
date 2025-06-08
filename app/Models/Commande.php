<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail_commande;
class Commande extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = ['ref_commande',
    'id_client',
    'prix',
    'tva',
    'date_livraison',
    'title',
    'start',
    'end',
    'total_qte',
    'id_livreur',
    'etat',
    'paiement',
];

// Dans App\Models\Commande.php

public function detail_commandes() {
    return $this->hasMany(Detail_commande::class, 'id');
}
public function client()
{
    // Assurez-vous que 'id_client' est le nom de la clé étrangère dans votre table commandes
    return $this->belongsTo(Admin::class, 'id_client', 'id');
}

// Si vous avez des détails supplémentaires liés à la commande


}
