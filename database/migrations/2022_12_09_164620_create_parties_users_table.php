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
        Schema::create('parties_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('party_id');
            $table->boolean('active')->default(true);
            $table->timestamps();


            $table->unique(['user_id', 'party_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('party_users');
    }
};
