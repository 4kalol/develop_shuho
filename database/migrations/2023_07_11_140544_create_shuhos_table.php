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
            $table->text('name');
            $table->enum('level', ['good', 'normal', 'bad']);
            $table->text('report');
            $table->date('created_at');
            $table->date('updated_at');
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
