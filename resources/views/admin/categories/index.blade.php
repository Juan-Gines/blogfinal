@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <div class=" float-right">
        @can('admin.categories.create')
            <a class="btn btn-success" href="{{ route('admin.categories.create') }}">Crear nueva categoría</a>
        @endcan
    </div>
    <h1>Lista de categorías</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td width="10px">
                                @can('admin.categories.update')                                
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.categories.edit', $category) }}">
                                        Editar
                                    </a>                                       
                                @endcan                               
                            </td>
                            <td width="10px">
                                @can('admin.categories.destroy')
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Borrar</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
