@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <div class="container p-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header text-center bg-dark text-light p-3">Contact</div>
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action=" {{ route('contact.store') }}">
                            @csrf
                            @guest
                                <div class="form-group p-1">
                                    <label for="name" class="cols-sm-2 control-label">Naam:</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa"
                                                                               aria-hidden="true"></i></span>
                                            <input type="text"
                                                   class="form-control @error('name') border border-danger @enderror"
                                                   name="name" id="name" placeholder="Vul je naam in"
                                                   value=" {{ old('name') }}"/>
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
                                            <span class="input-group-addon"><i class="fa fa-envelope fa"
                                                                               aria-hidden="true"></i></span>
                                            <input type="text"
                                                   class="form-control @error('email') border border-danger @enderror"
                                                   name="email" id="email" placeholder="je email"
                                                   value=" {{ old('email') }}"/>
                                        </div>
                                    </div>
                                    @error('email')
                                    <span class="text-danger">Email moet ingevuld worden</span>
                                    @enderror
                                </div>
                            @endguest
                            @auth
                                <input type="hidden"
                                       class="form-control @error('name') border border-danger @enderror"
                                       name="name" id="name" placeholder="Vul je naam in"
                                       value="{{auth()->user()->name }}"/>
                                <input type="hidden"
                                       class="form-control @error('email') border border-danger @enderror"
                                       name="email" id="email" placeholder="je email"
                                       value="{{auth()->user()->email}}"/>
                            @endauth
                            <div class="form-group p-1">
                                <label for="message" class="cols-sm-2 control-label">Bericht:</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa"
                                                                           aria-hidden="true"></i></span>
                                        <textarea class="form-control @error('message') border border-danger @enderror"
                                                  placeholder="Vul je vraag in" value=" {{ old('message') }}"
                                                  name="message" id="message" rows="10"></textarea>
                                    </div>
                                </div>
                                @error('message')
                                <span class="text-danger">Bericht moet ingevuld worden</span>
                                @enderror
                            </div>

                            <div class="form-group p-1">
                                <button type="submit" class="btn btn-primary btn-md btn-block login-button">Verzend
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
