@extends('layouts.app')

@section('content')
    
    <div class="row">
        <div class="col-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>

        <div class="col-12">
            <div id="accordion">

                @forelse($orders as $key=>$order)

                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                        Pedido n°: {{$order->reference}}
                      </button>
                    </h5>
                  </div>
              
                    <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      
                        <ul>

                            @php $items = unserialize($order->items); @endphp

                            @foreach (filterItemsByStoreId($items, auth()->user()->store->id) as $item)
                                <li>
                                    {{$item['name']}} | R$ {{number_format($item['price'],2,',','.')}}
                                    <br>
                                    Quantidade: {{$item['amount']}}
                                    <br>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                  </div>
                </div>
                @empty
                    <div class="alert alert-warning">Nenhum Pedido Recebido</div>
                @endforelse
                
              </div>
              
              <div class="col-12">
                  <hr>
                  {{$orders->links()}}
              </div>

        </div>
        
    </div>

@endsection