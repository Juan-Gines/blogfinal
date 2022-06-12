<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" name="name" id="name" class="form-control"
        value="@isset($post){{ old('name', $post->name) }}@else{{ old('name') }}@endisset"
        placeholder="Ingrese el nombre del post">
    @error('name')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" name="slug" id="slug" class="form-control"
        value="@isset($post){{ old('slug', $post->slug) }}@else{{ old('slug') }}@endisset"
        readonly placeholder="Ingrese el slug del post">
    @error('slug')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="category_id" class="form-label">Categoria</label>
    <select class="form-control" name="category_id" id="category_id">
        @foreach ($categories as $category_key => $category_name)
            <option value="{{ $category_key }}"
                @isset($post) @selected(old('category_id', $post->category_id) == $category_key)
                @else @selected(old('category_id') == $category_key) @endisset>
                {{ $category_name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Etiquetas</label>
    <div class="flex">
        @isset($post)
            @foreach ($post->tags as $tag)
                @php
                    $postTags[] = $tag->id;
                @endphp
            @endforeach
        @endisset
        @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="{{ $tag->name }}" name=" tags[] "
                    @isset($postTags) 
                        @if (in_array($tag->id, old('tags', $postTags)))
                            checked
                        @endif
                    @else
                        @if (!is_null(old('tags'))) 
                            @if (in_array($tag->id, old('tags')))
                                checked
                            @endif
                        @endif
                    @endisset>            
                <label class="form-check-label" for="{{ $tag->name }}">
                    {{ $tag->name }}
                </label>
            </div>
        @endforeach
    </div>
    @error('tags')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="status">Estado</label>
    <div class="flex">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="1" name="status" id="status1"
                @isset($post) @checked(old('status',$post->status) == 1) 
                    @else
                        @if (old('status')) @checked(old('status') == 1) @else checked @endif
            @endisset>
        <label class="form-check-label" for="status1">
            Borrador
        </label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" value="2" name="status" id="status2"
            @isset($post) @checked(old('status',$post->status) == 2)
                    @else
                        @checked(old('status') == 2) @endisset>
        <label class="form-check-label" for="status2">
            Publicado
        </label>
    </div>
    @error('status')
    <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            <img id="picture" 
                src="@isset($post->image)
                        {{ Storage::url($post->image->url) }}                                                
                    @else
                        {{ Storage::url('default/image.jpg') }}
                    @endisset" alt="Imagen del post">
        </div>
    </div>
    <div class="col">
        <div class="mb-3">
            <label for="file" class="form-label">Imagen que se mostrará en el post</label>
            <input type="file" name="file" id="file" class="form-control-file" accept="image/*">
        </div>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id voluptas eius, repudiandae similique
            et aspernatur dolorem ad quo fuga error. Cumque quidem consequuntur neque vero quo cupiditate
            deserunt corrupti esse?</p>
        @error('file')
            <small class="text-danger">*{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mb-3">
    <label for="extract">Extracto</label>
    <textarea name="extract" id="extract" class="form-control" rows="2">
        @isset($post)
            {{ old('extract',$post->extract) }}
        @else
            {{ old('extract')}}
        @endisset
    </textarea>
    @error('extract')
    <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="body">Cuerpo del post</label>
    <textarea name="body" id="body" class="form-control" rows="5">
        @isset($post)
            {{ old('body',$post->body) }}
        @else
            {{ old('body')}}
        @endisset
    </textarea>
    @error('body')
    <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
