<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Created using this command: 
     * > php artisan make:factory ArticleFactory
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a variable named 'title', with realText (length: 55)
        $title = $this->faker->unique()->realText(55);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'introduction' => $this->faker->realText(55),
            'image' => 'articles/'.$this->faker
                        ->image('public/storage/articles', 640, 480, null, false),
            'body' => $this->faker->text(2000),
            'status' => $this->faker->boolean(),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id
        ];
        /**
         * Created a direct access of 'storage' by using
         * this command:
         * 
         * > php artisan storage:link 
         */
    }
}
