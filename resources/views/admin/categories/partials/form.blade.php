<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Introduce el nombre de categoría"
        value="{{ isset($category) ? old('name', $category->name) : old('name') }}">

    @error('name')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>
    <input type="text" id="slug" name="slug" class="form-control" placeholder="Introduce el slug de categoría" readonly
        value="{{ isset($category) ? old('slug', $category->slug) : old('slug') }}">

    @error('slug')
        <small class="text-danger">*{{ $message }}</small>
    @enderror
</div>
