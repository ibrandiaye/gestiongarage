@extends('welcome')
@section('title', '| depensevehicule')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('depensevehicule.create') }}">ENREGISTRER DEPENSE VEHICULE</a></li>
                                </ol>
                            </div>
                            <h4 class="page-title">DEPENSE VEHICULE</h4>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
        <div class="card-header">LISTE D'ENREGISTREMENT DES depensevehiculeS</div>
            <div class="card-body">

                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Client </th>
                            <th>Vehicule</th>
                            <th>Montant</th>
                            <th>Objet de la depense</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($depensevehicules as $depensevehicule)
                        <tr>
                            <td>{{ $depensevehicule->created_at }}</td>
                            <td>{{ $depensevehicule->vehicule->nom }}</td>
                            <td>{{ $depensevehicule->vehicule->numero }}</td>
                            <td>{{ $depensevehicule->montant }}</td>
                            <td>{{ $depensevehicule->description }}</td>

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
</div>




@endsection
