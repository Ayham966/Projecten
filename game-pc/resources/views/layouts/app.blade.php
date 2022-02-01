<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href=" {{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>@yield('title') -  Game-PC </title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container h5">
{{--             <a href="#" class="navbar-brand"><img src="/images/game-pc.png" class="img-fluid mb-1" width="30" height="30"></a>--}}
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav main-nav">
                    <a href="{{ route('home') }} " class="nav-item nav-link active">Home</a>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <a href="{{ route('adminPage') }} " class="nav-item nav-link active">Admin</a>
                        @else
                            <a href="/profile/{{ auth()->user()->id }}" class="nav-item nav-link">Profile</a>
                            <a href="{{route('historyUser.index')}}" class="nav-item nav-link">Geschiendes</a>
                        @endif
                    @endauth
                </div>
                <div class="navbar-nav main-nav ms-auto">
                    <a href="{{ route('contact.store') }} " class="nav-item nav-link">Contact</a>
                    @auth
                        <a href="/profile/{{ auth()->user()->id }}" class="nav-item nav-link"> <i class='bx bx-user'></i> {{ auth()->user()->nickname }}</a>
                        <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-item nav-link border-0 bg-transparent"><i class='bx bx-log-out' id="log_out"></i> Uitloggen</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }} " class="nav-item nav-link">Inloggen</a>
                        <a href=" {{ route('register') }}" class="nav-item nav-link">Register</a>
                    @endguest

                </div>
            </div>
        </div>
    </nav>

    @if(session()->has('message'))
        <div class="m-0 text-center alert alert-warning alert-dismissible fade show" role="alert">
              {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')



    <div class="container-fluid footer">
        <footer>
            <div class="row justify-content-around custom-footer mb-0 pt-5 pb-0 ">
                <div class="col-11">
                    <div class="row justify-content-center">
                        <div class="col-md-3 col-12 font-italic align-items-center mt-md-3 mt-4">
                            <h5><span> <img src="/images/game-pc.png" class="img-fluid mb-1" width="50" height="30"></span><b class="text-dark">Game-PC<span class="text-muted"> Store</span></b></h5>
                            <p class="social mt-md-3 mt-2"> <span><i class="fa fa-facebook " aria-hidden="true"></i></span> <span><i class="fa fa-linkedin" aria-hidden="true"></i></span> <span><i class="fa fa-twitter" aria-hidden="true"></i></span> </p> <small class="copy-rights cursor-pointer text-dark">&#9400; 2021 Game-PC services</small><br> <small class="text-dark">Copyright.All Rights Resered. </small>
                        </div>
                        <div class="col-md-3 col-12 my-sm-0 mt-5">
                            <ul class="list-unstyled">
                                <li class="mt-md-3 mt-4 h5 text-dark">Categories:</li>
                                @foreach($categories as $category)
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="/category/{{ $category->name }}">{{ $category->name  }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-3 col-12 my-sm-0 mt-5">
                            <ul class="list-unstyled">
{{--                                <li class="mt-md-3 mt-4 h5 text-muted">ul2:</li>--}}
                            </ul>
                        </div>
                        <div class="col-xl-auto col-md-3 col-12 my-sm-0 mt-5">
                            <ul class="list-unstyled">
{{--                                <li class="mt-md-3 mt-4 h5 text-muted">ul3:</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
