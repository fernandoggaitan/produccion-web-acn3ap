@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lista de productos') }}</div>

                <div class="card-body">

                    @if (Session('status'))
                        <div class="alert alert-success">
                            {{ Session('status') }}
                        </div>
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('productos.create') }}" class="btn btn-success"> Crear producto </a>
                    </div>
                    
                    <table class="table">
                        <thead>
                            <th scope="col"> Nombre </th>
                            <th scope="col"> Precio </th>
                            <th scope="col"> Categoría </th>
                            <th scope="col">  </th>
                        </thead>
                        <tbody>
                            @if ($productos->count() > 0)
                                @foreach ($productos as $prod)
                                    <tr>
                                        <td> {{ $prod->nombre }} </td>
                                        <td> {{ $prod->precio_format() }} </td>
                                        <td> {{ $prod->categoria->nombre }} </td>
                                        <td>
                                            <a href="{{ route('productos.show', $prod) }}" class="btn btn-primary"> Ingresar </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="4"> No existen productos cargados. </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    {{ $productos->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection