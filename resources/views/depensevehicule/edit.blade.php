{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Dépense Vehicule')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('depensevehicule.index') }}" >RETOUR</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        {!! Form::model($depensevehicule, ['method'=>'PATCH','route'=>['depensevehicule.update', $depensevehicule->id]]) !!}
            @csrf
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION depensevehicule</div>
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
                                        <input type="text" name="montant"  value="{{$depensevehicule->montant }}" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Objet de la depense</label>
                                        <input type="text" name="description"  value="{{$depensevehicule->description }}" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>Vehicule</label>
                                    <select class="form-control" name="vehicule_id" required="">
                                        @foreach ($vehicules as $vehicule)
                                        <option {{old('vehicule_id', $depensevehicule->vehicule_id) == $vehicule->id ? 'selected' : ''}}
                                            value="{{$vehicule->id}}">{{$vehicule->nom}}</option>
                                            @endforeach

                                    </select>
                                </div>
                            </div>

                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>
                                    </center>
                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection
