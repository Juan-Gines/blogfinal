@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Crear rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.roles.store')}}" method="POST">
                @csrf
                @include('admin.roles.partials.form')
                <button class="btn btn-primary">Crear rol</button>
            </form>
        </div>
    </div>
@stop


