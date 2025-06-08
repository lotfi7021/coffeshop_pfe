<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Marque;
use App\Models\Categorie;

use DataTables;
class MarqueController extends Controller
{
   
    
    
    public function create()
    {
        $titleSeo = 'Ajouter une marque';
        return view('back.marque.add',compact('titleSeo'));
    }




  

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
        ]);
        $marque = new Marque();

      
          $marque->titre = $request->titre;
          $marque->slug = Str::slug($request->titre,'-');
          $marque->save();
          
          return redirect()->route('admin.list_marques')->with('success', 'Marque ajouter avec succèe');
    }

  


    public function adminlist_marque(Request $request){
       
        $titleSeo = 'Liste des marques'; 
        if ($request->ajax()) {
            $data = Marque::select('*')->orderBy('id','desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                   

                    ->addColumn('action', function($row){
       
                            $btn = '<a href="list_marques/'.$row->id.'/edit" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-pencil-alt"></i></a>';
                            $btn .= '<a onclick="return confirm(\'Vous êtes sûr de supprimer la marque?\')" href="list_marques/'.$row->id.'/delete" class="badge  bg-danger" style="padding:5px;margin-right:2px;"><i class="fa fa-trash"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    return view('back.marque.list', compact('titleSeo'));
}



    public function edit($id)
    {
        $marque = Marque::where('id',$id)->first();
        $titleSeo=$marque->titre;
        if(is_null($marque)){
                    return abort(404);
                }
                return view('back.marque.edit',compact('titleSeo','marque'));
    }

   
    public function update(Request $request, $id)
    { $request->validate([
        'titre' => 'required',
    ]);
        $marque = Marque::find($id);
      
          
          $marque->titre = $request->titre;
          $marque->slug = Str::slug($request->titre);
          $marque->status = $request->status;
          $marque->save();
          return redirect()->route('admin.list_marques')->with('success','Merci!');
        }




    public function destroy($id)
    {
        $marque = Marque::where('id',$id)->firstOrFail()->delete();
        return redirect()->route('admin.list_marques')->with('success','Marque Supprimer');
    }

    
   
    
    
    
}
