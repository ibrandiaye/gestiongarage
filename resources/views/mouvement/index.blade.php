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
    @if (Auth::user()->role!='comptable')
<div class="row">
    <form action="{{ route('mouvement.store') }}" method="POST">
        @csrf
        <div class="card">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Objet </label>
                                    <input type="text" name="description"  value="{{ old('description') }}" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Montant</label>
                                    <input type="number" name="montant"  value="{{ old('montant') }}" class="form-control"  required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <label>Flux</label>
                                <select class="form-control" name="type" id="flux">
                                    <option value="">Selectionner</option>
                                    <option value="entree">entree</option>
                                    <option value="sortie">sortie</option>

                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Vehicule</label>
                                <select class="form-control select2" name="vehicule_id" id="vehicule_id" >
                                    <option value="">Selectionner</option>
                                    @foreach ($vehicules as $vehicule)
                                    <option value="{{$vehicule->id}}">{{$vehicule->nom}}: {{$vehicule->numero}}</option>
                                        @endforeach

                                </select>
                            </div>
                            <div class="col-lg-3" >
                                <label>Facture</label>
                                <select class="form-control " name="facture_id" id="facture_id" >
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label>Depense</label>
                                <select class="form-control" name="depense_id" id="depense_id">
                                    <option value="">Selectionner</option>
                                    @foreach ($depenses as $depense)
                                    <option value="{{$depense->id}}">{{$depense->nom}}</option>
                                        @endforeach

                                </select>
                            </div>
                            <div class="col-lg-3">
                                <br>
                                <button type="submit" class="btn btn-primary btn btn-lg" id="enregistrer"> ENREGISTRER</button>

                        </div>
                        </div>

                        </div>

                        </div>

        </form>
</div>
@endif
<div class="col-12">
    <div class="card ">
        <div class="card-header">LISTE D'ENREGISTREMENT DES mouvements</div>
            <div class="card-body">
                <form method="POST" action="{{ route('betwween.date') }}">
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
                        <button type="submit" class="btn btn-primary btn btn-lg "> ENREGISTRER</button>
                        </div>
                    </div>
                </form>

                <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>Numero</th>
                            <th>Date</th>
                            <th>Objet de la depense</th>
                            <th>Entree</th>
                            <th>Sortie</th>
                            <th>solde</th>
                            @if (Auth::user()->role!='comptable') <th>Actions</th> @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($mouvements as $mouvement)
                        <tr>
                            <td>{{ $mouvement->id }}</td>
                            <td>{{ date('d-m-Y h:i', strtotime($mouvement->created_at)) }}</td>
                            <td>{{ $mouvement->description }}</td>
                            <td>@if($mouvement->type=="entree")
                                {{ $mouvement->montant }}
                            @endif</td>
                            <td>@if($mouvement->type=="sortie")
                                {{ $mouvement->montant }}
                            @endif</td>
                            <td>{{ $mouvement->solde }}</td>
                            @if (Auth::user()->role!='comptable')  <td>
                                <a href="{{ route('mouvement.edit', $mouvement->id) }}" role="button" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'route'=>['mouvement.destroy', $mouvement->id], 'style'=> 'display:inline', 'onclick'=>"if(!confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?')) { return false; }"]) !!}
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


@endsection
@section("script")

<script>
    $("#vehicule_id").change(function () {
    var vehicule_id =  $("#vehicule_id").children("option:selected").val();
    var facture = "<option value=''>Veuillez selectionner</option>";
        $.ajax({
            type:'GET',

            url:'http://127.0.0.1:8000/factures/by/vehicule/'+vehicule_id,

            data:'_token = <?php echo csrf_token() ?>',
            success:function(data) {

                $.each(data,function(index,row){
                    //alert(row.nomd);
                    facture +="<option value="+row.id+">"+row.id+"</option>";

                });
                $("#facture_id").empty();

                $("#facture_id").append(facture);
            }
        });
    });
    $(document).ready(function () {
        $("#enregistrer").prop("disabled","true");

        $("#vehicule_id").change(function () {
            var vehicule_id =  $("#vehicule_id").children("option:selected").val();
            var flux = $("#flux").children("option:selected").val();
            var facture_id = $("#facture_id").children("option:selected").val();
            if(flux=="entree" && vehicule_id && facture_id)
                $("#enregistrer").removeAttr("disabled");
            else if(flux=="sortie" && vehicule_id)
            $("#enregistrer").removeAttr("disabled");

            else
                $("#enregistrer").prop("disabled","true");

        });
        $("#facture_id").change(function () {
            var vehicule_id =  $("#vehicule_id").children("option:selected").val();
            var flux = $("#flux").children("option:selected").val();
            var facture_id = $("#facture_id").children("option:selected").val();
            if(flux=="entree" && vehicule_id && facture_id)
                $("#enregistrer").removeAttr("disabled");
            else
                $("#enregistrer").prop("disabled","true");
        });
        $("#depense_id").change(function () {
            var flux = $("#flux").children("option:selected").val();
            var depense_id = $("#depense_id").children("option:selected").val();
            if(flux=="sortie" && depense_id)
            $("#enregistrer").removeAttr("disabled");
        else
            $("#enregistrer").prop("disabled","true");
        });

        $("#flux").change(function () {
            var flux = $("#flux").children("option:selected").val();
            var depense_id = $("#depense_id").children("option:selected").val();
            var vehicule_id =  $("#vehicule_id").children("option:selected").val();
            if(flux=="sortie" && depense_id)
            $("#enregistrer").removeAttr("disabled");
            else if(flux=="sortie" && vehicule_id)
            $("#enregistrer").removeAttr("disabled");

        else
            $("#enregistrer").prop("disabled","true");
        });
        });
</script>
@endsection
