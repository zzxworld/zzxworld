<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_feeds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->comment('站点 ID');
            $table->string('title')->comment('站点源标题');
            $table->string('url', 127)->unique()->comment('站点源地址');
            $table->boolean('is_enabled')->default(false)->comment('是否启用站点源');
            $table->timestamps();

            $table->index(['site_id', 'is_enabled']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_feeds');
    }
}
