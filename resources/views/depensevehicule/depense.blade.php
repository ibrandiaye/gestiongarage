{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('depensevehicule.index') }}" >LISTE D'ENREGISTREMENT DES DEPENSES POUR LES VEHICULES</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('depensevehicule.store') }}" method="POST">
            @csrf
             <div class="card">
                        <div class="card-header  text-center">FORMULAIRE D'ENREGISTREMENT DE DEPENSE POUR UN VEHICULE</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Montant</label>
                                        <input type="text" name="montant"  value="{{ old('montant') }}" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Objet de la depense</label>
                                        <input type="text" name="description"  value="{{ old('description') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <input type="hidden" name="vehicule_id"  value="{{ $vehicule }}" class="form-control"  required>

                                   {{--   <div class="col-lg-6">
                                        <label>Vehicule</label>
                                        <select class="form-control select2" name="vehicule_id" required="">
                                            @foreach ($vehicules as $vehicule)
                                            <option value="{{$vehicule->id}}">{{$vehicule->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>  --}}
                                </div>
                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-primary btn btn-lg "> ENREGISTRER</button>
                                    </center>
                                </div>
                            </div>

                            </div>

            </form>

@endsection


