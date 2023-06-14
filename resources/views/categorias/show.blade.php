@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $categoria->nombre }}</div>
                <div class="card-body">
                    <div class="border-bottom mb-3">
                        {{ $categoria->descripcion }}
                    </div>
                    <div class="border-bottom mb-3">
                        <ul>
                            @foreach($categoria->productos as $prod)
                                <li> {{ $prod->nombre }} </li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{ route('categorias.index') }}"> Volver a categorías </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection