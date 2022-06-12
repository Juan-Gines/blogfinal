<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

/*  Los observers se usan para cuando se realiza una acción dentro de un modelo
    Los métodos create,delete,etc se activan cuando se ha realizado la acción
    Los métodos creating,deleting,etc se activan antes de realizar la acción */

class PostObserver
{
    public function creating(Post $post)
    {
        //esta función en la condicional nos evalua si estamos creando registros desde la consola y devuelve un boleano
        if(! \App::runningInConsole()){
            $post->user_id = auth()->user()->getAuthIdentifier();
        }
    }
    
    public function deleting(Post $post)
    {
        if($post->image){
            Storage::delete($post->image->url);
        }
    }
}