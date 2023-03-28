<?php

use App\Models\Film;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('film resources pages is displayed', function () {
    $film = Film::factory()->create();
    $user = User::factory()->create();
    $film->comments()->create([
        'user_id' => $user->id,
        'comment' => fake()->text(200)
    ]);
    $this->get(route('films.index'))->assertOk();
    $this->get(route('films.create'))->assertOk();
    $this->get(route('films.show', $film->slug))->assertOk();
});

test('film and comment store', function () {
    $user = User::factory()->create();

    $media = UploadedFile::fake()->image('slide_image.jpg');
    $film = Film::factory()->create()->toArray();
    $film['name'] = fake()->name();
    $film['media'] = $media;
    $this->post(route('api.films.store'), $film)->assertStatus(201);

    $this->actingAs($user)->post(route('comments.store'), [
        'comment' => fake()->text(200),
        'film_id' => $film['id']
    ])->assertStatus(201);


});
