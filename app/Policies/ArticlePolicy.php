<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
// Created by using this command
// > php artisan make:policy ArticlePolicy --model=Article
class ArticlePolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }

    // Funcion published para definir una regla de Policy para mostrar
    // los articulos que SÍ son públicos
    public function published(?User $user, Article $article): bool {
        if ($article->status == 1) {
            return true;
        } else {
            return false;
        }
    }
}
