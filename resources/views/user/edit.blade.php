{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Région')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#" role="button">ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.index') }}" >RETOUR</a></li>

                        </ol>
                    </div><!-- /.col -->
        </div>
    </div>
</div>

        {!! Form::model($user, ['method'=>'PATCH','route'=>['user.update', $user->id]]) !!}
            @csrf
             <div class="card">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION user</div>
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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom </label>
                                                <input id="name" value="{{ $user->name }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input id="email" type="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                       {{--   <div class="col-md-6">
                                            <label>Mot de passe</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Repeter mot de passe</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                        </div>  --}}
                                        <div class="col-md-6">
                                            <label>Profil</label>
                                            <select class="form-control" name="role" required >
                                                <option value="">Selectionner</option>
                                                <option value="mecanicien"  {{ $user->role=="mecanicien" ? 'selected' : '' }}>mecanicien</option>
                                                <option value="comptable"  {{ $user->role=="comptable" ? 'selected' : '' }}>comptable</option>
                                                <option value="gerant"  {{ $user->role=="gerant" ? 'selected' : '' }}>gerant</option>
                                                <option value="admin"  {{ $user->role=="admin" ? 'selected' : '' }}>admin</option>
                                            </select>
                                        </div>
                                    </div>
                                        <div>

                                                <button type="submit" class="btn btn-primary btn btn-lg "> ENREGISTRER</button>

                                        </div>


                            </div>
                        </div>
    {!! Form::close() !!}

@endsection
