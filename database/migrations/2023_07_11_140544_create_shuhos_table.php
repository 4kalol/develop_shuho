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
        Schema::create('shuhos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0); // デフォルト値を0に設定（任意の値を指定）
            $table->foreign('user_id')
                  ->references('id')           // 参照先のテーブルのカラム（ここではusersテーブルのidカラム）を指定
                  ->on('users')
                  ->onDelete('cascade');       // 参照先のレコードが削除された際の挙動（cascadeは関連するレコードも一緒に削除）
            $table->text('name');
            $table->enum('level', ['good', 'normal', 'bad']);
            $table->text('report');
            $table->timestamps();
            $table->boolean('checked');
            $table->text('comment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shuhos');
    }
};
