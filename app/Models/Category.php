<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $guarded = ['id', 'created_at', 'updated_at'];

    use HasFactory;

    //Relacion de uno a muchos (category-articles)
    public function articles() {
        return $this->hasMany(Article::class);
    }
}
