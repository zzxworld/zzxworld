<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinuxCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linux_commands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 31)->comment('命令名称');
            $table->string('effect')->comment('命令作用');
            $table->timestamp('published_at')->comment('发布时间');
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
        Schema::dropIfExists('linux_commands');
    }
}
