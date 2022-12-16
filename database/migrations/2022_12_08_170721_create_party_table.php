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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table -> string('name');
            $table -> unsignedBigInteger('game_id');
            $table -> unsignedBigInteger('owner');
            $table->timestamps();

            $table->unique(['name', 'game_id']);
            $table->foreign('owner')->references('id')->on('users') -> onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party');
    }
};
