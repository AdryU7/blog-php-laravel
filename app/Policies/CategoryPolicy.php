<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
//use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    // Funcion published para definir una regla de Policy para mostrar
    // las categorias que SÍ son públicas
    public function published(?User $user, Category $category) {
        if ($category->status == 1) {
            return true;
        } else {
            return false;
        }
    }
}
