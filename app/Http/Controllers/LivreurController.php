<?php

namespace App\Http\Controllers;

use App\Models\Livreur;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Admin;
use App\Models\Client;



use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LivreurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('back.Livrreurs.list');
                  
    }

    
    public function adminlist_livreur(Request $request){
        $titleSeo = 'Liste des livreurs'; 
        if ($request->ajax()) {
            $data = Livreur::select('*')->orderBy('id','desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                         
                        $btn = '<a href="list_livreurs/'.$row->id.'/edit" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-pencil-alt"></i></a>';
                        $btn .= '<a onclick="return confirm(\'Vous êtes sûr de supprimer livreur?\')" href="list_livreurs/'.$row->id.'/delete" class="badge  bg-danger" style="padding:5px;margin-right:2px;"><i class="fa fa-trash"></i></a>';
                        return $btn;
                })
                ->rawColumns(['action'])
                    ->make(true);
        }
    return view('back.Livrreurs.list', compact('titleSeo'));
}

   
    public function create()
    {
        $titleSeo = 'Ajouter Livreurs';
        return view('back.Livrreurs.add',compact('titleSeo'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => ['required', 'regex:/^\d{8}$/'],
            'region'=>'required'
        ]);
        $livreur = new Livreur($request->all());
         
          $livreur->save();
          
          return redirect()->route('admin.list_livreur')->with('success', 'Livreur ajouter avec succèe');
    }





    public function edit($id)
    {
        $livreur = Livreur::where('id',$id)->first();
        $titleSeo=$livreur->titre;
        if(is_null($livreur)){
                    return abort(404);
                }
                return view('back.Livrreurs.edit',compact('titleSeo','livreur'));
    }

  

    public function update(Request $request, $id)
    {
        $livreur = Livreur::find($id);
        $livreur->nom = $request->nom;
        $livreur->prenom =$request->prenom;;
        $livreur->telephone =$request->telephone;;

        $livreur->region = $request->region;
          $livreur->save();
          return redirect()->route('admin.list_livreur')->with('success','Merci!');

    }

    public function dashboardL()
    {
        $titleSeo = 'Tableau de bord';
        if(Auth::guard('admin')->check()){
          
                $produit  = Produit::get();
            return view('back.Livrreurs.dashbord_livreur',compact('titleSeo','produit'));  
        }
        else{
            return redirect()->route('login.form');
        }
       
    }
   
   
}
