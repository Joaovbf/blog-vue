<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['titulo','conteudo'];

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
}
