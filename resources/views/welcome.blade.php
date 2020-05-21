@extends('layouts.front')

@section('content')

    <div class="row front">
        @foreach ($products as $key => $p)
        <div class="col-md-4">
            <div class="card" style="width: 98%;">
                @if($p->photos->count())
                    <img src="{{asset('storage/' . $p->photos->first()->image)}}" alt="" class="card-img-top">
                @else
                    <img src="{{asset('assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <h4 class="card-title">{{$p->name}}</h4>
                    <p class="card-text text-truncate">{{$p->description}}</p>
                    <H3>
                        R$ {{number_format($p->price,'2',',','.')}}
                    </H3>
                    <a href="{{route('product.single', ['slug' => $p->slug])}}" class="btn btn-success">
                        Ver Produto
                    </a>
                </div>
            </div>
            
        </div>
        

        @if(($key + 1)%3 == 0) </div><div class="row front"> @endif

         @endforeach
         <div class="container" style="margin-top: 10px;">
            {{$products->links()}}
         </div>
         
    </div>

    <div class="row">
        <div class="col-12">
            <h2>Lojas Destaque</h2>
            <hr>
        </div>
        @foreach($stores as $store)
        <div class="col-4">
            @if($store->logo)
                <img src="{{'storage/'.$store->logo}}" alt="Logo da Loja: {{$store->name}} " class="img-fluid">
            @else
                <img src="https://via.placeholder.com/600X300.png?text=logo" alt="Loja sem logo..." class="img-fluid">
            @endif
            <h3>{{$store->name}}</h3>
            <p class="text-truncate">{{$store->description}}</p>
        <a href="{{route('store.single', ['slug' => $store->slug])}}" class="btn btn-success" style="margin-bottom: 40px;">Ver Loja</a>
        </div>
        @endforeach
    </div>
    
@endsection