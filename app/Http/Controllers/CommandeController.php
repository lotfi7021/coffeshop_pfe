<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Stock;
use Exception; 
use App\Models\Produit;
use App\Models\Detail_commande;
use App\Models\Client;
use App\Models\Admin;
use App\Models\Livreur;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;
Use Carbon\Carbon;
class CommandeController extends Controller
{


    


    public function adminlist_commande(Request $request){
        $titleSeo = 'Liste Commandes produits'; 
        if ($request->ajax()) {
            $admin = Admin::where('id',session('user'))->first();
            if(Auth::guard('admin')->check() &&  $admin->role=='admin')
            {
                $data = Commande::select('*')->orderBy('id', 'desc');
            }
            elseif(Auth::guard('admin')->check() &&  $admin->role=='client')
            {
                $data = Commande::select('*')->where('id_client',$admin->id)->orderBy('id', 'desc');
            }
            elseif(Auth::guard('admin')->check() &&  $admin->role=='livreur')
            {
                $data = Commande::select('*')->where('id_livreur',$admin->id)->orderBy('id', 'desc');
            }

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('id_client', function($id_client) {
                        $client = Admin::where('id',$id_client->id_client)->first(); 
                        return $client->nom ; 
                    })
                    
                  ->addColumn('id_livreur', function($id_livreur){
                    $livreur = Admin::where('id',$id_livreur->id_livreur)->count();
                    if($livreur>0){
                         $livreur1 = Admin::where('id',$id_livreur->id_livreur)->first();
                    return $livreur1->nom. ' '.$livreur1->prenom;
                    }
                    else {
                        return '';
                    }
                   
              })
              ->addColumn('paiement', function($paiement) {
                if($paiement->paiement=='0') {
                    return 'Totalité';
                }
                elseif($paiement->paiement=='50'){
                    return 'Avance 50%';
                }
                elseif($paiement->paiement=='20'){
                    return 'Avance 20%';
                }
               
            })
            
                    ->addColumn('action', function($row){
                        $admin = Admin::where('id',session('user'))->first();
                        if(Auth::guard('admin')->check() &&  $admin->role=='admin')
                        {
                            $btn = '<a href="list_commande/'.$row->id.'/facture" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-eye"></i></a>';
                            $btn .= '<a onclick="return confirm(\'Vous êtes sûr de supprimer la Commande?\')" href="list_commande/'.$row->id.'/delete" class="badge  bg-danger" style="padding:5px;margin-right:2px;"><i class="fa fa-trash"></i></a>';
                            $btn .='<a  href="commande/'.$row->id.'/maj" class="badge  bg-warning" style="padding:5px;margin-right:2px;"><i class="fa fa-truck"></i></a>';
                            return $btn;

                            
                        }
                        elseif(Auth::guard('admin')->check() &&  $admin->role=='client')
                        {
                            $btn = '<a href="list_commande/'.$row->id.'/facture" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-eye"></i></a>';
                        }
                        elseif(Auth::guard('admin')->check() &&  $admin->role=='livreur')
                        {
                            $btn = '<a href="list_commande/'.$row->id.'/facture" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-eye"></i></a>';
                            $btn .= '<a href="list_commande/'.$row->id.'/mark-as-delivered" class="badge bg-primary" style="padding:5px;margin-right:2px;">marquer livrée</a>';                
                        }
                return $btn;
                           
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    return view('back.commande.list', compact('titleSeo'));
}



public function statut_livre($id)
{
    $commande = Commande::findOrFail($id);
    $commande->etat = 'Livrée';
    $commande->save();
    return redirect()->route('admin.list_commande')->with('success', 'Commande marquée comme livrée');
}




public function create()
{
    $client = Admin::get();
    $ref = 'cafe-'.Str::random(5);
    $titleSeo = 'Ajouter une Commande ';
    return view('back.commande.add',compact('titleSeo','ref'));
}



public function store(Request $request)
{

    
    $request->validate([
        'ref_commande' => 'required',
      'date_livraison'=> 'required',
    ]);
    $commande = new Commande();
    $total_prix = 0;
    $total_quantite = 0; 

    foreach ($request->qte as $key => $value) {
        $detail_commande = new Detail_commande();
        $detail_commande->ref_commande = $request->ref_commande;
        $detail_commande->id_produit = $request->id_produit[$key];
        $detail_commande->prix = $request->prix[$key];
        $detail_commande->qte = $value;
        $total_prix += $request->prix[$key] * $value;
        $total_quantite += $value; 
        if($value!=0){
            $detail_commande->save();
    } 
    }
    $commande->ref_commande = $request->ref_commande;
    $commande->id_client = $request->id_client;
    $commande->prix = $total_prix;
    $commande->tva = $total_prix * 1.19;
    $commande->date_livraison = $request->date_livraison;
    $commande->title = $request->ref_commande;
    $commande->start = Carbon::now();
    $commande->end = Carbon::now()->addHour();
    $commande->id_livreur = 0;
    $commande->etat = 'en attente';
    $commande->paiement = $request->paiement;
    $commande->total_qte = $total_quantite; 
    $commande->save();
    return redirect()->route('admin.list_commande')->with('success', 'Commande ajoutée avec succès');
}




public function maj(Request $request, $id)
{
    $titleSeo = 'Affecter un livreur';
    $commande = Commande::find($id);
    $livreurs = Admin::where('role','livreur') ->where('status', 1)->get();
return view('back.commande.edit',compact('commande','livreurs','titleSeo'));

}


public function updateLivreur(Request $request, $id)
{
    $commande = Commande::find($id);
    if (!$commande) {
        return back()->with('error', 'Commande non trouvée.');
    }
    $commande->id_livreur = $request->id_livreur;
    $commande->etat = 'confirmée'; 
    $commande->save();
    $detail_commande = Detail_commande::where('ref_commande',$commande->ref_commande)->get();
    foreach($detail_commande as $list_detail)
{
    $stock = Stock::where('id_produit', $list_detail->id_produit)->first();
    $mouvement_ancien = $stock->mouvement;
    $qte_initial = $stock->qte_initial;
    $ajouter_stock = $list_detail->qte+ $mouvement_ancien;
    $stock->mouvement = $ajouter_stock;
    $stock->qte_final = ($qte_initial-$stock->mouvement);
    $stock->save();

}
    return redirect()->route('admin.list_commande')->with('success', 'Livreur assigné et commande confirmée avec succès.');
}



public function facture($ref_commande)
{
    $commande = Commande::where("id",$ref_commande)->first();
    
    if (!$commande) {
        abort(404, 'Commande non trouvée.');
    }
    $client = Admin::find($commande->id_client);
    $livreur = Admin::find($commande->id_livreur);
    $details = Detail_commande::where('ref_commande', $commande->ref_commande)->get();
    $titleSeo = 'Facture';
    return view('back.commande.facture', compact('titleSeo', 'client', 'livreur','commande', 'details'));
}


public function apercufacture($ref_commande)
{
    $commande = Commande::where("id",$ref_commande)->first();
    if (!$commande) {
        abort(404, 'Commande non trouvée.');
    }
    $client = Admin::find($commande->id_client);
    $livreur = Admin::find($commande->id_livreur);
    $details = Detail_commande::where('ref_commande', $commande->ref_commande)->get();
    $titleSeo = 'Facture';
    return view('back.commande.apercu_facture', compact('titleSeo', 'client', 'livreur','commande', 'details'));
}




public function destroy($id)
{
    $commande = Commande::where('id', $id)->firstOrFail();
    Detail_commande::where('ref_commande', $commande->ref_commande)->delete();
    $commande->delete();
    return redirect()->route('admin.list_commande')->with('success', 'Commande supprimée');
}

}
