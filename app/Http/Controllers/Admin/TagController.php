<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //protegemos las rutas de los que no tienen rol
    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.update')->only('edit', 'update');
        $this->middleware('can:admin.tags.create')->only('create', 'store');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }
    public function index()
    {
        $tags = Tag::all();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = [
            'gray' => 'Gris',
            'red' => 'Rojo',
            'yellow' => 'Amarillo',
            'green' => 'Verde',
            'teal' => 'Verde azulado',
            'blue' => 'Azul',
            'purple' => 'Púrpura',
            'pink' => 'Rosa',
        ];
        return view('admin.tags.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:tags',
            'color' => 'required'
        ]);

        $tag = Tag::create($request->all());
        return redirect()->route('admin.tags.edit', $tag)->with('info', 'Etiqueta creada correctamente');
    }



    public function edit(Tag $tag)
    {
        $colors = [
            'gray' => 'Gris',
            'red' => 'Rojo',
            'yellow' => 'Amarillo',
            'green' => 'Verde',
            'teal' => 'Verde azulado',
            'blue' => 'Azul',
            'purple' => 'Púrpura',
            'pink' => 'Rosa',
            'orange' => 'Naranja'
        ];
        return view('admin.tags.edit', compact('colors', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required',
            'slug' => "required|unique:tags,slug,$tag->id",
            'color' => 'required'
        ]);

        $tag->update($request->all());
        return redirect()->route('admin.tags.edit', compact('tag'))->with('info', 'Etiqueta editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('info', 'Etiqueta borrada correctamente');
    }
}
