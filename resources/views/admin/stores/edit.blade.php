
@extends('layouts.app') 


@section('content')

<h1>Criar Loja</h1>
<form action="{{route('admin.stores.update', ['store' => $store->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="form-group">
        <label>Nome da Loja:</label>
        <input type="text" name="name" class="form-control" value="{{$store->name}}">
    </div>
    <div class="form-group">
        <label>Descrição:</label>
            <input type="text" name="description" class="form-control" value="{{$store->description}}">
    </div>
    <div class="form-group">
        <label>Celular:</label>
            <input type="text" name="phone" class="form-control" value="{{$store->phone}}">
    </div>

    <div class="form-group">
        <p>
        <img src="{{asset('storage/' . $store->logo)}}" alt="">
        </p>
        <label>Fotos dos Produtos</label>
        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
        @error('logo') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-lg btn-success">
            Atualizar Loja
        </button>
    </div>
</form>

@endsection