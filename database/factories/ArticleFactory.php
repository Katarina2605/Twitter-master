<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // On génère un titre aléatoire
            'title' => fake()->bs(),
            // On génère un texte aléatoire entre 500 et 2000 caractères
            'body' => fake()->realTextBetween($minNbChars = 500, $maxNbChars = 2000),
            'img_path' => function () {
                // On génère une image aléatoire dans le dossier storage/app/public/images
                $absolutePath = fake()->image(storage_path('app/public/images'), 640, 480, 'cats', true);
                // On retourne le chemin relatif vers l'image
                return str_replace(storage_path('app/public/'), '', $absolutePath);
            },
            // On génère une date aléatoire entre -2 mois et +1 mois
            'published_at' => fake()->dateTimeBetween('-2 months', '+ 1 month'),
            // On sélectionne un utilisateur aléatoire parmi les auteurs et les admins
            'user_id' => User::whereHas('role', function (\Illuminate\Database\Eloquent\Builder $query) {
                $query
                    ->where('role_id', 2)     // Auteur
                    ->orWhere('role_id', 1)   // Admin
                ;
            })->get()->random()->id,
        ];
    }
}
