<!DOCTYPE html>
<html lang="fr" style="background-color: white;">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Zoter - Responsive Bootstrap 4 Admin Dashboard</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Mannatthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        {{--<link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css"> --}}
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body class="container" style="background-color: white;" >
    <div class="row text-center " style="display: flex;justify-content: center;">
        <img src="{{ asset('images/logo.JPG') }}" style="height: 200px;">
    </div>
    <div class="row text-center " style="display: flex;justify-content: center;">
    </div>
    <hr>
    <div class="row">
        <div class="col-12 text-center">
           <h1> Facture N°{{ $facture->id }}</h1>
        </div>
    </div>
    <hr>

<div class="row">

        <div class="col-sm-6">
            Lot 6 Yoff, Dakar Sénégal<br>
          ***********************************<br>
          Contact: 338689165/773731729<br>
          ***********************************<br>
          Site : <a href="http://dktuning221.com/"> http://dktuning221.com/</a><br>
          **********************************<br>
          Mail : <a href="m.sow@dktuning221.com"> m.sow@dktuning221.com</a><br>
          **************************<br>
            {{ $facture->created_at }}<br>
            **************************<br>
            {{ $facture->vehicule->nom }} : {{ $facture->vehicule->numero }}<br>
        </div>

</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <table class="table table-bordered  table-striped text-center">
            <thead>
                <tr>
                    <th>Quantite</th>
                    <th>Desctiption</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lignefactures as $lignefacture)
                <tr>
                    <td>{{ $lignefacture->quantite }}</td>
                    <td>{{ $lignefacture->description }}</td>
                    <td>{{ $lignefacture->prixu }}</td>
                    <td>{{ $lignefacture->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <h3>TOTAL HTVA :{{ $total -(($total*18)/100 ) }} FCFA
        </h3>
        <h3>TVA : {{($total*18)/100  }} FCFA      </h3>
        <h3>TOTA TTC :{{  $total  }} FCFA</h3>

    </div>
</div>





        <!-- jQuery  -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
        $(document).ready(function() {
            window.print();


         } );
        </script>
    </body>
</html>
