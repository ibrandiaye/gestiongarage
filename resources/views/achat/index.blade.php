@extends('welcome')
@section('title', '| achat')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('achat.create') }}" role="button" >ENREGISTRER achat</a></li>
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
        <div class="card-header">LISTE D'ENREGISTREMENT DES achats</div>
            <div class="card-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('betwween.date.achat') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Debut </label>
                                    <input type="date" name="debut"  value="{{ old('debut') }}" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fin </label>
                                    <input type="date" name="fin"  value="{{ old('fin') }}" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-3">
                               <br>
                            <button type="submit" class="btn btn-success btn btn-lg "> ENREGISTRER</button>
                            </div>
                        </div>
                    </form>
                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>

                            <th>Date</th>
                            <th>Commentaire</th>
                            <th>Document</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($achats as $achat)
                        <tr>
                            <td>{{ date('d-m-Y', strtotime($achat->created_at)) }}</td>
                            <td>{{ $achat->commentaire }}</td>
                            <td> <a href="{{ asset('doc/'.$achat->document) }}" target="blank"> Document</a></td>

                            <td>
                                <a href="{{ route('achat.edit', $achat->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['achat.destroy', $achat->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
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
</div>


@endsection
