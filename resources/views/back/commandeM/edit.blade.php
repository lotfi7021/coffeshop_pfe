{{-- resources/views/back/commandeM/assign.blade.php --}}
@extends('back.app')
@section('title', 'Assigner Livreur')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Assigner un Livreur</h1>
    </section>

    <section class="content">
        <div class="box box-primary">
        <form name="update" method="POST" action="{{ route('admin.list_commandeM.edit', $commande->id)}}"  enctype="multipart/form-data">
            {{method_field('post')}}
        {{csrf_field()}}
               

                <div class="box-body">
                    <div class="form-group">
                        <label for="id_livreur">Choisir un Livreur:</label>
                        <select name="id_livreur" id="id_livreur" class="form-control">
                            @foreach ($livreurs as $livreur)
                                <option value="{{ $livreur->id }}" {{ $commande->id_livreur == $livreur->id ? 'selected' : '' }}>{{ $livreur->nom }} {{ $livreur->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Confirmer et Assigner</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
