{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('reglement.index') }}" >RETOUR</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">Starter</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        {!! Form::model($reglement, ['method'=>'PATCH','route'=>['reglement.update', $reglement->id]]) !!}
            @csrf
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION REGLEMENT</div>
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
                                        <input type="text" name="montant"  value="{{$reglement->montant }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Type Reglement</label>
                                        <input type="text" name="type"  value="{{$reglement->type }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Commentaire</label>
                                        <input type="text" name="description"  value="{{$reglement->description }}" class="form-control"  required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>facture</label>
                                    <select class="form-control" name="facture_id" required="">
                                        @foreach ($factures as $facture)
                                        <option {{old('facture_id', $reglement->facture_id) == $facture->id ? 'selected' : ''}}
                                            value="{{$facture->id}}">{{$facture->id}}</option>
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
