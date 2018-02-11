<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlAlterationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_alterations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from', 127)->comment('要变更的地址');
            $table->string('to', 127)->comment('新的地址');
            $table->boolean('is_permanent')->default(true)->comment('是否为永久性变更');
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
        Schema::dropIfExists('url_moves');
    }
}
