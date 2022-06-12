@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Crear etiquetas</h1>
@stop

@section('content')
    <div class="card card-body">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class=" form-label" for="name">Nombre</label>
                <input class="form-control" type="text" name="name" id="name"
                    placeholder="Introduce el nombre de la etiqueta" value="{{ old('name') }}">
                @error('name')
                    <small class="text-red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class=" form-label" for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug"
                    placeholder="Introduce el slug de la etiqueta" readonly value="{{ old('slug') }}">
                @error('slug')
                    <small class="text-red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Elige el color</label>
                <select class="form-control" name="color" id="color">
                    @foreach ($colors as $color_id => $color_name)
                        <option value="{{ $color_id }}" @selected(old('color') == $color_id)>{{ $color_name }}</option>
                    @endforeach
                </select>
                @error('color')
                    <small class="text-red">*{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Crear etiqueta</button>
        </form>
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
@stop
