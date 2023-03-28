<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->nullable()->references('id')->on('medias')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('rating');
            $table->string('name');
            $table->string('slug');
            $table->string('country');
            $table->text('description');
            $table->text('genre');
            $table->decimal('ticket_price');
            $table->date('release_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
