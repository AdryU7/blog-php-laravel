<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory;

    //Relacion de uno a muchos INVERSA (article-user)
    public function user() {
        return $this->belongsTo(User::class);
    }

    //Relacion de uno a muchos (article-comments)
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    //Relacion de uno a muchos INVERSA (article-category)
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
