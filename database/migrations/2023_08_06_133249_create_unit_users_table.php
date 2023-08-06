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
        Schema::create('unit_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('admins_id');
            $table->foreign('users_id')
                  ->references('id')        // 参照先のテーブルのカラム（ここではusersテーブルのidカラム）を指定
                  ->on('users')
                  ->onDelete('cascade');    // 参照先のデータが消えたら関連したデータも消す
            $table->foreign('admins_id')
                  ->references('id')        // 参照先のテーブルのカラム（ここではadminsテーブルのidカラム）を指定
                  ->on('admins')
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
        Schema::dropIfExists('unit_users');
    }
};
