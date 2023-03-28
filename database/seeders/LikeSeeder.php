<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<100; $i++){
            $user=User::all()->random();
            $article=Article::all()->random();
            $like=Like::make();
            $like->user_id=$user->id;
            $like->article_id=$article->id;
            $like->save();
        }
    }
}
