<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $with = ["autor"];
    protected $fillable = ['conteudo','user_id','post_id'];

    public function autor(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
