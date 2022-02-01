@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container p-3">
        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header text-center bg-dark text-light p-3">Register</div>
                                    <div class="card-body">
                                        <form class="form-horizontal" method="post" action=" {{ route('register')}}">
                                            @csrf
                                            <div class="form-group p-1">
                                                <label for="name" class="cols-sm-2 control-label">Naam:</label>
                                                <div class="cols-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control @error('name') border border-danger @enderror" name="name" id="name" placeholder="Vul je naam in" value=" {{ old('name') }}"/>
                                                    </div>
                                                </div>
                                                @error('name')
                                                    <span class="text-danger">Naam moet ingevuld worden</span>
                                                @enderror
                                            </div>
                                            <div class="form-group p-1">
                                                <label for="email" class="cols-sm-2 control-label">Email</label>
                                                <div class="cols-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control @error('email') border border-danger @enderror" name="email" id="email" placeholder="je email" value=" {{ old('email') }}"/>
                                                    </div>
                                                </div>
                                                @error('email')
                                                <span class="text-danger">Email moet ingevuld worden</span>
                                                @enderror
                                            </div>
                                            <div class="form-group p-1">
                                                <label for="nickname" class="cols-sm-2 control-label">Gebruiksnaam</label>
                                                <div class="cols-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                                        <input type="text" class="form-control @error('nickname') border border-danger @enderror" name="nickname" id="nickname" placeholder="Vul je gebruiksnaam" value=" {{ old('nickname') }}" />
                                                    </div>
                                                </div>
                                                @error('nickname')
                                                <span class="text-danger">Gebruiksnaam moet ingevuld worden</span>
                                                @enderror
                                            </div>
                                            <div class="form-group p-1">
                                                <label for="password" class="cols-sm-2 control-label">Wachtwoord</label>
                                                <div class="cols-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                        <input type="password" class="form-control
                                                         @error('password') border border-danger @enderror" name="password" id="password" placeholder="je wachtwoord" value="" />
                                                    </div>
                                                </div>
                                                @error('password')
                                                <span class="text-danger">Wachtwoord moet ingevuld worden</span>
                                                @enderror
                                            </div>
                                            <div class="form-group p-1">
                                                <label for="password_confirmation" class="cols-sm-2 control-label">Herhaal je wachtwoord</label>
                                                <div class="cols-sm-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                                        <input type="password" class="form-control @error('password') border border-danger @enderror" name="password_confirmation" id="password_confirmation" placeholder="je wachtwoord" value="" />
                                                    </div>
                                                </div>
                                                @error('password_confirmation')
                                                <span class="text-danger">Wachtwoord moet herhaald worden</span>
                                                @enderror
                                            </div>
                                            <div class="form-group text-center p-1">
                                                <button type="submit" class="btn btn-primary btn-md btn-block login-button">Registeer</button>
                                            </div>
                                            <div class="login-register p-1">
                                                <span>Hebt u al een account? </span> <a href=" {{ route('login') }}">Inloggen</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
        </div>
@endsection
