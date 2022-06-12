<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Este código nos previene de un usuario que cree un post y cambie el id de usuario
        // Pero nos da problemas al editar el post ya que no tiene sentido actualizar el id del usuario al editar
        //lo arreglaremos más tarde 

        /* if ($this->user_id == auth()->user()->id){
            return true;
        }else{
            return false;
        } */
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //Recuperamos la información del post que vamos a validar
        $post = $this->route()->parameter('post');

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts', //usamos esta regla de validación cuando creamos un registro           
            'status' => 'required|in:1,2',
            'file' => 'image'
        ];

        if($post){
            //usaremos esta otra regla de validación cuando editemos un registro
            $rules['slug'] = 'required|unique:posts,slug,' . $post->id;
        }

        if ($this->status == 2) {
            $rules = array_merge($rules,[
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required'
            ]);
        }

        return $rules;
    }
}
