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

<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE D'ENREGISTREMENT DES vehicules</div>
            <div class="card-body">

                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>TEL</th>
                            <th>Marque</th>
                            <th>Model</th>
                            <th>Numero</th>
                            <th>Panne</th>
                            <th>Date sortie</th>
                            <th>Video</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($vehicules as $vehicule)
                        <tr>
                            <td>{{ $vehicule->nom }}</td>
                            <td>{{ $vehicule->tel }}</td>
                            <td>{{ $vehicule->marque }}</td>
                            <td>{{ $vehicule->model }}</td>
                            <td>{{ $vehicule->numero }}</td>
                            <td>{{ $vehicule->panne }}</td>
                            <td>{{ $vehicule->sortie }}</td>
                            <td>@if($vehicule->video)<a href="{{ asset('video/'.$vehicule->video) }}" target="blank">{{ $vehicule->video }}</a>@endif</td>
                            <td>
                                <a href="{{ route('vehicule.edit', $vehicule->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['vehicule.destroy', $vehicule->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}

                             {{--     <a href="{{ route('facture', $vehicule->id) }}" role="button" class="btn btn-info"><i class="fas fa-print"></i></a>

                                <a href="{{ route('depense.vehicule', $vehicule->id) }}" role="button" class="btn btn-warning"><i class="fa fa-money-bill" aria-hidden="true"></i></a>  --}}
                                <a href="{{ route('vehicule.show', $vehicule->id) }}" role="button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>

        </div>
    </div>
</div>


@endsection
