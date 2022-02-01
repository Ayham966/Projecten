@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="bg-dark">
        <nav class="navbar navbar-light justify-content-between w-75 mx-auto">
            <a class="navbar-brand text-light">Game-PC</a>
            <ul class="nav list-inline text-light">
                <li class="list-inline-item p-1"><i class='bx bx-time-five text-warning h5'></i> Op werkdagen voor 23:30 besteld, morgen in huis</li>
                <li class="list-inline-item p-1"><i class='bx bxs-truck text-warning h5'></i> Gratis verzending vanaf € 20,- </li>
                <li class="list-inline-item p-1"><i class='bx bx-time-five text-warning h5'></i> 14 dagen bedenktijd</li>

            </ul>
        </nav>
    </div>

    <div class="container-fluid p-3 bg-dark">
        <nav class="navbar navbar-expand-sm mx-auto cate-nave">
            <ul class="navbar-nav mx-auto list-inline">
                @foreach($categories as $category)
                    <a class="nav-link list-inline-item p-2 text-light" href="/category/{{ $category->name }}">{{ $category->name  }}</a>
                @endforeach

            </ul>
        </nav>
    </div>

<div class="container-fluid">
    <div class="row bg-dark p-5 section-two">
        <div class="col-10 text-center p-3 mx-auto">
            <p class="text-home text-start h5 w-75 mx-auto">
                <em>Stel uw eigen Game-PC desktop samen!
                    Bent u op zoek naar een nieuwe desktop maar kunt u nét niet vinden wat u zoekt of wilt u liever zelf iets creëren? Stel dan bij Game-PC uw eigen desktop samen en kies de componenten die bij uw gebruik passen! Wilt u liever meer werk- of opslaggeheugen of bent u een fanatieke gamer die graag de nieuwste videokaart wil? Profiteer van een desktop op maat voor
                    de ultieme prestaties. Stel nu met de configurator uw eigen desktop samen bestaande uit de beste onderdelen!
                </em>
            </p>
            <br>
            <a href="{{ route('compiling') }}" class="btn btn-lg btn-outline-warning p-3">Samenstellen</a>
        </div>
        <div class="col-6 bg_landing mx-auto">
        </div>
    </div>
</div>


@endsection
