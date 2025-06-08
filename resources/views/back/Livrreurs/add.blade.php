
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
            <h1>Gestion des Livreurs</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Tableau de bord</a></li>
              <li class="breadcrumb-item active">Gestion des Livreurs</li>
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
                <h3 class="card-title">Ajouter Livreur</h3>
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
            <form name="add" method="POST" action="{{ route('admin.list_livreurs.store')}}"  enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="row">
                <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <div class="form-group">

                  
                 
                            <div class="form-group">
                                <label for="nom">Nom</label> 
                                <input type="text" class="form-control" id="nom" placeholder="" name="nom"  value="{{old('nom')}}" onkeypress="return validateAlphabets(event);"  pattern="[A-Za-zÀ-ÿ\s]+" title="Le nom doit contenir uniquement des lettres."required>
                                 @error('nom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" class="form-control" id="prenom" placeholder="" name="prenom"  value="{{old('prenom')}}" onkeypress="return validateAlphabets(event);"  pattern="[A-Za-zÀ-ÿ\s]+" title="Le prenom doit contenir uniquement des lettres."required>
                                 @error('prenom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

    <div class="form-group">
    <label for="telephone">Téléphone</label>
    <input type="number" class="form-control" id="telephone" name="telephone" 
           placeholder="" value="{{ old('telephone') }}" 
         min="10000000" max="99999999"
         oninput="if(this.value.length > 8) this.value = this.value.slice(0, 8);"
           title="Le numéro de téléphone doit contenir exactement 8 chiffres.">
    @error('telephone')

    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

                            <div class="form-group">
                                <label for="region">region</label>
                                <input type="text" class="form-control" id="region" placeholder="" name="region"  value="{{old('region')}}">
                                 @error('region')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           
                          


                            <div class="form-group">
                                <label for="login">Nom d'utilisateur</label>
                                <input type="text" class="form-control" id="login" placeholder="login" name="login" value="{{old('login')}}">
                                 @error('login')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
    <label for="password">Nouveau mot de passe</label>
    <input type="password" class="form-control" id="password" name="password" title="Le mot de passe doit contenir letters numbers symbols min(8)" value="">
    <input type="checkbox" id="showPassword" onclick="togglePassword()"> Afficher le mot de passe
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
                           
                           


                            <button class="btn btn-primary btn-sm"  type="submit">Ajouter Livreur</button>
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
<script>
    function validateAlphabets(event) {
        var char = String.fromCharCode(event.which);
        // Regex to allow only alphabetic characters
        if (!char.match(/[a-zA-Z]/)) {
            event.preventDefault();
        }
    }
</script>
<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var showPassword = document.getElementById('showPassword');
        if (showPassword.checked) {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }
</script>

@Push('js')

@endpush
