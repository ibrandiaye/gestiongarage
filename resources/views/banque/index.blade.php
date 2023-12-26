@extends('welcome')
@section('title', '| banque')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('banque.create') }}" role="button" >ENREGISTRER banque</a></li>
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
        <div class="card-header">LISTE D'ENREGISTREMENT DES Banques</div>
            <div class="card-body">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalform2">
                    importer
                </button>
                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Reference</th>
                            <th>Credit</th>
                            <th>Débit</th>
                            <th>Solde</th>
                            <th>Facture</th>
                            @if (Auth::user()->role!='comptable')  <th>Actions</th>@endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($banques as $banque)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($banque->date))  }}</td>
                            <td>{{ $banque->description }}</td>
                            <td>{{ $banque->reference }}</td>
                            <td>{{ $banque->credit }}</td>
                            <td>{{ $banque->debit }}</td>
                            <td>{{ $banque->solde }}</td>
                            <td>{{ $banque->facture_id }}</td>
                            @if (Auth::user()->role!='comptable') <td>
                               <a href="{{ route('banque.edit', $banque->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['banque.destroy', $banque->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                {!! Form::close() !!}



                            </td>@endif

                        </tr>
                        @endforeach

                    </tbody>
                </table>



            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalform2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('importer.banque') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-header">
                <h5 class="modal-title">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group no-margin">
                            <label for="field-7" class="control-label">Document</label>
                            <input type="file" name="doc" class="form-control" required>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
