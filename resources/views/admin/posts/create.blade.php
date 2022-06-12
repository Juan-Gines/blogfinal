@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf                
                @include('admin.posts.partials.form')
                <button class="btn btn-primary">Crear post</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

    </style>
@stop

@section('js')

    {{-- script para crear un slug de un input linkeado --}}
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    {{-- Script para el ckeditor texto enriquecido para el post --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/translations/es.js"></script>


    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });

        ClassicEditor
            .create(document.querySelector('#extract'), {
                language: 'es'
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#body'), {
                language: 'es'
            })
            .catch(error => {
                console.error(error);
            });

        //Cambiar imagen   
        document.getElementById('file').addEventListener('change', cambiarImagen);

        function cambiarImagen(e) {
            let file = event.target.files[0];

            let reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('picture').setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>
@endsection
