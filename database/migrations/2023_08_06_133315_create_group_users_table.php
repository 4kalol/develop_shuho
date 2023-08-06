<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->foreign('user_id')
                  ->references('id')        // 参照先のテーブルのカラム（ここではunit_usersテーブルのidカラム）を指定
                  ->on('unit_users')
                  ->onDelete('cascade');    // 参照先のデータが消えたら関連したデータも消す
            $table->foreign('group_id')
                  ->references('id')        // 参照先のテーブルのカラム（ここではgroupsテーブルのidカラム）を指定
                  ->on('groups')
                  ->onDelete('cascade');    // 参照先のデータが消えたら関連したデータも消す
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_users');
    }
};
