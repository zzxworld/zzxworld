<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('news_feed_id')->unsigned()->comment('新闻源 ID');
            $table->char('sign', 32)->comment('新闻唯一标示符');
            $table->string('title')->comment('新闻标题');
            $table->string('url')->comment('新闻地址');
            $table->timestamps();

            $table->index(['news_feed_id', 'sign']);
            $table->unique('sign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_posts');
    }
}
