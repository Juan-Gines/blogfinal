@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Editar rol</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.update', $role)}}" method="POST">
                @csrf
                @method('put')
                @include('admin.roles.partials.form')
                <button class="btn btn-primary">Actualizar rol</button>
            </form>
        </div>
    </div>
@stop
