<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Stock;
use App\Models\Categorie;
use App\Models\Gestion_pri;
use App\Models\Detail_commande;
use App\Models\Admin;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use DataTables;

class ProduitController extends Controller
{
   

    public function adminlist_Produit(Request $request){
       
            $titleSeo = 'Liste des Produit'; 
            if ($request->ajax()) {
                $data = Produit::select('*')->where("status",1)->orderBy('id','desc');
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('marque_id', function($marque_id){
                            $marque = Marque::where('id',$marque_id->marque_id)->first();
                            return $marque->titre;
                      })
                        ->addColumn('image', function ($image) {
                            $url= $image->image1;
                            return $url;
                        }) 
                       
                        ->addColumn('stock', function($data) {
                            $stockItem = Stock::where('id_produit', $data->id)->first();
                            // Return qte_final directly for processing in the DataTables render function
                            return $stockItem->qte_final; // Return '0' if nothing found
                        })
                    
                        ->addColumn('action', function($row){
           
                                $btn = '<a href="list_produit/'.$row->id.'/detail "  class="badge  bg-primary" style="padding:5px;margin-right:2px;"><i class="fa fa-eye"></i></a>';
                                $btn .= '<a href="list_produit/'.$row->id.'/edit" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-pencil-alt"></i></a>';
                                $btn .= '<a onclick="return confirm(\'Vous êtes sûr de supprimer la produit?\')" href="list_produit/'.$row->id.'/delete" class="badge  bg-danger" style="padding:5px;margin-right:2px;"><i class="fa fa-trash"></i></a>';
          
                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
        return view('back.produit.list', compact('titleSeo'));
    }


  
    public function create()
    {
        $titleSeo = 'Ajouter un produit';
        $marque = Marque::get();
        $categorie = Categorie::get();
        $random_reference = Str::upper(Str::random(4)); 
        $ref = 'C-'.Str::random(5);

        return view('back.produit.add',compact('titleSeo','marque','categorie','random_reference','ref'));
    }

   
    public function store(Request $request)
{
    $request->validate([
        'reference' => 'required',
        'titre' => 'required',
        'image1' => 'file|required|mimes:jpg,png|max:800',
        'marque_id' => 'required',
        'Qte' => 'required'


    ]);

    $produit = new Produit();
    $liste_categorie = Categorie::get();

    foreach($liste_categorie as $list) {
        $produit_id = Produit::latest()->first();
        $categori_prix = new Gestion_pri();
        $categori_prix->prix = 0;
        $categori_prix->categorie_id = $list->id;
   
        if(empty($produit_id)) {
            $categori_prix->produit_id = 1;
        } else {
            $categori_prix->produit_id = $produit_id->id + 1;
        }
        
        $categori_prix->save();
    }

    if($request->file('image1')) {
        $file = $request->file('image1');
        $filename1 = time() . '_' . $file->getClientOriginalName();
        $location = public_path('/images/produits');
        $file->move($location, $filename1);
        $produit->image1 = $filename1;
    }

    $produit->reference = $request->reference;
    $produit->titre = $request->titre;
    $produit->description = $request->description;
    
    $produit->Qte = $request->Qte;
    $produit->categorie_id = 0;
    $produit->nouveau = 0;
    $produit->marque_id = $request->marque_id;
    $produit->viewer = 0;
    
    $produit->status = 1;
    $produit->save();

    // Ajout dans la table de stock
    $stock = new Stock();
    $stock->id_produit = $produit->id;
    $stock->qte_initial = $request->Qte;
    $stock->mouvement = 0;
    $stock->qte_final = $request->Qte;
    $stock->save();

    return redirect()->route('admin.list_categories')->with('success', 'Produit ajouter avec succèes et il est obligatoire d ajouter les prix pour eviter les ERREURS');
}


  
    public function show($id)
    {
        $prixGroupe1 = Gestion_pri::where('categorie_id', 1)->where('produit_id', $id)->first();
        $prixGroupe2 = Gestion_pri::where('categorie_id', 2)->where('produit_id', $id)->first();
        $prixGroupe3 = Gestion_pri::where('categorie_id', 3)->where('produit_id', $id)->first();
        $produit = Produit::where('id', $id)->first();
        $stock = Stock::where("id_produit",$produit->id)->first();

        if (is_null($produit)) {
            return abort(404);
        }
        $titleSeo = $produit->titre;
        
        return view('back.produit.show', compact('titleSeo', 'produit', 'prixGroupe1', 'prixGroupe2', 'prixGroupe3','stock'));
    }
    


     public function checkReference(Request $request){
        $reference = $request->input('reference');
        $isExists = Produit::where('reference','LIKE',"%{$reference}%")->first();
        if($isExists){
            return 'Référence existe déjà';
        }else{
            return '';
        }
    }



  
    public function edit($id)
    {    
        $produit = Produit::where('id',$id)->first();
        if(is_null($produit)){
                    return abort(404);
                }
        $titleSeo=$produit->titre;
        
        $marque = Marque::get();
        $categorie = Categorie::get();
        $stock = Stock::where("id_produit",$produit->id)->first();

        return view('back.produit.edit',compact('titleSeo','produit','marque','categorie','stock'));
    }

  
    public function update(Request $request, $id)

    { $request->validate([
        'reference' => 'required',
        'titre' => 'required',
        'marque_id' => 'required'
    ]);
        $produit = Produit::find($id);
        if ($request->file('image1')) {
            $file = $request->file('image1');
            $filename1 = time() . '_' . $file->getClientOriginalName();
            $location = public_path('/images/produits');
            $file->move($location, $filename1);
            $produit->image1 = $filename1;
        } else {
            $filename1 = $produit->image1;
        }
    
            $produit->reference = $request->reference;
            $produit->titre = $request->titre;
            $produit->description = $request->description;
            $produit->image1 = $filename1;
            $produit->status = $request->status;
            $produit->Qte = $request->Qte;
            $produit->categorie_id = 0;
            $produit->marque_id = $request->marque_id;
            $produit->status = 1;
        $produit->save();
        $stock = Stock::where("id_produit",$produit->id)->first();
           
        if(empty($stock->qte_initial) ){
           $stock->qte_initial = $request->Qte;
           $stock->mouvement=0;
           $stock->qte_final = $request->Qte;
        }
        else{
            $stock->qte_initial = $stock->qte_initial+ $request->Qte;
          
           $stock->qte_final = $stock->qte_final+ $request->Qte;
        }
        $stock->save();

        return redirect()->route('admin.list_produit')->with('success','Merci!');

    }


   
      

    public function destroy($id)
    {
        $produit = Produit::where('id',$id)->first();
        $produit->status=0;
        $produit->save();
        //$gestion_pri= Gestion_pri::where('produit_id',$id)->delete();
        //$stock= Stock::where('id_produit',$id)->delete();
        return redirect()->route('admin.list_produit')->with('success','Produit Supprimer');
    }



/*--------- interface client------------*/


    public function clientlist_Produit(Request $request){
       
        $titleSeo = 'Liste des Produit'; 
        if ($request->ajax()) {
            $data = Produit::select('*')->where('status',1)->orderBy('id','desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('marque_id', function($marque_id){
                        $marque = Marque::where('id',$marque_id->marque_id)->first();
                        return $marque->titre;
                  })
                    ->addColumn('image', function ($image) {
                        $url= $image->image1;
                        return $url;
                    }) 
                    ->addColumn('prix', function ($prix) {
                        $admin_session = Admin::where("id",Session::get("user"))->first();

                        $prix_afficher = Gestion_pri::where('categorie_id',$admin_session->groupe)->where('produit_id',$prix->id)->first();
                        if($prix_afficher !=null)
                        {
                            $prix= number_format($prix_afficher->prix,2).' DT';
                        }
                        else {
                            $prix = number_format(0,2).' DT';
                        }
                       
                      return $prix;
                        
                    })  
                    ->addColumn('stock', function($data) {
                        $stockItem = Stock::where('id_produit', $data->id)->first();
                        return $stockItem->qte_final;
                    })
                
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="list_produit/'.$row->id.'/detail" class="badge  bg-primary" style="padding:5px;margin-right:2px;"><i class="fa fa-eye"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    return view('back.produit.clientlist', compact('titleSeo'));
}


public function clientshow_produit($id)
    
    {

        $produit = Produit::where('id',$id)->first();
        $stock = Stock::where("id_produit",$produit->id)->first();

        $produit->increment('viewer');
        if(is_null($produit)){
            return abort(404);}
          $titleSeo=$produit->titre;

        return view('back.produit.clientshow',compact('titleSeo','produit','stock'));
    }

    /*   fin interface client*/ 

    
}
