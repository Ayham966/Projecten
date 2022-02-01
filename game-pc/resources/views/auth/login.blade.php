@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container p-3">
        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center bg-dark text-light p-3">Inloggen</div>
                                    <div class="card-body">
                                        @if (session('status'))
                                            <span class="text-danger h5 p-1">
                                                {{ session('status') }}
                                            </span>
                                              @endif
                                        <form class="form-horizontal" method="post" action=" {{ route('login')}}">
                                            @csrf
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
                                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                                <label class="form-check-label" for="remember">Remember me</label>
                                              </div>
                                              

                                            <div class="form-group text-center p-1">
                                                <button type="submit" class="btn btn-primary btn-md btn-block login-button">Inloggen</button>
                                            </div>
                                            
                                            <div class="login-register p-1">
                                                <span>Hebt u geen account? </span> <a href="{{ route('register') }}">Register</a>
                                            </div>
                                        </form>
                                    </div>
        
                                </div>
                            </div>
                        </div>
        </div>
@endsection