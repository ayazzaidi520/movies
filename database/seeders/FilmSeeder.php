<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $film = Film::factory()->count(3)->create();
        $film->each(function ($item) use ($user) {
            $item->comments()->create([
                'comment' => fake()->text(200),
                'user_id' => $user->id
            ]);
        });
    }
}
