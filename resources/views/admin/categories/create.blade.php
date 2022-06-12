@extends('adminlte::page')

@section('title', 'Crear categoría')

@section('content_header')
    <h1>Crear nueva categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                @include('admin.categories.partials.form')
                <button class="btn btn-primary">Crear categoría</button>
            </form>
        </div>
    </div>
@stop

@section('js')

    {{-- script para crear un slug de un input linkeado --}}
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@endsection
