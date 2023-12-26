{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister vehicule')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">ACCUEIL</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('vehicule.index') }}" >LISTE D'ENREGISTREMENT DES VEHICULES</a></li>
                </ol>
            </div>
            <h4 class="page-title">Starter</h4>
        </div>
    </div>
    <div class="clearfix"></div>
</div>


        <form action="{{ route('vehicule.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label>Marque</label>
                                        <input type="text" name="marque"  value="{{ old('marque') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" name="model"  value="{{ old('model') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero Plaque</label>
                                        <input type="text" name="numero"  value="{{ old('numero') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom"  value="{{ old('nom') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="tel"  value="{{ old('tel') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Panne</label>
                                        <input type="text" name="panne"  value="{{ old('panne') }}" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date de Sortie</label>
                                        <input type="date" name="sortie"  value="{{ old('sortie') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Video</label>
                                        <input type="file" name="vid"  value="{{ old('vid') }}" class="form-control"  >
                                    </div>
                                </div>
                            </div>
                                <div>

                                        <button type="submit" class="btn btn-primary btn btn-lg "> ENREGISTRER</button>

                                </div>
                            </div>

                            </div>

            </form>
@endsection


