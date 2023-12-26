@extends('welcome')
@section('title', '| mouvement')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('mouvement.create') }}" role="button" >ENREGISTRER mouvement</a></li>
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
        <div class="card-header">LISTE D'ENREGISTREMENT DES mouvements</div>
            <div class="card-body">


                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>N°Facture</th>
                            <th>Montant</th>
                            <th>Creancer</th>
                            <th>Avance</th>
                            <th>Relicat</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($dettes as $dette)
                        <tr>
                            <td>{{ date('d-m-Y h:i', strtotime($dette->date)) }}
                                </td>
                            <td>{{ $dette->facture }}</td>
                            <td>{{ $dette->montant }}</td>
                            <td>{{ $dette->creancer }}</td>
                            <td>{{ $dette->montant - $dette->reliquat }}</td>
                            <td>{{ $dette->reliquat }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>

        </div>
    </div>
</div>


@endsection
