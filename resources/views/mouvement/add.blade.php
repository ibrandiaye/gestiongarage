{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister mouvement')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">ACCUEIL</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('mouvement.index') }}" >LISTE D'ENREGISTREMENT DES mouvementS</a></li>
                </ol>
            </div>
            <h4 class="page-title">Starter</h4>
        </div>
    </div>
    <div class="clearfix"></div>
</div>


        <form action="{{ route('mouvement.store') }}" method="POST">
            @csrf
            <div class="card">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Objet </label>
                                        <input type="text" name="description"  value="{{ old('description') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Montant</label>
                                        <input type="number" name="montant"  value="{{ old('montant') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Flux</label>
                                    <select class="form-control" name="type" >
                                        <option value="">Selectionner</option>
                                        <option value="entree">entree</option>
                                        <option value="sortie">sortie</option>

                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>Vehicule</label>
                                    <select class="form-control select2" name="vehicule_id" >
                                        <option value="">Selectionner</option>
                                        @foreach ($vehicules as $vehicule)
                                        <option value="{{$vehicule->id}}">{{$vehicule->nom}}: {{$vehicule->numero}}</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label>Depense</label>
                                    <select class="form-control" name="depense_id" >
                                        <option value="">Selectionner</option>
                                        @foreach ($depenses as $depense)
                                        <option value="{{$depense->id}}">{{$depense->nom}}</option>
                                            @endforeach

                                    </select>
                                </div>
                            </div>
                                <div>

                                        <button type="submit" class="btn btn-primary btn btn-lg "> ENREGISTRER</button>

                                </div>
                            </div>

                            </div>

            </form>
@endsection


