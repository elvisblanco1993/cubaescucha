<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDistributorsColumnsToPodcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('spotifypodcasts_url')->nullable();
            $table->string('googlepodcasts_url')->nullable();
            $table->string('applepodcasts_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('podcasts', function (Blueprint $table) {
            //
            $table->dropColumn(['spotifypodcasts_url', 'googlepodcasts_url', 'applepodcasts_url']);
        });
    }
}
