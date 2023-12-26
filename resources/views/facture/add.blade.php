{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister facture')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">ACCUEIL</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('facture.index') }}" >LISTE D'ENREGISTREMENT DES FACTURES</a></li>
                </ol>
            </div>
            <h4 class="page-title">Starter</h4>
        </div>
    </div>
    <div class="clearfix"></div>
</div>


        <form action="{{ route('facture.store') }}" method="POST">
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

                              {{--    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Objet </label>
                                        <input type="text" name="description"  value="{{ old('description') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantite</label>
                                        <input type="number" name="quantite"  value="{{ old('quantite') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Montant</label>
                                        <input type="number" name="montant"  value="{{ old('montant') }}" class="form-control"  required>
                                    </div>
                                </div>
  --}}
                                <div class="col-lg-6">
                                    <label>Vehicule</label>
                                    <select class="form-control select2" name="vehicule_id" required="">
                                        <option value="">Selectionner</option>
                                        @foreach ($vehicules as $vehicule)
                                        <option value="{{$vehicule->id}}">{{$vehicule->nom}}: {{$vehicule->numero}}</option>
                                            @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <button type="button"  class="btn btn-primary addRow">AJOUTER</button>
                                <table class="table  table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Quantite</th>
                                            <th>Prix Unitaire</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="conteneur">

                                    </tbody>
                                </table>
                                <center>
                                    <button type="submit" id="btnenreg" class="btn btn-primary btn btn-lg "> ENREGISTRER</button>
                                </center>
                            </div>
                        </div>

                            </div>

                            </div>

            </form>
@endsection

@section("script")
<script>
$(document).ready(function () {
    $("#btnenreg").prop("disabled","true");
    $(".addRow").click(function() {
        //alert('clic');
        //find content of different elements inside a row.
        var nameTxt = $(this).closest('tr').find('.name').text();
        var id = $(this).closest('tr').find('.id').text();
        $(".conteneur").append("<tr> <td><div class='form-group'><input type='text' name='description[]'  class='form-control quant' required></div></td>"+
        "<td> <div class='form-group'><input type='number' step='0.1' name='quantite[]' class='form-control quant' required> </div></td>"+
        "<td> <div class='form-group'><input type='number' step='0.1' name='prixu[]' class='form-control quant' required> </div></td>"+
        "<td><button type='button' class='btn btn-danger remove-tr'><i class='fas fa-trash'></i></button></td></tr>");
        //alert(nameTxt);
        $("#btnenreg").removeAttr("disabled");
    });
});
$(document).on('click', '.remove-tr', function(){
    $(this).parents('tr').remove();
    var quant = $('.quant').val();
    if(quant==null)
        $("#btnenreg").prop("disabled","true");
    else
        $("#btnenreg").removeAttr("disabled");
});
</script>
@endsection
