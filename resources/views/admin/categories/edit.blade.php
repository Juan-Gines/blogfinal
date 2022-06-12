@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Editar categoría</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form class="form" action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('put')
                @include('admin.categories.partials.form')
                <button class="btn btn-primary">Actualizar categoría</button>
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
