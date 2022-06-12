@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card card-body">
        <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class=" form-label" for="name">Nombre</label>
                <input class="form-control" type="text" name="name" id="name"
                    placeholder="Introduce el nombre de la etiqueta" value="{{ old('name', $tag->name) }}">
                @error('name')
                    <small class="text-red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label class=" form-label" for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug"
                    placeholder="Introduce el slug de la etiqueta" readonly value="{{ old('slug', $tag->slug) }}">
                @error('slug')
                    <small class="text-red">*{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Elige el color</label>
                <select class="form-control" name="color" id="color">
                    @foreach ($colors as $color_id => $color_name)
                        <option value="{{ $color_id }}" @selected(old('color', $tag->color) == $color_id)>{{ $color_name }}</option>
                    @endforeach
                </select>
                @error('color')
                    <small class="text-red">*{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary">Actualizar etiqueta</button>
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
