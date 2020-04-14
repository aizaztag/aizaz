<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_mentions', function (Blueprint $table) {
            $table->bigInteger('tweet_id')->unsigned()->index('tweet_id');
            $table->dateTime('twitter_created_at')->index('twitter_created_at');
            $table->bigInteger('source_user_id')->unsigned()->index('source_user_id');
            $table->bigInteger('target_user_id')->unsigned()->index('target_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweet_mentions');
    }
}
