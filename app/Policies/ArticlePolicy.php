<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
// Created by using this command
// > php artisan make:policy ArticlePolicy --model=Article
class ArticlePolicy
{
    public function view(User $user, Article $article) {
        // Check if the authenticated user is the same who created the
        // article
        return $user->id === $article->user_id;
    }

    public function update(User $user, Article $article) {
        // Check if the authenticated user is the same who created the
        // article
        return $user->id === $article->user_id;
    }

    public function delete(User $user, Article $article) {
        // Check if the authenticated user is the same who created the
        // article
        return $user->id === $article->user_id;
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
