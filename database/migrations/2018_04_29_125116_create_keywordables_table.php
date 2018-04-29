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
            $table->integer('keyword_total')->default(0)->comment('关键词总数');
            $table->integer('keywordable_id')->unsigned()->comment('使用关键词模型对象的 ID');
            $table->char('keywordable_type', 2)->comment('使用关键词模型对象的类型');
            $table->timestamps();

            $table->index(['keywordable_id', 'keywordable_type']);
            $table->index(['keywordable_type', 'keyword_id']);
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
