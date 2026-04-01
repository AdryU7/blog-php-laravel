<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //LLamar al seeder
        $this->call(UserSeeder::class);

        //Storage: Delete folders, and then create them again
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');

        //Factories
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();

        //Change provider in 'vendor/fakerphp/src/Faker/Provider/Image.php'
        // -> public const BASE_URL = 'https://placehold.jp';
    }
    /**
     * Droping all tables and re-running all migrations
     * with seeders
     * 
     * > php artisan migrate:fresh --seed
     */
}
