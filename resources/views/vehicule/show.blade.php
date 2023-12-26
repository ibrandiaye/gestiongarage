@extends('welcome')
@section('title', '| vehicule')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('vehicule.create') }}" role="button" >ENREGISTRER vehicule</a></li>
                                </ol>
                            </div><!-- /.col -->
                        </div>
                    </div>
                </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row">

    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round">
                            <i class="mdi mdi-eye"></i>
                        </div>
                    </div>
                    <div class="col-9 align-self-center text-right">
                        <div class="m-l-10">
                            <h5 class="mt-0">{{ $facture}}</h5>
                            <p class="mb-0 text-muted">Montant facturé </p>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round">
                            <i class="mdi mdi-account-multiple-plus"></i>
                        </div>
                    </div>
                    <div class="col-9 text-right align-self-center">
                        <div class="m-l-10 ">
                            <h5 class="mt-0">{{ $depense  }}</h5>
                            <p class="mb-0 text-muted">Montant depense</p>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 48%;" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="search-type-arrow"></div>
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round ">
                            <i class="mdi mdi-cart"></i>
                        </div>
                    </div>
                    <div class="col-9 align-self-center text-right">
                        <div class="m-l-10 ">
                            <h5 class="mt-0">{{ $facture - $montantRecu }}</h5>
                            <p class="mb-0 text-muted">Reste a payé</p>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="search-type-arrow"></div>
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round ">
                            <i class="mdi mdi-cart"></i>
                        </div>
                    </div>
                    <div class="col-9 align-self-center text-right">
                        <div class="m-l-10 ">
                            <h5 class="mt-0">{{ $facture - $depense }}</h5>
                            <p class="mb-0 text-muted">Marge</p>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 61%;" aria-valuenow="61" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    </div>
    <div class="row">

    <div class="col-4">
        <div class="card ">
            <div class="card-header">Information Vehicule</div>
                <div class="card-body">
                    <ul>

                                <li>Client : <strong> {{ $vehicule->nom }}</strong></li>
                                <li>Numero :  <strong>{{ $vehicule->tel }}</strong></li>
                                <li>Marque:  <strong>{{ $vehicule->marque }}</strong></li>
                                <li>Model:  <strong>{{ $vehicule->model }}</strong></li>
                                <li>Numéro Vehicule:  <strong>{{ $vehicule->numero }}</strong></li>
                               {{--   <li>Panne:  <strong>{{ $vehicule->panne }}</strong></li>
                                <li>Date d'arrivée :  <strong>{{ date('d-m-Y', strtotime( $vehicule->created_at)) }}</strong></li>
                                <li>Date de sortie : <strong>{{  date('d-m-Y', strtotime($vehicule->sortie)) }}</strong></li>
  --}}

                            </ul>

                </div>

            </div>
        </div>
        <div class="col-8">
            <div class="card ">
                <div class="card-header">Facture Vehicule</div>
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Facture</th>
                                    <th>Montant</th>
                                    <th>Depense</th>
                                    <th>Reglement</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($factureVehicules as $factureByVehicule)
                                <tr>
                                    <td>{{$factureByVehicule->numero }}</td>
                                    <td>{{ $factureByVehicule->montant }}</td>
                                    <td>{{ $factureByVehicule->depense }}</td>

                                    <td>{{ $factureByVehicule->reglement }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>


                    </div>

                </div>
            </div>
{{--  <div class="col-8">
    <div class="card ">
        <div class="card-header">Depense sur vehicule</div>
            <div class="card-body">

                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Facture</th>
                            <th>Objet de la depense</th>
                            <th>Montant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($depensevehicules as $depensevehicule)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime( $depensevehicule->created_at)) }}</td>
                            <td>{{ $depensevehicule->description }}</td>
                            <td>{{ $depensevehicule->montant }}</td>
                            <td>
                                <a href="{{ route('depensevehicule.edit', $depensevehicule->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['depensevehicule.destroy', $depensevehicule->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}



                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>

        </div>
    </div>  --}}
</div>{{--
<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE DES REGLEMENTS</div>
            <div class="card-body">

                <table id="example" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Libelle</th>
                            <th>Montant</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($reglements as $reglement)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime( $reglement->created_at))  }}</td>
                            <td>{{ $reglement->description }}</td>
                            <td>{{ $reglement->montant }}</td>

                            <td>
                                <a href="{{ route('reglement.edit', $reglement->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['reglement.destroy', $reglement->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}



                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
    </div>
</div>  --}}
@endsection
