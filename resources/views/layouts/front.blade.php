<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marketplace L6</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <style>
        .front.row {
            margin-bottom: 40px;
        }
    </style>
    @yield('stylesheet')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('home')}}">byron.solutions </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <!--
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            -->

            @foreach($categories as $category)
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('category/' .$category->slug)) active @endif" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>

    @auth
           <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if(request()->is('admin/stores*')) active @endif">
                        <a class="nav-link" href="{{route('admin.stores.index')}}">Lojas <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                        <a class="nav-link" href="{{route('admin.products.index')}}">Produtos</a>
                    </li>
                    <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                        <a class="nav-link" href="{{route('admin.categories.index')}}">Categorias</a>
                    </li>
                </ul>
        @else
        <div class="flex-center position-ref full-height my-2 my-lg-0">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                       <!--- <a href="{{ url('/home') }}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Home</a> -->
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Login</a>
    
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-secondary btn-sm active" role="button" aria-pressed="true">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    @endauth
        <div class="my-2 my-lg-0">
                    
            <ul class="navbar-nav mr-auto">

                @auth
                <li class="nav-item @if(request()->is('my-orders')) active @endif">
                    <a href="{{route('user.orders')}}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">
                    Meus Pedidos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); 
                                                          document.querySelector('form.logout').submit()">Sair</a>

                    <form action="{{route('logout')}}" method="POST" class="logout" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth

                <li class="nav-item">
                    <a href="{{route('cart.index')}}" class="nav-link">
                        @if(session()->has('cart'))
                        <span class="badge badge-danger">{{array_sum(array_column(session()->get('cart'),'amount'))}}</span>
                        @endif

                        <i class="fa fa-shopping-cart fa-2x"></i></a>
                </li>

                
                
            </ul>
        </div>

    </div>
</nav>

<div class="container">
    @include('flash::message')
    @yield('content')
</div>

<script src="{{asset('js/app.js')}}"></script>


@yield('scripts')
</body>
</html>