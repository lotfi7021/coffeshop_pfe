
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
            <h1>Gestion des Produit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item active">Gestion des Produits</li>
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
                <h3 class="card-title">Ajouter un Produit</h3>
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
            <form name="add" method="POST" action="{{ route('admin.list_Produit.store')}}"  enctype="multipart/form-data">
            {{method_field('post')}}
        {{csrf_field()}}

            <div class="row">
                <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                 
                   
                            <div class="form-group">
                                <label for="reference">Référence de Produit</label>
                                <input type="text" class="form-control" id="reference" placeholder="" name="reference"  value="{{$ref}}" ><div id="referenceStatus" style="color:red;"></div>
                                @error('reference')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="titre">Titre de Produit</label>
                                <input type="text" class="form-control" id="titre" placeholder="" name="titre"  value="{{old('titre')}}">
                                 @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Déscription</label>
                                <textarea class="" name="description" id="description" value="{{old('description')}}"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image1">Image 1</label>
                                
                               <input type="file" name="image1" class="form-control" id="image1" value="{{old('image1')}}">
                                @error('image1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                           


                            <button class="btn btn-primary btn-sm"  type="submit">Ajouter</button>
                    </div>
                </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                               

                                <div class="form-group">
                                <label for="Qte">Qte</label>
                                <div class="input-group">
    <input type="number" class="form-control" name="Qte" id="Qte" value="{{ old('Qte') }}" 
           min="1" step="1" placeholder="Quantité"
           oninput="validity.valid||(value='');"
           title="La quantité doit être un nombre positif.">
    <div class="input-group-append">
        <span class="input-group-text"></span>
    </div>
</div>
@error('Qte')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

                                <div class="form-group">
                                                <label for="marque">Marque</label>
                                                <select name="marque_id" class="form-control" id="marque">
                                                <option value=''>...</option>
                                                   @foreach ($marque as $list_marque )
                                                   <option value="{{ $list_marque->id}}">{{ $list_marque->titre}}</option>
                                                       
                                                   @endforeach
                                                </select>
                                @error('marque')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div> 
                        
 
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

<script type="text/javascript">
  

$(document).on('input','#reference',function(e){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let referenceInput = $('#reference').val();
 
    $.ajax({
        method:"POST",
        url: "{{route('admin.checkreference')}}",
        data:{reference:referenceInput},
        success: function(data){
          
          $('#referenceStatus').html(data);
        }
      });

});

   
    

</script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
        </script>

<script type="text/javascript">
    $(document).ready(function ()
    {
        
        $('select[name="marque_id"]').on('change',function(){
           
            var marqueID = $(this).val();
            if(marqueID){
                $.ajax({
                    url: '/getModels/'+marqueID,
                    type: "GET",
                    dataType:"json",
                    success:function(data)
                {
                    if(data.length != 0){
                      $('#showmodel').show();
                    $('select[name="model"]').empty();
                    
                    $.each(data, function(key,value){
                        console.log(value);

                        $('select[name="model"]').append('<option value="'+value+'">'+value+'</option>');
                    });
                   
                    }
                    else{
                        $('#showmodel').hide();
                    }
                    
                    
                }

                });
            }
            else {
                $('select[name="model"]').empty();
               
            }
        });

        



       


    });
    
</script>
@endpush
