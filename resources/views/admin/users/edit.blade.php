@extends('adminlte::page')

@section('title', 'Blog final')

@section('content_header')
    <h1>Agrega roles</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5>Usuario {{$user->name}}</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label>Roles</label>
                <form action="{{route('admin.users.update', $user)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        @isset($user->roles)
                            @foreach ($user->roles as $role)
                                @php
                                    $userRoles[] = $role->id;
                                @endphp
                            @endforeach
                        @endisset
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id }}" id="{{ $role->name }}"
                                    name=" roles[] "
                                    @isset($userRoles) @if (in_array($role->id, old('roles', $userRoles)))
                                            checked @endif
                                @else
                                    @if (!is_null(old('roles'))) @if (in_array($role->id, old('roles')))
                                                        checked @endif
                                    @endif
                            @endisset>            
                                <label class="form-check-label" for="{{ $role->name }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Asignar roles</button>
                    </div>
                </form>
            </div>           
        </div>    
    </div>    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
