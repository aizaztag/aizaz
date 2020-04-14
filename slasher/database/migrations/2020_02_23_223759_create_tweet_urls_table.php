<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_urls', function (Blueprint $table) {
            $table->bigInteger('tweet_id')->unsigned()->index('tweet_id');
            $table->bigInteger('twitter_id')->unsigned()->index('twitter_id');
            $table->string('url', 100)->index('url');
            $table->dateTime('twitter_created_at')->index('twitter_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweet_urls');
    }
}
