<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /*Si en caso de usar "fillable" en lugar de "guarded", seç
    tiene que definir los campos que van a permitir poder 
    asignarse de forma masiva.
    */
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
