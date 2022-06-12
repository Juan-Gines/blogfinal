<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" id="name" class="form-control"
        value="@isset($role){{ old('name', $role->name) }}@else{{ old('name') }}@endisset"
        placeholder="Ingrese el nombre del rol">
    @error('name')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Permisos</label>
    <div class="col">

        @isset($role)
            @foreach ($role->permissions as $permission)
                @php
                    $rolePermissions[] = $permission->id;
                @endphp
            @endforeach
        @endisset

        @foreach ($permissions as $permission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$permission->id}}" id="{{$permission->name}}"
                @isset($rolePermissions) 
                    @if (in_array($permission->id, old('permissions', $rolePermissions)))
                        checked
                    @endif
                @else
                    @if (!is_null(old('permissions'))) 
                        @if (in_array($permission->id, old('permissions')))
                            checked
                        @endif
                    @endif
                @endisset>                
                <label for="{{$permission->name}}">{{$permission->descripcion}}</label>
            </div>
        @endforeach
    </div>
</div>