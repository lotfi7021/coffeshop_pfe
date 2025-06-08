
@extends('back.app')

@Push('css') 
     <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{ asset('assets/back/plugins/ekko-lightbox/ekko-lightbox.css')}}">

@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item active">Gestion des commande</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ajouter Commande produit</h3>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body">
              @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->get('danger'))
                    <div class="alert alert-danger">
                        {{ session()->get('danger') }}
                    </div>

                @endif
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



                @php
      $admin = App\Models\Admin::where('id',session('user'))->first();

      @endphp
            <form name="add" method="POST" action="{{ route('admin.list_commande.store')}}"  enctype="multipart/form-data">
            @method('POST')
            @csrf
            <input type='hidden' name='id_client' value="{{$admin->id}}">

            <div class="row">
                <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                  
                    
                    <div class="form-group">
                                <label for="ref_commande">Reference</label>
                                <input type="text" class="form-control" id="ref_commande" placeholder="" name="ref_commande"  value="{{$ref}}">
                                 @error('ref_commande')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @php
                            $produit = App\Models\Produit::where("status",1)->get();
                            @endphp
                            @foreach($produit as $list_produit)

                            @php
                            $stock = App\Models\Stock::where('id_produit',$list_produit->id)->first();
                            @endphp
                            <div class="form-group row">
                             <div class="col-md-4"> <label for="{{$list_produit->id}}">{{$list_produit->titre}}</label></div>
                             <div class="col-md-3">
                              @php 
                              $prix = App\Models\Gestion_pri::where('categorie_id',$admin->groupe)->where('produit_id',$list_produit->id)->first()->prix;
                              @endphp
                              {{ number_format($prix,2)}} Dt
                             </div>
                            <div class="col-md-1">
                            {{ $stock->qte_final>0 ?'En stock' : 'Repture'  }}
                            </div>
                             <div class="col-md-4">
                             <input type="hidden" name="id_produit[]" value="{{$list_produit->id}}"> 
                             <input type="hidden" name="prix[]" value="{{$prix}}"> 
                             <input type="number" id='qte' min=0 max="{{ $stock->qte_final  }}" value='0' class="qte-{{ $stock->id  }} form-control" id="{{$list_produit->id}}" name="qte[]"></div>
                             <script>
  
  document.getElementsByClassName('qte-{{ $stock->id  }}')[0].addEventListener("keyup", function(e) {
   if (e.target.value > {{ $stock->qte_final  }}) {
     this.value = {{ $stock->qte_final  }};
     alert('La quantité ne peut pas dépasser le stock ' + {{ $stock->qte_final }} + ' article');
    } else if (e.target.value < 0) {
      this.value = 0;
      alert('La quantité ne peut pas être négative.');
    
   }
   
 });
</script>
                             @error('qte')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                               
                            </div>
                            @endforeach
                           


                           
                           


                            <button class="btn btn-primary btn-sm"  type="submit">Ajouter</button>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <div class="form-group">
                                <label for="date_livraison">Date de livraison</label>
                                <input type="date" class="form-control" id="date_livraison" placeholder="date_livraison" name="date_livraison" >
                                 @error('date_livraison')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            
                   </div>

                   <div class="form-group">
                                <label for="paiement">Mode de paiement</label>
                               <select name='paiement' class='form-control'>
                                <option value='0'>Total de montant</option>
                                <option value='50'>Avance de 50%</option>
                                <option value='20'>Avance de 20%</option>
                               </select>
                            </div>
                            @error('paiement')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

                   </div>
               </div>
</div>

                </div>
               
                               

            </form>
             
         </div> 
        </div>   

            </div>
            

          </div>

  
            </div>
            </div>
            </div>
</section>
</div>


@stop
@Push('js')
@endpush
