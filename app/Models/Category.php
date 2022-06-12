<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];
    
    //cambiamos el id por el slug

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //relación 1 a muchos    

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
