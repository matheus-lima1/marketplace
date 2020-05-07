<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MarketPlace</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"  style="margin-bottom: 40px;">
        <a class="navbar-brand" href="{{route('home')}}">byron.solutions</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          @auth  
          <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('admin/orders*')) active @endif">
              <a class="btn btn-secondary btn-lg active" role="button" aria-pressed="true" href="{{route('admin.orders.my')}}">Pedidos da Loja </a>
            </li>
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
          <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault(); 
                                                          document.querySelector('form.logout').submit()">Sair</a>

                    <form action="{{route('logout')}}" method="POST" class="logout" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li class="nav-item">
                  <span class="nav-link"> {{auth()->user()->name}}</span>
                </li>
              </ul>     
          </div>
          @endauth
        </div>
      </nav>
    <div class="container">
        @include('flash::message')
        @yield('content') <!-- chamar con teudo da section das heranças -->
    </div>

    <script
    src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
    crossorigin="anonymous"></script>

    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>