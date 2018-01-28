<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('textable_type', 63)->comment('文本模型引用对象');
            $table->integer('textable_id')->unsigned()->comment('文本模型引用对象 id');
            $table->string('text', 1023)->nullable()->comment('文本数据');
            $table->timestamps();

            $table->index(['textable_type', 'textable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('texts');
    }
}
