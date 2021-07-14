<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignId('podcast_id')->constrained();
            $table->string('title');
            $table->string('file_name');
            $table->string('audio_duration');
            $table->boolean('downloadable')->default(FALSE);
            $table->longText('show_notes');
            $table->string('type');
            $table->string('explicit')->nullable();
            $table->integer('season')->nullable();
            $table->integer('episode_no')->nullable();
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
        Schema::dropIfExists('episodes');
    }
}
