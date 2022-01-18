<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnglishWordsTable extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('english_words', function (Blueprint $table) {
            $table->id();
            $table->string('english')->unique();
            $table->string('tj');
            $table->text('incorrect_answers'); // json
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
        Schema::dropIfExists('english_words');
    }
}
