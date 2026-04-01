<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Created using this command:
     * > php artisan make:factory CategoryFactory
     * 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a variable named 'name' of type word (length: 10)
        $name = $this->faker->unique()->word(10);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => 'categories/'.$this->faker
                        ->image('public/storage/categories', 640, 480, null, false),
            'is_featured' => $this->faker->boolean(),
            'status' => $this->faker->boolean()
        ];
    }
}
