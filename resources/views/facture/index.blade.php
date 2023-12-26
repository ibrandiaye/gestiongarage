@extends('welcome')
@section('title', '| facture')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('facture.create') }}" role="button" >ENREGISTRER facture</a></li>
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
        <div class="card-header">LISTE D'ENREGISTREMENT DES factures</div>
            <div class="card-body">

                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Client</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($factures as $facture)
                        <tr>
                            <td>{{ $facture->id }}</td>
                            <td>{{ $facture->Vehicule->nom }} : {{ $facture->Vehicule->numero }} </td>


                            <td>
                                @if (Auth::user()->role!='comptable')
                                <a href="{{ route('facture.edit', $facture->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>@endif
                                <a href="{{ route('facture.show', $facture->id) }}" role="button" class="btn btn-info"><i class="fas fa-print"></i></a>
                               {{--   {!! Form::open(['method' => 'DELETE', 'route'=>['facture.destroy', $facture->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}  --}}
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
