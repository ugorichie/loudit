<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *  THINGS WE NEED FOR THE LOUD TABLE
     * STRING -> LOUDS
     * INTEGER -> LIKES
     *  in future term we need to tie it to a user, to display a users louds.
     * in future term we need to tie it a comment section
     *
     * @return void
     */
    public function up()
    {
        Schema::create('louds', function (Blueprint $table) {
            $table->id();
            $table->string('loud');
            $table->interger('likes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loud');
    }
};
