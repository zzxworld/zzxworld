<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commentable_id')->unsigned()->comment('评论模型 id');
            $table->string('commentable_type', 63)->comment('评论模型类型');
            $table->integer('parent_id')->unsigned()->default(0)-> comment('回复评论 id');
            $table->integer('user_id')->unsigned()-> comment('评论者');
            $table->ipAddress('ip')->nullable()-> comment('评论者 ip');
            $table->timestamps();

            $table->index('commentable_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
