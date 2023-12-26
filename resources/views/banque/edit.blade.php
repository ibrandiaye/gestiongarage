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
                        <li class="breadcrumb-item active"><a href="{{ route('banque.index') }}" >RETOUR</a></li>

                        </ol>
                    </div><!-- /.col -->
        </div>
    </div>
</div>

        {!! Form::model($banque, ['method'=>'PATCH','route'=>['banque.update', $banque->id]]) !!}
            @csrf
             <div class="card">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION BANQUE</div>
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" name="date"  value="{{$banque->date }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" name="description"  value="{{$banque->description }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Référence</label>
                                        <input type="text" name="reference"  value="{{$banque->reference }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Credit</label>
                                        <input type="number" name="credit"  value="{{$banque->credit }}" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Debit</label>
                                        <input type="number" name="debit"  value="{{$banque->debit }}" class="form-control"  >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Solde</label>
                                        <input type="number" name="solde"  value="{{$banque->solde}}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Facture</label>
                                    <select class="form-control" name="facture_id" >
                                        <option value="">Selectionner</option>
                                        @foreach ($factures as $facture)
                                        <option value="{{$facture->id}}" {{$facture->id==$banque->facture_id ? 'selected' : ''}}>{{$facture->id}}</option>
                                            @endforeach

                                    </select>
                                </div>
                                <div>

                                        <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>

                                </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection
