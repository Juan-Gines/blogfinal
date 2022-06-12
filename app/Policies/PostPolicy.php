<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // Este método nos previene de que un usuario intente editar o borrar un post que no sea suyo

    public function author(User $user, Post $post){
        if($user->id == $post->user_id){
            return true;
        }else{
            return false;
        }
    }

    //este método nos previene que un usuario pueda ver un post que está en borrador sin publicar
    //le ponemos ? delante de user para que no sea indispensable estar auytentificado para ver un post
    //de lo contrario nadie sin loguear podría ver ningún post

    public function published(?User $user, Post $post){
        if($post->status == 2){
            return true;
        }else{
            return false;
        }
    }
}
