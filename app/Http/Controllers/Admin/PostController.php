<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //protegemos las rutas de los que no tienen rol
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.update')->only('edit', 'update');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id'); //crea un simple array con ('campo como valor','campo como key') de todos los registros
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {


        $post = Post::create($request->all());

        if ($request->file('file')) {
            $url = Storage::put('posts', $request->file('file'));

            $post->image()->create([
                'url' => $url
            ]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        Cache::flush(); //borramos cache cuando creamos un post para que se muestre en el listado

        return redirect()->route('admin.posts.edit', compact('post'))->with('info', 'El post se creó correctamente');
    }


    public function edit(Post $post)
    {
        $this->authorize('author', $post); // verificamos con el policy si el post que vamos a editar es del usuario

        $categories = Category::pluck('name', 'id'); //crea un simple array con ('campo como valor','campo como key') de todos los registros
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $this->authorize('author', $post); // verificamos con el policy si el post que vamos a editar es del usuario

        $post->update($request->all());

        if ($request->file('file')) {
            //guardamos la imagen si hay nueva
            $url = Storage::put('posts', $request->file('file'));

            //preguntamos si había una antigua para borrarla y le asignamos la url de la nueva imagen
            if ($post->image) {
                Storage::delete($post->image->url);

                $post->image->update([
                    'url' => $url
                ]);
            } else {
                //si no tenía imagen la creamos
                $post->image()->create([
                    'url' => $url
                ]);
            }
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }

        Cache::flush(); //borramos cache cuando editamos un post para que se muestre en el listado

        return redirect()->route('admin.posts.edit', compact('post'))->with('info', 'El post se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('author', $post); // verificamos con el policy si el post que vamos a borrar es del usuario

        $post->delete();

        Cache::flush(); //borramos cache cuando borramos un post para que se muestre en el listado

        return redirect()->route('admin.posts.index')->with('info', 'El post fue borrado correctamente');
    }
}
