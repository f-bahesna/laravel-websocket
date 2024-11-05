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
        Schema::create('user_chatrooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('chatroom_id');
            $table->uuid('user_id');
            $table->boolean('is_admin')->default(0);
            $table->timestamps();

            $table->foreign('chatroom_id')->references('id')->on('chatrooms');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_chatrooms');
    }
};
