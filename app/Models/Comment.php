<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory;

    //Relacion de uno a muchos INVERSA (comment-user)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos INVERSA (comment-article)
    public function article() {
        return $this->belongsTo(Article::class);
    }
}
