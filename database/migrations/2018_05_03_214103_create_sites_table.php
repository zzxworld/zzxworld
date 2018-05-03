<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_private')->default(true)->comment('是否为私密的站点');
            $table->char('uuid', 32)->unique()->comment('站点唯一 ID');
            $table->string('url', 127)->comment('站点地址');
            $table->string('name', 127)->default('')->comment('站点名称');
            $table->timestamps();

            $table->index('is_private');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
