<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Created using this command:
     * > php artisan make:factory CommentFactory
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->numberBetween($min=1, $max=5),
            'description' => $this->faker->realText(255),
            'user_id' => User::all()->random()->id,
            'article_id' => Article::all()->random()->id
        ];
    }
}
