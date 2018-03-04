<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGuestFieldsToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->boolean('is_hidden', 63)->default(true)->comment('是否隐藏')->after('ip');
            $table->string('guest_email', 127)->nullable()->comment('匿名者联系邮箱')->after('ip');
            $table->string('guest_name', 63)->nullable()->comment('匿名者姓名')->after('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn(['is_hidden', 'guest_email', 'guest_name']);
        });
    }
}
