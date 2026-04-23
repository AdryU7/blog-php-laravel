<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /*Si en caso de usar "fillable" en lugar de "guarded", se
    tiene que definir los campos que van a permitir poder 
    asignarse de forma masiva.
    */
    protected $fillable = [
        'photo',
        'profession',
        'about',
        'twitter',
        'linkedin',
        'facebook',
        'user_id'
    ];

    // Conectar modelo Profile con fábricas
    use HasFactory;

    //Relación de uno a uno INVERSA (profile-user)
    public function user() {
        return $this->belongsTo(User::class);
    }
}
