<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->bigInteger('tweet_id')->unsigned()->primary();
            $table->string('tweet_text', 160);
            $table->dateTime('twitter_created_at')->index('twitter_created_at');
            $table->bigInteger('twitter_id')->unsigned()->index('twitter_id');
            $table->boolean('is_rt');
            $table->integer('retweet_count')->index('retweet_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
