<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // On appelle les seeders dans l'ordre pour éviter les erreurs de clés étrangères
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
            LikeSeeder::class,
        ]);
    }
}
