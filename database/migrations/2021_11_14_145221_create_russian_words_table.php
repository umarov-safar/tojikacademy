<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRussianWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('russian_words', function (Blueprint $table) {
            $table->id();
            $table->string('russian')->unique();
            $table->string('tj');
            $table->string('incorrect_answers'); // json
            $table->boolean('is_masculine')->default(0);
            $table->boolean('is_feminine')->default(0);
            $table->boolean('is_neutral')->default(0);
            $table->boolean('is_noun')->default(0);
            $table->boolean('is_verb')->default(0);
            $table->boolean('is_adjective')->default(0);
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
        Schema::dropIfExists('russian_words');
    }
}
