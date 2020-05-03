
@extends('layouts.app') 


@section('content')

<h1>Criar Loja</h1>
<form action="{{route('admin.stores.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Nome da Loja:</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
    </div>

    <div class="form-group">
        <label>Descrição:</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}">
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
    </div>

    <div class="form-group">
        <label>Celular:</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}">
            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
    </div>

    <div class="form-group">
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
            Criar Loja
        </button>
    </div>

</form>

@endsection