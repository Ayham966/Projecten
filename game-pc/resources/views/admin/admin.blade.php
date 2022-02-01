<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href=" {{ asset('css/app.css') }}">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Admin | @yield('title')</title>
</head>
<body>
<div class="container main-wrapper">
    <div class="sidebar">
        <div class="logo_content">
            <a href="{{ route('home') }} " class="text-decoration-none">
            <div class="logo">
                <img src="/images/game-pc.png" class="img-fluid mb-1" width="40" height="40">
                <div class="logo_name p-1">Game-PC</div>
            </div>
            </a>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li>
                <a href=" {{ route('users') }}">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Gebruikers</span>
                </a>
                <span class="tooltip">Gebruikers</span>
            </li>
            <li>
                <a href="{{ route('messeges') }}">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Berichten</span>
                </a>
                <span class="tooltip">Berichten</span>
            </li>
            <li>
                <a href="{{ route('categories.index') }}">
                    <i class='bx bx-category'></i>
                    <span class="links_name">Categories</span>
                </a>
                <span class="tooltip">Categories</span>
            </li>

            <li>
                <a href="{{ route('products.index') }}">
                    <i class='bx bxl-product-hunt'></i>
                    <span class="links_name">Producten</span>
                </a>
                <span class="tooltip">Producten</span>
            </li>

            <li>
                <a href="{{ route('history.index') }}">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Geschiedenis</span>
                </a>
                <span class="tooltip">Geschiedenis</span>
            </li>
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class='bx bx-folder'></i>--}}
{{--                    <span class="links_name">File Manager</span>--}}
{{--                </a>--}}
{{--                <span class="tooltip">File Manager</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class='bx bx-cart-alt'></i>--}}
{{--                    <span class="links_name">Order</span>--}}
{{--                </a>--}}
{{--                <span class="tooltip">Order</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class='bx bx-heart'></i>--}}
{{--                    <span class="links_name">Saved</span>--}}
{{--                </a>--}}
{{--                <span class="tooltip">Saved</span>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="#">--}}
{{--                    <i class='bx bx-cog'></i>--}}
{{--                    <span class="links_name">Setting</span>--}}
{{--                </a>--}}
{{--                <span class="tooltip">Setting</span>--}}
{{--            </li>--}}
        </ul>
        <div class="content">
            <div class="user">
                <div class="user_details">
{{--                    <img src="#" alt="">--}}
                    <i class='bx bx-user'></i>
                    <div class="name_job">

                        @auth
                        <a href=" {{ url('editAdmin',['user'=>auth()->user()->id]) }}" class="text-light text-decoration-none">
                            <div class="name">{{ auth()->user()->nickname }}</div>
                            <div class="job p-1">{{ strtoupper(auth()->user()->role) }}</div>
                        </a>
                        @endauth
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit"><i class='bx bx-log-out' id="log_out"></i></button>
                    </a>
                </form>
                </a>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="text">Dashboard | @yield('title')</div>
        <div class="col-10 mx-auto">
            @if(session()->has('message'))
                <div class="m-0 text-center alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session()->get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector(".bx-search");

        btn.onclick = function(){
            sidebar.classList.toggle("active");
        }
        searchBtn.onclick = function(){
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>
