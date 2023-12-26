{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Région')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('vehicule.index') }}" >RETOUR</a></li>

                        </ol>
                    </div><!-- /.col -->
        </div>
    </div>
</div>

        {!! Form::model($vehicule, ['method'=>'PATCH','route'=>['vehicule.update', $vehicule->id],'enctype'=>'multipart/form-data']) !!}
            @csrf
             <div class="card">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION vehicule</div>
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
                                        <input type="text" name="marque"  value="{{$vehicule->marque }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" name="model"  value="{{$vehicule->model }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numero Plaque</label>
                                        <input type="text" name="numero"  value="{{$vehicule->numero }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" name="nom"  value="{{$vehicule->nom }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telephone</label>
                                        <input type="text" name="tel"  value="{{$vehicule->tel }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Panne</label>
                                        <input type="text" name="panne"  value="{{$vehicule->panne }}" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date de Sortie</label>
                                        <input type="date" name="sortie"  value="{{$vehicule->sortie }}" class="form-control"  required>
                                    </div>
                                </div>
                            </div>
                                <div>

                                        <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>

                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection
