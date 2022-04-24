<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    //relación 1 a 1 polimorfica inversa

    public function imageable(){
        return $this->morphTo();
    }
}
