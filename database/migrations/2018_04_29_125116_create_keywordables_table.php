<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywordables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('keyword_id')->unsigned()->comment('关键词 ID');
            $table->integer('keywordable_id')->unsigned()->comment('使用关键词模型对象的 ID');
            $table->string('keywordable_type')->comment('使用关键词模型对象的类型');
            $table->decimal('tf', 4, 3)->default(0)->comment('关键词频率');
            $table->timestamps();

            $table->index('keyword_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keywordables');
    }
}
