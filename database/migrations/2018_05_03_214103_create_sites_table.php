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
            $table->boolean('is_private')->default(true)->index()->comment('是否为私密的站点');
            $table->string('scheme', 5)->comment('站点协议');
            $table->string('domain', 127)->comment('站点域名');
            $table->smallInteger('port')->default(80)->comment('站点端口');
            $table->string('path', 63)->default('')->comment('站点目录');
            $table->string('name', 127)->default('')->comment('站点名称');
            $table->timestamps();

            $table->unique(['scheme', 'domain', 'port', 'path']);
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
