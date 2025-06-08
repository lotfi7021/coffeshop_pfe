<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Http\Request;
use DataTables;
use DB;
class StockController extends Controller
{
    public function adminlist_stock(Request $request){
       
        $titleSeo = 'Liste des Stock '; 
      
        $array =array();     
        $produit = Produit::where('status',1)->get();
        foreach($produit as $list_produit)
        {
           $array[] =$list_produit->id;
        }
     

        if ($request->ajax()) {
      

    $data = Stock::whereIn('id_produit',$array)->orderBy('id','desc');
    return Datatables::of($data)
            ->addIndexColumn()
           
            ->addColumn('id_produit', function($id_produit){
               
                     $produit = Produit::where('id',$id_produit->id_produit)->first();
                return $produit->titre;
                }
            )
                
               
            ->addColumn('action', function($row){
           
                $btn = '<a href="'.$row->id.'/edit" class="badge  bg-success" style="padding:5px;margin-right:2px;"><i class="fa fa-pencil-alt"></i></a>';

                return $btn;
        })
        ->rawColumns(['action'])
       
            ->make(true);
}


      
    return view('back.Stock.list', compact('titleSeo'));
}

  
  
public function edit($id)
{    
    $Stock = Stock::where('id',$id)->first();
    if(is_null($Stock)){
                return abort(404);
            }
    $titleSeo="Modifier stock";
    
 
 

    return view('back.stock.edit',compact('titleSeo','Stock'));
}


public function update(Request $request, $id)

{ $request->validate([
 'qte_initial' => 'required|integer|min:0|max:99999999',
'mouvement' => 'required|integer|min:0|max:99999999',
'qte_final' => 'required|integer|min:0|max:99999999',

]);
    $Stock = Stock::find($id);
  

        $Stock->qte_initial = $request->qte_initial;
        $Stock->mouvement = $request->mouvement;
        $Stock->qte_final = $request->qte_final;
  
    $Stock->save();

    return redirect()->route('admin.list_stock')->with('success','Merci!');

}

  
}
