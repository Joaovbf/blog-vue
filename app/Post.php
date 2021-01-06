<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ["comentarios","autor"];
    protected $fillable = ['titulo','conteudo','user_id'];

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function autor()
    {
        return $this->belongsTo(User::class);
    }
}
